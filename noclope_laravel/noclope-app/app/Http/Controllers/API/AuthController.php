<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
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
            'password' => $request->password,
        ]);

        return response()->json(['message' => "Utilisateur créé.",'user' => $user],201);

    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $infouser = [
            'email' =>$request->email,
            'password' =>$request->password,
        ];

        

        return response()->json(["token" => "test"]);
    }

    public function edit($id)
    {
        $profil = User::findOrFail($id);

        return response()->json(['profil' => $profil]);
    }

    public function update(Request $request, $id)
    {
        
        $request->validate([

            'lastname' => 'required',
            'firstname' => 'required',
            'email' => 'required|email',
            'password' => 'required', //Mettre après coup des conditions plus sévères pour le mot de passe
        ]);

        $profil = User::findOrFail($id);
        $profil->lastname = $request->get('lastname');
        $profil->firstname = $request->get('firstname');
        $profil->email = $request->get('email');
        $profil->password = $request->get('password');
        
        $profil->save();

        return response()->json(['message' => "Profil modifié.",'profil' => $profil],201);
    }

}
