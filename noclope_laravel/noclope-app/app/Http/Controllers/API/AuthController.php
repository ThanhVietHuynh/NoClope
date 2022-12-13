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

        $user->remember_token = $token;
        $user->save();
        
       
        return response()->json([
            'message' => "Inscription réussie.",
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

            $user->remember_token = $token;
            $user->save();

               
            return response()->json([
                'message' => "Vous êtes connecté.",
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ],201);
           

        } else {
            return response()->json([
                'message' => "Identifiant ou mot de passe incorect",
                
     ], 400);
        }

    }

    public function edit()
    {
        $profil = User::findOrFail(Auth::user()->id);

        return response()->json(['profil' => $profil]);
    }

    public function update(Request $request)
    {
        
        $request->validate([

            'lastname' => 'required|string',
            'firstname' => 'required|string',
            'email' => 'required|email',
            'password' => 'required', //Mettre après coup des conditions plus sévères pour le mot de passe
        ]);

        $profil = User::findOrFail(Auth::user()->id);
        $profil->lastname = $request->lastname;
        $profil->firstname = $request->firstname;
        $profil->email = $request->email;
        $profil->password = $request->password;
        
        $profil->save();

        return response()->json(['message' => "Profil modifié.",'profil' => $profil],201);
    }

}
