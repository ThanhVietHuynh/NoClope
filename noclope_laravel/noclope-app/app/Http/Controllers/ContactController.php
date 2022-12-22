<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;



class ContactController extends Controller
{
    use HasApiTokens, Notifiable;

    public function index(){
        $contacts = Contact::where('user_id',Auth::user()->id)->get();

        return response()->json(['contacts' => $contacts]);
    }

    public function store(Request $request) {


        $request->validate([
            'email' => 'required|email',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
        ]);
        
        $tokencontact = mt_rand(1000000, 9000000);
        $contact = Contact::create([
            'email' => $request->email,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'user_id' => $request->user_id = Auth::user()->id,
        
        ]);

        $contact->remember_token = $tokencontact;
        $contact->save();


        $data = array(
            'firstname'=> $contact->firstname,
            'email'=>$contact->email,
            'remember_token' => $contact->remember_token

        );


    //envoi du mail au contact pour demande d'ange


    Mail::send('mail', $data, function ($message) use ($contact,) {
        $message->to($contact->email)->subject('Équipe-Noclope:Ange gardien');
        $message->from('noclopeteam@contact.fr', 'No clope');
  });

        return response()->json(['message' => "Contact créer.",'contact' => $contact],201);
    }

    public function addContact(Request $request, $remember_token){
        $contact = Contact::where('remember_token', '=', $remember_token)->first();

        $contact->is_agreed = 1;
        $contact->save();
    }
    public function deleteContact(Request $request, $remember_token){
        $contact = Contact::where('remember_token', '=', $remember_token)->first();

        $contact->delete();
    }
}
