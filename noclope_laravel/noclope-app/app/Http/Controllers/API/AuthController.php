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
        $validator = Validator::make($request->all(),[
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm' => 'required|same:password'
        ]);

        if($validator->fails()){
            $response = [
                "success" => false,
                "message" => $validator->errors(),
            ];
            return response()->json($response, 400);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name;

        $response = [
            'success' => true,
            'data'    => $success,
            'message' => "Connexion réussie !!!"
        ];

        return response()->json($response, 200);

    }

    public function login(Request $request){
        if(Auth::attempt(['email']));
    }
}
