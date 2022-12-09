<?php

namespace App\Http\Controllers;
use App\Models\Contact;
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
              'sk_test_51MCOUbDVPOGZQeRSqmmdgj6vvRYzuvjdEOi217fKdoQpyyQ8gEiliadFmDzqKOd3gTa16iabmJrPP2enCEspcavq00OUiTCG1C'
            );
            $customer= $stripe->customers->create([
              'email' => 'test2@test.com', //Ici il faudra mettre les input du formulaire d'inscription
              'name' => 'test', //Ici il faudra mettre les input du formulaire d'inscription
            ]);         
          
                  //Le try est si la requete a fonctionné pour la création d'une session stripe
                  try { 
                        // Création d'une session Stripe "Checkout"
                        \Stripe\Stripe::setApiKey('sk_test_51MCOUbDVPOGZQeRSqmmdgj6vvRYzuvjdEOi217fKdoQpyyQ8gEiliadFmDzqKOd3gTa16iabmJrPP2enCEspcavq00OUiTCG1C');
                        $session = \Stripe\Checkout\Session::create([
                            'payment_method_types' => ['card'],
                            'mode' => 'setup',
                            'customer' => $customer['id'], //mettre le $customer_id dans la base de donnée
                           'success_url' => 'http://127.0.0.1:8000/stripe/success?{CHECKOUT_SESSION_ID}', //A voir si lurl est bonne
                            'cancel_url' => 'http://127.0.0.1:8000/stripe/cancel',
                          ]);
                        // dd($session);
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
        'sk_test_51MCOUbDVPOGZQeRSqmmdgj6vvRYzuvjdEOi217fKdoQpyyQ8gEiliadFmDzqKOd3gTa16iabmJrPP2enCEspcavq00OUiTCG1C'
      );

      $customer=$stripe->customers->allPaymentMethods(
        'cus_MwgK5Uz3isdG6k', //a mettre dans base de données
        ['type' => 'card']
      );
      

    $payment_method=$stripe->paymentMethods->retrieve(
      $customer['data'][0]['id'],
      []
    );
    // dd($payment_method);
     
    $transac=$stripe->paymentIntents->create([
      'payment_method_types' => ['card'],
      'amount' => 8000,
      'currency' => 'eur',
      'customer' => 'cus_MwgK5Uz3isdG6k', //a mettre dans base de données
      'payment_method' => $payment_method,
    ]);
    return "transaction réussie";

  
    }



    public function success() {

      
          return view('stripe.success');
    }
    public function cancel() {

      
          return view('stripe.cancel');
    }

}
