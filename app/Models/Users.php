<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $table = 'm_users';

    protected $fillable = [
        'username',
        'password',
        'name',
    ];

    public function atasan()
    {
        return $this->hasMany(Karyawan::class, 'id_atasan');
    }
    
    public function approval1()
    {
        return $this->hasMany(Karyawan::class, 'id_approval_1');
    }

    public function approval2()
    {
        return $this->hasMany(Karyawan::class, 'id_approval_2');
    }

}
