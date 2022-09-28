<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

class PersonasController extends Controller
{

    public function vistaVisualizarPersonas()
    {
        $personas = Persona::get();
        return view('persona.visualizar', ['personas' => $personas]);
    }

    public function vistaRegistrarPersona()
    {
        return view('persona.registrar');
    }

    public function registrarPersona(Request $request)
    {
        $nombre = $request->json('nombre');
        $sexo = $request->json('sexo');
        $edad = $request->json('edad');
        $estado_civil = $request->json('estado_civil');

        $persona = new Persona();
        $persona->nombre = $nombre;
        $persona->edad = $edad;
        $persona->sexo = $sexo;
        $persona->estado_civil = $estado_civil;
        $persona->save();

        return response()->json(['success' => true]);
    }

    public function borrar($id)
   {
      $isDeleted = Persona::where('id',$id)->delete();
      return response()->json([
         'success' => $isDeleted
      ]);
   }


   public function editarPersona(Request $request)
   {
      $id = $request->json('id');
      $nombre = $request->json('nombre');
      $edad=$request->json('edad');
      $sexo=$request->json('sexo');
      $estado_civil = $request->json('estado_civil');

      $persona = Persona::find($id);
      $persona->nombre = $nombre;
      $persona->edad=$edad;
      $persona->sexo=$sexo;
      $persona->estado_civil=$estado_civil;
      $persona->save();

      return response()->json([
         'success' => true
      ]);

   }


   public function vistaEditar($id)
   {
      $persona = Persona::where('id',$id)->first();
      //pasar datos a la vista
      return View('persona.editar',['persona' => $persona]);
   }
}
