<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'number_phone' => 'required|numeric',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
        ]);

        Contact::create([
            'number_phone' => $request->number_phone,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
        ]);

        return response();
    }
}
