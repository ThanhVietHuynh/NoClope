<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index(){
        $contacts = Contact::where('user_id',Auth::user()->id)->get();

        return response()->json(['contacts' => $contacts]);
    }

    public function store(Request $request) {


        $request->validate([
            'number_phone' => 'required|numeric',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
        ]);

        $contact = Contact::create([
            'number_phone' => $request->number_phone,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'user_id' => $request->user_id = Auth::user()->id,
        ]);

        return response()->json(['message' => "Contact créer.",'contact' => $contact],201);
    }
}
