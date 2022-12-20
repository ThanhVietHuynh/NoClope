<?php

namespace App\Http\Controllers;

use App\Models\Cracking;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use DateTime;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')
            ->join('projects','users.id','=','projects.user_id')
            ->select('users.*','projects.*')
            ->get();

            // $project = Project::where("user_id")->firstOrFail();
            // $cigarettes_per_day = $project->consumption;
            // $pack_price = $project->price_pack;
            // $date_created = $project->created_at;
            // $price_project = $project->price_goal;
    
            // // Les craquages de l'utilisateur
            // $crakings = Cracking::where("project_id", $project->id)->get();
    
            // // Date du jour
            // $current_date = Date::now();
    
    
    
            // // Calculs
            // $elapse_days =  $current_date->diff(new DateTime($date_created));
            // $not_smoked_cigarettes_expectation = $cigarettes_per_day * $elapse_days->days;
            // $smoked_cigarettes = 0;
    
            // if (count($crakings) > 0) {
            //     foreach ($crakings as $craking) {
            //         $smoked_cigarettes += $craking->number_smoked_cigarette;
            //     }
            // }
    
            // $saved = ($pack_price / 20) * ($not_smoked_cigarettes_expectation - $smoked_cigarettes);
            // if ($saved < 0) {
            //     $saved = 0;
            // }
            // $final = ($price_project - $saved);
            // $pourcentage = $saved  / $price_project * 100;
            // return response()->json(['pourcentage' => $pourcentage, 'final' => $final, 'saved' => $saved, 'price_project' => $price_project, 'project' => $project, "cigarettes_per_day" => $cigarettes_per_day, 'date_created' => $date_created, 'crakings' => $crakings, 'current_date' => $current_date, 'not_smoked_cigarettes_expectation' => $not_smoked_cigarettes_expectation, 'smoked_cigarettes' => $smoked_cigarettes, 'elapse_days' => $elapse_days]);
        
        
        return response()->json(['users' => $users]);
    }


      


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
