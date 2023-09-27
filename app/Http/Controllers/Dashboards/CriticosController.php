<?php

namespace App\Http\Controllers\Dashboards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Requerimientos;

class CriticosController extends Controller
{
    public function index() {

        $groups = Requerimientos::select(
            'id',
            'folio',
            'parte',
            'ruta',
            'cantidad_solicitada',
            'cantidad_surtida',
            'cantidad_recibida',
            'created_at as fecha',
        )
        ->where('status', 'critico')
        ->orderBy('id', 'desc')
        ->get()
        ->groupBy('ruta');

        $mergedData = [];
        $rutas = [];

        // Cada ruta viene dada por una propiedad
        foreach ($groups as $propiedad) {
            // Conteo de críticos por ruta
            array_push($rutas, [
                'ruta' => $propiedad->first->ruta->ruta,
                'cantidad' => count($propiedad),
            ]);

            // Recorre los elementos de cada propiedad
            foreach ($propiedad as $prop) {
                // Calcula la cantidad pendiente: lo que se solicitó menos lo que se surtió
                $prop->cantidad_pendiente = intval($prop->cantidad_solicitada) - intval($prop->cantidad_surtida);
                if($prop->cantidad_pendiente < 0 )
                    $prop->cantidad_pendiente = 0;

                // Agregando los críticos agrupados a una sola lista
                array_push($mergedData, $prop);
            }
        }

        return response([
            'data' => $mergedData,
            'rutas' => $rutas
        ]);
    }
}
