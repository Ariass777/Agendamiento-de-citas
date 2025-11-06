<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Servicio;
use App\Models\User;
use App\Models\Horario;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservaController extends Controller
{
    public function index()
    {
        $reservas = Reserva::with('estilista')->orderBy('fecha', 'desc')->get();
        return view('admin.reservas.index', compact('reservas'));
    }

    public function create()
    {
        $servicios = Servicio::all();
        $estilistas = User::all();
        return view('admin.reservas.create', compact('servicios', 'estilistas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email',
            'telefono' => 'required',
            'servicio' => 'required',
            'fecha' => 'required|date',
            'hora' => 'required',
            'admin_id' => 'required|exists:users,id',
        ]);

        $servicio = Servicio::where('nombre', $request->servicio)->first();
        $inicio = Carbon::parse("{$request->fecha} {$request->hora}");
        $fin = $inicio->copy()->addMinutes($servicio->duracion_minutos);

        $ocupado = Reserva::where('admin_id', $request->admin_id)
            ->where('fecha', $request->fecha)
            ->where(function ($q) use ($inicio, $fin) {
                $q->whereBetween('hora', [$inicio->format('H:i:s'), $fin->format('H:i:s')]);
            })
            ->exists();

        if ($ocupado) {
            return back()->withErrors(['hora' => 'El estilista ya tiene una reserva en ese horario.']);
        }

        Reserva::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'servicio' => $request->servicio,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'admin_id' => $request->admin_id,
            'estado' => 'pendiente',
        ]);

        // Aquí puedes integrar Twilio o Chat-API para enviar WhatsApp
        // Ejemplo (pseudo):
        // WhatsApp::send($request->telefono, "Tu reserva ha sido creada para {$request->fecha} a las {$request->hora}");

        return redirect()->route('admin.reservas.index')->with('success', 'Reserva creada correctamente.');
    }

    public function edit($id)
    {
        $reserva = Reserva::findOrFail($id);
        $servicios = Servicio::all();
        $estilistas = User::all();
        return view('admin.reservas.edit', compact('reserva', 'servicios', 'estilistas'));
    }

    public function update(Request $request, $id)
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->update($request->all());
        return redirect()->route('admin.reservas.index')->with('success', 'Reserva actualizada.');
    }

    public function destroy($id)
    {
        Reserva::destroy($id);
        return back()->with('success', 'Reserva eliminada.');
    }

    // Mostrar horarios disponibles dinámicamente
    public function horariosDisponibles(Request $request)
    {
        $fecha = $request->fecha;
        $servicioId = $request->servicio_id;
        $estilistaId = $request->estilista_id;

        $servicio = Servicio::find($servicioId);
        $horarios = Horario::where('usuario_id', $estilistaId)->get();
        $reservas = Reserva::where('admin_id', $estilistaId)
            ->where('fecha', $fecha)
            ->get();

        $disponibles = [];

        foreach ($horarios as $h) {
            $inicio = Carbon::parse($h->hora_inicio);
            $fin = Carbon::parse($h->hora_fin);

            while ($inicio->lt($fin)) {
                $horaStr = $inicio->format('H:i:s');
                $ocupado = $reservas->contains(fn ($r) => $r->hora == $horaStr);
                if (!$ocupado) $disponibles[] = $horaStr;
                $inicio->addMinutes($servicio->duracion_minutos);
            }
        }

        return response()->json($disponibles);
    }
}
