<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\User;

class HorarioController extends Controller
{
    // Mostrar todos los horarios
    public function index()
    {
        $horarios = Horario::with('usuario')->get();
        return view('admin.horarios.index', compact('horarios'));
    }

    // Formulario para crear un nuevo horario
    public function create()
    {
        // ✅ Si quieres mostrar todos los usuarios que tienen un servicio asignado
        $usuarios = User::whereNotNull('servicio')->get();

        // O si solo algunos servicios específicos pueden tener horario (por ejemplo, estilistas):
        // $usuarios = User::where('servicio', 'Estilista')->get();

        return view('admin.horarios.create', compact('usuarios'));
    }

    // Guardar horario nuevo
    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'dia' => 'required|string',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
        ]);

        Horario::create($request->all());

        return redirect()->route('admin.horarios.index')
                         ->with('success', 'Horario creado correctamente.');
    }

    // Mostrar un horario en detalle
    public function show($id)
    {
        $horario = Horario::with('usuario')->findOrFail($id);
        return view('admin.horarios.show', compact('horario'));
    }

    // Formulario para editar un horario
    public function edit($id)
    {
        $horario = Horario::findOrFail($id);
        $usuarios = User::whereNotNull('servicio')->get();

        return view('admin.horarios.edit', compact('horario', 'usuarios'));
    }

    // Actualizar un horario existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'dia' => 'required|string',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
        ]);

        $horario = Horario::findOrFail($id);
        $horario->update($request->all());

        return redirect()->route('admin.horarios.index')
                         ->with('success', 'Horario actualizado correctamente.');
    }

    // Eliminar un horario
    public function destroy($id)
    {
        $horario = Horario::findOrFail($id);
        $horario->delete();

        return redirect()->route('admin.horarios.index')
                         ->with('success', 'Horario eliminado correctamente.');
    }
}