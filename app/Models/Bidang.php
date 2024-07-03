<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;

    protected $table = 'm_bidang';

    protected $fillable = [
        'nama_bidang',
        'id_departement',
    ];

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class, 'id_bidang');
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_departement');
    }

}
