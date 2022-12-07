<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'number_smoked_cigarette',
        'date_cracking',
        'user_id',
        'project_id',
    ];

    public function user() 
    { 
        return $this->belongsTo(User::class,'user_id','id'); 
    }
    public function project() 
    { 
        return $this->belongsTo(Project::class,'user_id','id'); 
    }
}
