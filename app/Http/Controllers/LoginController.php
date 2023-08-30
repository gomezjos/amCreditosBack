<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        //$credentials = $request->only('usua_codigo', 'password');
        $credentials = ['usua_codigo' => $request->usua_codigo, 'password' => sha1($request->usua_clave)];

        if (Auth::attempt($credentials)) {
            echo "aca";die();
            // Autenticación exitosa
             $user = Auth::user();
            // $token = $user->createToken('auth-token')->plainTextToken;

            // return response()->json([
            //     'access_token' => $token,
            //     'token_type' => 'Bearer',
            // ]);
        }
        else{
            // Autenticación fallida
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }

    }
}
