<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'number_phone' => 'required|numeric',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
        ]);
    }
}
