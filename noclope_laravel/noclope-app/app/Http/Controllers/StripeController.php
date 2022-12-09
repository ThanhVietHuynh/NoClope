<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;

class StripeController extends Controller
{
   

    public function index() {

      
            return view('stripe.index');
    }
    public function create(Request $request) {

      try {
        //Le try est si la requete à fonctionné pour la création d'un customer stripe

            // // Création d'un customer Stripe
            $stripe = new \Stripe\StripeClient(
              env('STRIPE_API_KEY')
            );

            // $idconnecte=Auth::user()->id;
            $idconnecte=3;
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
                           'success_url' => 'http://127.0.0.1:8000/stripe/success?{CHECKOUT_SESSION_ID}', //A voir si lurl est bonne
                            'cancel_url' => 'http://127.0.0.1:8000/stripe/cancel',
                          ]);

                          
                         
                        $stripe = new \Stripe\StripeClient(
                          env('STRIPE_API_KEY')
                        );
                        $stripe->setupIntents->create([
                          'payment_method_types' => ['card'],
                        ]);
                          return redirect($session['url']);

                  }catch(\Exception $error) {
                    //Pour envoyer un message d'erreur si la requete a échouée lors créaton d'une session stripe
                    return response("La création a échouée2", 404);
                }

          
      }catch(\Exception $error) {
          //Pour envoyer un message d'erreur si la requete a échouée lors créaton d'un customer stripe
          return response("La création a échouée1", 404);
      }
          
    }


    public function setup() {

      $stripe = new \Stripe\StripeClient(
        env('STRIPE_API_KEY')
      );

      // $idconnecte=Auth::user()->id;
      $idconnecte=3;
      $userconnecte=User::FindOrFail($idconnecte);



      $customer=$stripe->customers->allPaymentMethods(
        $userconnecte['stripe_id'], 
        ['type' => 'card']
      );
      

    $payment_method=$stripe->paymentMethods->retrieve(
      $customer['data'][0]['id'],
      []
    );

     
    $transac=$stripe->paymentIntents->create([
      'payment_method_types' => ['card'],
      'amount' => 8000,
      'currency' => 'eur',
      'customer' => $userconnecte['stripe_id'], 
      'payment_method' => $payment_method,
    ]);

      //Demande la confirmation du paiment, à voir avec Timotée si la validation doit venir du client ou si automatique
    $stripe->paymentIntents->confirm($transac->id, ['payment_method' => $payment_method]);

    return "transaction réussie";

  
    }



    public function success() {

      
          return view('stripe.success');
    }
    public function cancel() {

      
          return view('stripe.cancel');
    }

}
