<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'm_karyawan';

    protected $fillable = [
        'nama',
        'no_pegawai',
        'id_bidang',
        'id_atasan',
        'id_jabatan',
        'id_approval_1',
        'id_approval_2'
    ];

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'id_bidang');
    }

    public function atasan()
    {
        return $this->belongsTo(Users::class, 'id_atasan');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }

    public function approval1()
    {
        return $this->belongsTo(Users::class, 'id_approval_1');
    }

    public function approval2()
    {
        return $this->belongsTo(Users::class, 'id_approval_2');
    }

    public function scopeTotal($query)
    {
        return $query->count();
    }
}
