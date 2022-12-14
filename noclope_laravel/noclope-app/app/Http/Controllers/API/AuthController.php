<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;
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
                'goal'=>'required',
                'price_goal'=>'required',
                'price_pack'=>'required',
                'consumption'=>'required',
        ]);

        $user = User::create([
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
          ]);

          $idconnecte=$user['id'];

        $project= Project:: create( [
          'goal'=> $request->goal,
          'price_goal'=>$request->price_goal,
          'price_pack'=>$request->price_pack,
          'consumption'=>$request->consumption,
          'user_id'=> $idconnecte,
        ]);
        
        $token = $user->createToken('auth_token')->plainTextToken;

        $user->remember_token = $token;
        $user->save();

        try {
            //Le try est si la requete à fonctionné pour la création d'un customer stripe
    
                // // Création d'un customer Stripe
                $stripe = new \Stripe\StripeClient(
                  env('STRIPE_API_KEY')
                );
    
                // $idconnecte=Auth::user()->id;
                // $idconnecte=3;
                $userconnecte=User::FindOrFail($idconnecte);
                
                $customer= $stripe->customers->create([
                  'email' => $userconnecte['email'], 
                  'name' => $userconnecte['lastname'], 
                ]);  
    
                //Met à jour la base de donnée avec l'identifiant stripe créé
                $user = User::findOrFail($idconnecte);
                $user->stripe_id =  $customer['id'] ;
                $user->save();
              
              
                      //Le try est si la requete a fonctionné pour la création d'une session stripe
                      try { 
                            // Création d'une session Stripe "Checkout"
                            \Stripe\Stripe::setApiKey(env('STRIPE_API_KEY'));
                            $customer=$session = \Stripe\Checkout\Session::create([
                                'payment_method_types' => ['card'],
                                'mode' => 'setup',
                                'customer' => $customer['id'], 
                               'success_url' => 'http://127.0.0.1:5173/', 
                                'cancel_url' => 'http://127.0.0.1:8000/stripe/cancel',//A voir si lurl est bonne
                              ]);
    
                            $stripe = new \Stripe\StripeClient(
                              env('STRIPE_API_KEY')
                            );
                            $stripe->setupIntents->create([
                              'payment_method_types' => ['card'],
                            ]);
                        
    

                              return response()->json(['url'=>$session['url'],
                              'access_token' => $token,'project'=>$project]);
                            
                      }catch(\Exception $error) {
                        //Pour envoyer un message d'erreur si la requete a échouée lors créaton d'une session stripe
                        return response("La création a échouée2", 404);
                    }
    
              
          }catch(\Exception $error) {
              //Pour envoyer un message d'erreur si la requete a échouée lors créaton d'un customer stripe
              return response("La création a échouée1", 404);
          }
      
        
       
        // return response()->json([
        //     'message' => "Utilisateur créé.",
        //     'user' => $user,
        //     'access_token' => $token,
        //     'token_type' => 'Bearer',
  
            
        // ],201);

    }

    public function login(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required', 
            
    ]);

    // $user = User::findOrFail(Auth::user()->id);
    
    // if($user->isadmin == 1)
    // {

    //     return response()->json([
    //         'message' => "Vous êtes connecté Admin.",
    //     ],201);
       
    // }else{
        
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

    // }
    
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
        $profil->password = Hash::make($request->password);
        
        $profil->save();

        return response()->json(['message' => "Profil modifié.",'profil' => $profil],201);
    }

}
