<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\User;
use App\Models\Horario;
use App\Models\Cita;
use App\Models\Cliente;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AgendarController extends Controller
{
    /**
     * Muestra la página principal de agendamiento
     */
public function index()
{
    // traer servicios para la página informativa (index.blade)
    $servicios = \App\Models\Servicio::all();
    return view('agendar.index', compact('servicios'));
}

    /**
     * Muestra el formulario para crear una nueva cita
     */
public function create()
{
    // mostrar formulario (create.blade)
    $servicios = \App\Models\Servicio::all();
    return view('agendar.create', compact('servicios'));
}

    /**
     * Guarda la cita en la base de datos
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'celular' => 'required|string|max:20',
            'correo' => 'required|email|max:255',
            'servicio_id' => 'required|exists:servicios,id',
            'empleado_id' => 'required|exists:users,id',
            'fecha' => 'required|date',
            'hora' => 'required',
        ]);

        DB::beginTransaction();

        try {
            // Registrar cliente si no existe
            $cliente = Cliente::firstOrCreate(
                ['correo' => $request->correo],
                [
                    'nombres' => $request->nombre,
                    'apellidos' => $request->apellidos,
                    'celular' => $request->celular,
                ]
            );

            // Obtener servicio para su duración
            $servicio = Servicio::findOrFail($request->servicio_id);
            $duracion = $servicio->duracion_minutos;

            // Calcular hora fin
            $horaInicio = Carbon::parse($request->hora);
            $horaFin = $horaInicio->copy()->addMinutes($duracion);

            // Registrar la cita
            Cita::create([
                'cliente_id' => $cliente->id,
                'empleado_id' => $request->empleado_id,
                'servicio' => $servicio->nombre,
                'celular' => $request->celular,
                'fecha' => $request->fecha,
                'hora_inicio' => $horaInicio->format('H:i:s'),
                'duracion_minutos' => $duracion,
                'hora_fin' => $horaFin->format('H:i:s'),
                'estado' => 'Pendiente',
            ]);

            DB::commit();

            // Si deseas enviar notificación de WhatsApp (opcional)
            // $this->enviarNotificacionWhatsApp($request->celular, $servicio->nombre, $request->fecha, $horaInicio);

            return redirect()->route('agendar.create')
                ->with('success', '✅ ¡Cita agendada exitosamente! Te contactaremos para confirmar.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Ocurrió un error al agendar la cita: ' . $e->getMessage());
        }
    }

    /**
     * Obtener los días disponibles del estilista
     */
    public function getDiasDisponibles($usuario_id)
    {
        $dias = Horario::where('usuario_id', $usuario_id)->pluck('dia');
        return response()->json($dias);
    }

    /**
     * Obtener las horas disponibles de un estilista para un día específico
     */
    public function getHorasDisponibles($usuario_id, $dia)
{
    // Buscar el horario del estilista para ese día
    $horario = Horario::where('usuario_id', $usuario_id)
        ->where('dia', $dia)
        ->first();

    if (!$horario) {
        return response()->json([]);
    }

    // Generar horas cada 30 minutos
    $horaInicio = \Carbon\Carbon::parse($horario->hora_inicio);
    $horaFin = \Carbon\Carbon::parse($horario->hora_fin);

    $horasDisponibles = [];
    while ($horaInicio->lt($horaFin)) {
        $horasDisponibles[] = $horaInicio->format('H:i');
        $horaInicio->addMinutes(30);
    }

    // Consultar citas ocupadas para ese estilista y día
    $citas = \App\Models\Cita::where('empleado_id', $usuario_id)
        ->where('fecha', '>=', now()->startOfWeek()) // 🔹 por si usas texto en el campo 'dia'
        ->where('fecha', '<=', now()->endOfWeek())
        ->get(['hora_inicio', 'hora_fin', 'fecha']);

    // Filtrar horas que ya estén ocupadas ese día
    foreach ($citas as $cita) {
        if (strtolower(now()->parse($cita->fecha)->translatedFormat('l')) === strtolower($dia)) {
            $inicio = \Carbon\Carbon::parse($cita->hora_inicio);
            $fin = \Carbon\Carbon::parse($cita->hora_fin);
            $horasDisponibles = array_filter($horasDisponibles, function ($h) use ($inicio, $fin) {
                $hTime = \Carbon\Carbon::parse($h);
                return !$hTime->between($inicio, $fin);
            });
        }
    }

    return response()->json(array_values($horasDisponibles));
}


    /**
     * (Opcional) Enviar notificación por WhatsApp
     */
    private function enviarNotificacionWhatsApp($celular, $servicio, $fecha, $hora)
    {
        // Aquí podrías integrar Twilio o Chat-API
        // Ejemplo:
        // Http::post('https://api.whatsapp.com/send', [
        //     'to' => $celular,
        //     'message' => "Tu cita para $servicio fue agendada el $fecha a las $hora. ¡Te esperamos!"
        // ]);
    }
}
