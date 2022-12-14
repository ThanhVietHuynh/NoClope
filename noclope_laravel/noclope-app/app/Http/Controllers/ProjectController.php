<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Fortify;
use Laravel\Sanctum\HasApiTokens;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $projects = Project::where('user_id',Auth::user()->id)->get();
        return response()->json(
            ['projects' => $projects],
            200
        );
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

        $request->validate([
            'goal' => 'required|string',
            'price_goal' => 'required|numeric',
            'price_pack' => 'required|numeric',
            'consumption' => 'required|integer',
        ]);

        $project = Project::create([
            'goal' => $request->goal,
            'price_goal' => $request->price_goal,
            'price_pack' => $request->price_pack,
            'consumption' => $request->consumption,
            'user_id' => $request->user_id = 1,
            // 'price_goal_now'=>$request->price_goal_now,
            // 'transaction_id'=>$request->transaction_id,
            // 'cracking_id'=>$request->cracking_id,
        ]);

        return response()->json(['message' => 'Votre projet a été créé', 'project' => $project], 201);
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
