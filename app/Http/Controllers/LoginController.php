<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
     // Muestra el formulario de inicio de sesión
     public function showLoginForm()
     {
         return view('login');
     }
 
     // Maneja el inicio de sesión
     public function login(Request $request)
     {
         // Validar los datos del formulario
         $request->validate([
             'username' => 'required|string',
             'password' => 'required|string',
         ]);
 
         // Intentar autenticar al usuario
         if (Auth::attempt(['username' => $request->username, 'password' => $request->password], true)) {
            return redirect()->intended('/dashboard');
        }
        
 
         // Si las credenciales son incorrectas, redirigir de nuevo con un error
         return redirect()->route('login')->withErrors(['username' => 'Las credenciales no coinciden.']);
     }
 
     // Cerrar sesión
     public function logout()
     {
         Auth::logout();
         return redirect()->route('login');
     }
}
