<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class M_admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'm_admin';

    protected $fillable = [
        'username',
        'password',
        'name',
    ];
}