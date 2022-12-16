<?php

namespace App\Http\Controllers;

use App\Models\Cracking;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cracking = Cracking::where('user_id',Auth::user()->id)->get();

        $number_cig_smoked=Cracking::where('user_id',Auth::user()->id)->sum('number_smoked_cigarette');
        
        return response()->json(
            ['cracking' => $cracking,
            'number_cig_smoked' => $number_cig_smoked,
        ],
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
            'number_smoked_cigarette' => 'required|numeric',
            'date_cracking' => 'required|string',
        ]);
        $getproject = Project::where('user_id', Auth::user()->id)->first();
        $idproject = $getproject['id'];
        $consumption = $getproject['consumption'];

        //Le if permet de mettre le nombre de cigarette fummées à la valeur de la consommation si l'utilisateur à dépasser
        $number_smoked_cigarette = $request->number_smoked_cigarette;
        $number_smoked_cigarette_max=$number_smoked_cigarette;
        if($number_smoked_cigarette>$consumption){
            $number_smoked_cigarette_max=$consumption;
        };


        $cracking = Cracking::create([
            'user_id'=>Auth::user()->id,
            'number_smoked_cigarette' => $number_smoked_cigarette,
            'number_smoked_cigarette_max' => $number_smoked_cigarette_max,
            'date_cracking' => $request->date_cracking,
            'project_id' => $idproject
        
        ]);

        return response()->json(['message' => "Formulaire valider.",'PROJET' => $getproject],201);
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
