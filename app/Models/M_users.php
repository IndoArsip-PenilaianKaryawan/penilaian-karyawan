<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class M_users extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'm_users';

    protected $fillable = [
        'username',
        'password',
        'name',
    ];

    public function scopeDeleteUser($query, $id)
    {
        return $query->where('id', $id)->delete();
    }

    public function scopeEditUser($query, $id)
    {
        return $query->where('id', $id)->first();
    }

    public function scopeAddUser($query, $data)
    {
        return $query->insert($data);
    }

    public function scopeUpdateUser($query, $data, $id)
    {
        return $query->where('id', $id)->update($data);
    }

    public function scopeTotal($query)
    {
        return $query->count();
    }

    public function atasan()
    {
        return $this->hasMany(M_Karyawan::class, 'id_atasan');
    }

    public function approval1()
    {
        return $this->hasMany(M_Karyawan::class, 'id_approval_1');
    }

    public function approval2()
    {
        return $this->hasMany(M_Karyawan::class, 'id_approval_2');
    }

}