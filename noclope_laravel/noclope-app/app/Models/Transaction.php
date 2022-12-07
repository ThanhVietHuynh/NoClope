<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_transaction',
        'amount',
        'project_id',
        'user_id',
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
