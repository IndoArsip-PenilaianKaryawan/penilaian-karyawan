<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_user extends Model
{
    use HasFactory;

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

}
