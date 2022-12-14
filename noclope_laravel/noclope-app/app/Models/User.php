<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'lastname',
        'firstname',
        'email',
        'password',
        'number_cb',
        'date_expiry',
        'project_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function projects() 
    { 
        return $this->hasOne(Project::class,'user_id','id'); 
    }
    public function transactions() 
    { 
        return $this->hasMany(Transaction::class,'user_id','id'); 
    }
    public function crackings() 
    { 
        return $this->hasMany(Cracking::class,'user_id','id'); 
    }
    public function contacts() 
    { 
        return $this->hasMany(Contact::class,'user_id','id'); 
    }
}
