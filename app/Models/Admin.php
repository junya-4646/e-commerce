<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
        
    use HasApiTokens, Notifiable;
    
    protected $fillable = [
        'name',
        'email',
        'tel',
        'post',
        'address',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}
