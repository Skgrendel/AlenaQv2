<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
       use AuthenticatesUsers;
       protected $redirectTo = '/home';

       public function __construct()
       {
           $this->middleware('guest')->except('logout');
       }

       public function login(Request $request)
       {
           $this->validateLogin($request);

           // Verificar si el usuario existe
           $user = User::where('email', $request->email)->first();

           if (!$user) {
               return redirect()->back()
                   ->withInput($request->only($this->username(), 'remember'))
                   ->withErrors(['error' => 'El usuario no está registrado.']);
           }

           if ($this->attemptLogin($request)) {
               return $this->sendLoginResponse($request);
           }

           return redirect()->back()
               ->withInput($request->only($this->username(), 'remember'))
               ->withErrors(['error' => 'Usuario o contraseña incorrectos.']);
       }
}
