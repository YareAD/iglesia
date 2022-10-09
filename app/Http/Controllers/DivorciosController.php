<?php

namespace App\Http\Controllers;

use App\Models\Casado;
use App\Models\Divorcio;
use App\Models\Persona;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class DivorciosController extends Controller
{
    public function vistaVisualizarDivorcios()
    {
        $divorcios = new Collection();
        $tablaDivorcios = Divorcio::get();

        foreach ($tablaDivorcios as $divorcio) {
            $hombre = Persona::where('id', $divorcio->id_hombre)->first();
            $mujer = Persona::where('id', $divorcio->id_mujer)->first();
            $divorcios->push((object)['hombre' => $hombre->nombre, 'mujer' => $mujer->nombre, 'fecha_divorcio' => $divorcio->fecha_divorcio]);
        }
        $divorcios  = collect($divorcios);
        return view('divorcios.visualizar', ['divorciados' => $divorcios]);
    }

    public function divorciar($id)
    {
        $casamiento = Casado::find($id);

        if ($casamiento) {
            $fecha_divorcio = Carbon::now();
            $divorcio = new Divorcio();
            $divorcio->id_hombre = $casamiento->id_hombre;
            $divorcio->id_mujer = $casamiento->id_mujer;
            $divorcio->fecha_divorcio = $fecha_divorcio;
            $divorcio->save();
            $casamiento->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}
