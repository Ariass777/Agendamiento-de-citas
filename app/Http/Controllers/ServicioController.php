<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;

class ServicioController extends Controller
{
    public function getEstilistas($id)
    {
        // Buscar el servicio
        $servicio = Servicio::find($id);

        // Si no existe, devolver vacío
        if (!$servicio) {
            return response()->json([]);
        }

        // Obtener los estilistas asociados
        $estilistas = $servicio->usuarios()
            ->select('users.id', 'users.name') // puedes cambiar 'name' por 'nombres' si así está tu campo
            ->get();

        return response()->json($estilistas);
    }
}
