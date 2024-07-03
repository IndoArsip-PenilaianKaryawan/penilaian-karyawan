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
