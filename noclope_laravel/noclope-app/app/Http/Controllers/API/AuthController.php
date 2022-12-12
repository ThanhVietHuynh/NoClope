<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Fortify;
use Laravel\Sanctum\HasApiTokens;

class AuthController extends Controller
{
    use HasApiTokens, Notifiable;
    public function register(Request $request){

        $request->validate([
                'lastname' => 'required',
                'firstname' => 'required',
                'email' => 'required|email',
                'password' => 'required', //Mettre après coup des conditions plus sévères pour le mot de passe
                
        ]);

        $user = User::create([
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        
       
        return response()->json([
            'message' => "Utilisateur créé.",
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ],201);

    }

    public function login(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required', 
            
    ]);

       
        $user = User::where('email', $request->email)->first();
       
        if(!Hash::check($request->password, $user['password'])===false){
            
            $token = $user->createToken('auth_token')->plainTextToken;
               
            return response()->json([
                'message' => "Utilisateur créé.",
                'user' => $user,
                'access_token' => $token,
                'token' => $token->plainTextToken,
                'token_type' => 'Bearer',
            ],201);
           

        } else {
            return response()->json([
                'message' => "Identifiant ou mot de passe incorect",
                
     ], 400);
        }

    }
}