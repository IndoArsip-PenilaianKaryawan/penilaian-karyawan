<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_kompetensi extends Model
{
    use HasFactory;

    // Menentukan nama tabel
    protected $table = 'm_kompetensi';
    
    public function scopeDeleteKompetensi($query, $id)
    {
        return $query->where('id', $id)->delete();
    }

    public function scopeEditKompetensi($query, $id)
    {
        return $query->where('id', $id)->first();
    }

    public function scopeAddKompetensi($query, $data)
    {
        return $query->insert($data);
    }

    public function scopeUpdateKompetensi($query, $data, $id)
    {
        return $query->where('id', $id)->update($data);
    }
}
