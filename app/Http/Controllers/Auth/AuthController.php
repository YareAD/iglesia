<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function vistaIniciarSesion()
    {
        return view('auth.iniciarsesion');
    }

    public function vistaRegistro()
    {
        return view('auth.registro');
    }

    public function iniciarSesion(Request $request)
    {
        $email = $request->json('email');
        $password = $request->json('password');

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $request->session()->regenerate();
            return response()->json(['sesion' => true]);
        }
        return response()->json(['sesion' => false]);
    }

    public function registro(Request $request)
    {
        $nombre = $request->json('nombre');
        $email = $request->json('email');
        $password = $request->json('password');

        $usuario = new User();
        $usuario->name = $nombre;
        $usuario->email = $email;
        $usuario->password = Hash::make($password);
        $usuario->save();

        return response()->json(['success' => true]);
    }

    public function cerrarSesion()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
