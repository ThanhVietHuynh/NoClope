<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function index() {

        // \Stripe\Stripe::setApiKey('pk_test_51MCOUbDVPOGZQeRSt0NeQycXNakIXX5n6X2xA1vrXkZEjviYJ4SpOgNnCLYJLXbWfuuxJbm4FDEGmzDlQzITCXzv00Vqv5gfdo');
        // $session = \Stripe\Checkout\Session::create([
        //     'payment_method_types' => ['card'],
        //     'mode' => 'setup',
        //     'customer' => '{{CUSTOMER_ID}}',
        //     'success_url' => 'https://example.com/success?session_id={CHECKOUT_SESSION_ID}',
        //     'cancel_url' => 'https://example.com/cancel',
        //   ]);
            return view('stripe.index');
    }
    public function create() {

        $stripe = new \Stripe\StripeClient(
            'sk_test_51MCOUbDVPOGZQeRSqmmdgj6vvRYzuvjdEOi217fKdoQpyyQ8gEiliadFmDzqKOd3gTa16iabmJrPP2enCEspcavq00OUiTCG1C'
          );
          $stripe->customers->create([
            'description' => 'My First Test Customer (created for API docs at https://www.stripe.com/docs/api)',
          ]);
          return response()->json(['message' => 'Customers stripe créé', 'stripe' => $stripe], 200);
    }
}
