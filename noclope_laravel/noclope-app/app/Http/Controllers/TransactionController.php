<?php

namespace App\Http\Controllers;

use App\Models\Cracking;
use App\Models\Project;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::where('user_id',Auth::user()->id)->get();
 
        return response()->json([
             'transactions' => $transaction,           
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
    }
     

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      try { //Création de la transaction dans la base de données

            //Reccupere les crackings du lundi au lundi
            $date_week = now()->subDay(7); //date de 7 jours avant

            //permet d'avoir la somme des cigarrettes fumées des 7derniers jours
            $number_cig_smoked=Cracking::where('user_id', Auth::user()->id)
                                        ->where('created_at', '>', $date_week)
                                        ->sum('number_smoked_cigarette_max');

            $transaction = Transaction::where('user_id',Auth::user()->id)->get();
            $project = Project::where('user_id',Auth::user()->id)->first();

            $amount=$number_cig_smoked*($project['price_pack']/20); //20 est le nombre de cigarette par paquet
           
            $transaction = [
              'date_transaction' => '2022-12-09 12:17:21',
              'amount' => $amount,
              'user_id' => Auth::user()->id,
              'project_id' => $project['id'],
              ];

            $debit=  Transaction::create($transaction);
       
            try { //Si transaction stripe marche 

              $stripe = new \Stripe\StripeClient(
                env('STRIPE_API_KEY')
              );
        
            
              $idconnecte=Auth::user()->id;
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
              'amount' => $amount*100,
              'currency' => 'eur',
              'customer' => $userconnecte['stripe_id'], 
              'payment_method' => $payment_method,
            ]);
        
              //Demande la confirmation du paiment, à voir avec Timotée si la validation doit venir du client ou si automatique
            $stripe->paymentIntents->confirm($transac->id, ['payment_method' => $payment_method]);
        
      
              
              
              return response()->json(['debit' => $debit,  
                                       'message' => 'Transaction stripe réalisée avec succes'
            ],200);
              
          }
            //Si transaction stripe ne marche pas
            catch (\Exception $e) { 
                 return response()->json(['error' => "Erreur lors de la transaction stripe"                       
            ],404);
              }


            
        
        }
        //Si création de la transaction ne marche pas dans la base de données
        catch (\Exception $e) {
          return response()->json(['error' => "Erreur lors de la création de la transaction"                      
        ],404);
        }
       


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
