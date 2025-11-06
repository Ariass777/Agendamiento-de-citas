<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Servicio;
use Carbon\Carbon;

class CitaController extends Controller
{
    /**
     * 📋 Mostrar todas las citas (panel admin)
     */
    public function index()
    {
        // Traer todas las citas con información de cliente y empleado
        $citas = Cita::with(['cliente', 'empleado'])
            ->orderBy('fecha', 'desc')
            ->orderBy('hora_inicio', 'asc')
            ->get();

        return view('admin.citas.index', compact('citas'));
    }

    /**
     * 👁️ Ver detalles de una cita específica
     */
    public function show($id)
    {
        $cita = Cita::with(['cliente', 'empleado'])->findOrFail($id);
        return view('admin.citas.show', compact('cita'));
    }

    /**
     * ✏️ Actualizar el estado de la cita (por ejemplo: confirmada, cancelada)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|string|max:50',
        ]);

        $cita = Cita::findOrFail($id);
        $cita->estado = $request->estado;
        $cita->save();

        return redirect()->route('admin.citas.index')
            ->with('success', 'El estado de la cita fue actualizado correctamente.');
    }

    /**
     * ❌ Eliminar una cita
     */
    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();

        return redirect()->route('admin.citas.index')
            ->with('success', 'La cita fue eliminada correctamente.');
    }

    /**
     * 💇 Obtener estilistas que ofrecen un servicio específico (para AJAX)
     */
public function obtenerEstilistas($servicio)
{
    // Buscar estilistas que tengan asignado ese servicio
    $estilistas = \App\Models\User::where('servicio', $servicio)
        ->select('id', 'name')
        ->get();

    return response()->json($estilistas);
}


    /**
     * ⏰ Obtener horarios disponibles para un empleado y fecha (para AJAX)
     */
    public function obtenerHorarios(Request $request)
    {
        $request->validate([
            'empleado_id' => 'required|integer',
            'fecha' => 'required|date',
        ]);

        $fecha = $request->fecha;
        $empleadoId = $request->empleado_id;

        // Obtener horarios base (8:00 a 20:00)
        $horarios = [];
        for ($h = 8; $h <= 20; $h++) {
            $hora = sprintf('%02d:00', $h);
            $horarios[] = $hora;
        }

        // Citas ya ocupadas del empleado
        $ocupadas = Cita::where('empleado_id', $empleadoId)
            ->whereDate('fecha', $fecha)
            ->pluck('hora_inicio')
            ->toArray();

        // Filtrar horarios disponibles
        $disponibles = array_diff($horarios, $ocupadas);

        return response()->json(array_values($disponibles));
    }
}
