<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Servicio;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Mostrar todos los usuarios
     */
    public function index()
    {
        $usuarios = User::with('servicios')->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        $servicios = Servicio::all();
        return view('admin.usuarios.create', compact('servicios'));
    }

    /**
     * Guardar un nuevo usuario
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed|min:6',
    ]);

    // Crear usuario
    $user = \App\Models\User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    // Asociar servicios (si seleccionó alguno)
    if ($request->has('servicios')) {
        $user->servicios()->sync($request->servicios);
    }

    return redirect('/admin/usuarios')->with('success', 'Usuario registrado correctamente.');
}


    /**
     * Mostrar un usuario específico
     */
    public function show($id)
    {
        $usuario = User::with('servicios')->findOrFail($id);
        return view('admin.usuarios.show', compact('usuario'));
    }

    /**
     * Formulario de edición
     */
    public function edit($id)
    {
        $usuario = User::with('servicios')->findOrFail($id);
        $servicios = Servicio::all();
        return view('admin.usuarios.edit', compact('usuario', 'servicios'));
    }

    /**
     * Actualizar usuario
     */
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $request->validate([
            'name' => 'required|max:250',
            'email' => 'required|max:250|unique:users,email,' . $usuario->id,
            'password' => 'nullable|max:250|confirmed',
            'servicios' => 'required|array',
        ]);

        $usuario->name = $request->name;
        $usuario->email = $request->email;

        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        // Actualizar servicios asignados
        $usuario->servicios()->sync($request->servicios);

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario actualizado correctamente')
            ->with('icono', 'success');
    }

    /**
     * Confirmar eliminación
     */
    public function confirmDelete($id)
    {
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.delete', compact('usuario'));
    }

    /**
     * Eliminar usuario
     */
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->servicios()->detach(); // eliminar relaciones pivot
        $usuario->delete();

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario eliminado correctamente')
            ->with('icono', 'success');
    }
}
