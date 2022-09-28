<?php

namespace App\Http\Controllers;

use App\Models\Casado;
use App\Models\Persona;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CasadosController extends Controller
{

    public function vistaVerCasados()
    {
        $casados = new Collection();
        $tablaCasados = Casado::get();

        foreach ($tablaCasados as $compromiso) {
            $hombre = Persona::where('id', $compromiso->id_hombre)->first();
            $mujer = Persona::where('id', $compromiso->id_mujer)->first();
            $casados->push((object)['hombre' => $hombre->nombre, 'mujer' => $mujer->nombre, 'fecha_boda' => $compromiso->fecha_boda]);
        }
        $casados  = collect($casados);
        return view('casados.visualizar', ['casados' => $casados]);
    }

    public function vistaCasar()
    {
        $hombresSolteros = Persona::where(['estado_civil' => 'SOLTERO', 'sexo' => 'H'])
            ->get();

        $mujeresSolteras = Persona::where(['estado_civil' => 'SOLTERO', 'sexo' => 'M'])
            ->get();

        return view('casados.casar', ['hombres' => $hombresSolteros, 'mujeres' => $mujeresSolteras]);
    }
    public function casar(Request $request)
    {
        $id_hombre = $request->json('id_hombre');
        $id_mujer = $request->json('id_mujer');
        $fecha_boda = Carbon::now();

        $casado = new Casado();
        $casado->id_hombre = $id_hombre;
        $casado->id_mujer = $id_mujer;
        $casado->fecha_boda = $fecha_boda;
        $casado->save();

        Persona::whereIn('id', [$id_hombre, $id_mujer])
            ->update(['estado_civil' => 'CASADO']);

        return response()->json(['casado' => true]);
    }
}
