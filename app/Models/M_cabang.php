<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_cabang extends Model
{
    use HasFactory;

    protected $table = 'm_cabang';

    protected $fillable = [
        'nama',
    ];

    public function scopeDeleteCabang($query, $id)
    {
        return $query->where('id', $id)->delete();
    }


    public function scopeEditCabang($query, $id)
    {
        return $query->where('id', $id)->first();
    }


    public function scopeAddCabang($query, $data)
    {
        return $query->insert($data);
    }


    public function scopeUpdateCabang($query, $data, $id)
    {
        return $query->where('id', $id)->update($data);
    }

    public function scopeTotal($query)
    {
        return $query->count();
    }
}
