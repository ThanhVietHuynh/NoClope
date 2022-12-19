<?php

namespace App\Console;

use App\Models\Contact;
use App\Models\Cracking;
use App\Models\Project;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Auth;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    protected  $commands = [

        //  Commands\TransacWeek::class,
    ];




    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            // try { //Création de la transaction dans la base de données

                //Reccupere les crackings du lundi au lundi
                $date_day=now();
                $date_week = now()->subDay(7); //date de 7 jours avant

                //Boucle pour effectuer le prélèvement sur l'ensemble des utilisateurs
                $users = User::all();
                foreach ($users->key as $item) {
                    
               

                //permet d'avoir la somme des cigarrettes fumées des 7derniers jours
                $iduser=$item['id'];
                $number_cig_smoked = Cracking::where('user_id', $iduser)
                    ->where('created_at', '>', $date_week)
                    ->sum('number_smoked_cigarette_max');

                $transaction = Transaction::where('user_id', $iduser)->get();
                $project = Project::where('user_id', $iduser)->first();

                $amount = $number_cig_smoked * ($project['price_pack'] / 20); //20 est le nombre de cigarette par paquet

                $transaction = [
                    'date_transaction' => $date_day, 
                    'amount' => $amount,
                    'user_id' => $iduser,
                    'project_id' => $project['id'],
                ];

                $debit =  Transaction::create($transaction);

                // try { //Si transaction stripe marche 

                    $stripe = new \Stripe\StripeClient(
                        env('STRIPE_SECRET')
                    );


                    $idconnecte = $iduser;
                    $userconnecte = User::FindOrFail($idconnecte);



                    $customer = $stripe->customers->allPaymentMethods(
                        $userconnecte['stripe_id'],
                        ['type' => 'card']
                    );


                    $payment_method = $stripe->paymentMethods->retrieve(
                        $customer['data'][0]['id'],
                        []
                    );


                    $transac = $stripe->paymentIntents->create([
                        'payment_method_types' => ['card'],
                        'amount' => $amount * 100,
                        'currency' => 'eur',
                        'customer' => $userconnecte['stripe_id'],
                        'payment_method' => $payment_method,
                    ]);

                    //Demande la confirmation du paiment, à voir avec Timotée si la validation doit venir du client ou si automatique
                    $stripe->paymentIntents->confirm($transac->id, ['payment_method' => $payment_method]);

                }


                //     return response()->json([
                //         'debit' => $debit,
                //         'message' => 'Transaction stripe réalisée avec succes'
                //     ], 200);
                // }
                // //Si transaction stripe ne marche pas
                // catch (\Exception $e) {
                //     return response()->json([
                //         'error' => "Erreur lors de la transaction stripe"
                //     ], 404);
                // }
            // }
            // // Si création de la transaction ne marche pas dans la base de données
            // catch (\Exception $e) {
            //     return response()->json([
            //         'error' => "Erreur lors de la création de la transaction"
            //     ], 404);
            // }
        })->everyMinute();
        // })->daily();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
