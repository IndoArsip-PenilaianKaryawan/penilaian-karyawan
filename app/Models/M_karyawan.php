<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class M_karyawan extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'm_karyawan';

    protected $fillable = [
        'nama',
        'no_pegawai',
        'id_bidang',
        'id_atasan',
        'id_jabatan',
        'id_approval_1',
        'id_approval_2',
        'id_cabang',
        'password',
        'is_penilai',
    ];

    public function bidang()
    {
        return $this->belongsTo(M_bidang::class, 'id_bidang');
    }

    public function cabang()
    {
        return $this->belongsTo(M_cabang::class, 'id_cabang');
    }

    public function atasan()
    {
        return $this->belongsTo(M_karyawan::class, 'id_atasan');
    }

    public function jabatan()
    {
        return $this->belongsTo(M_jabatan::class, 'id_jabatan');
    }

    public function approval1()
    {
        return $this->belongsTo(M_karyawan::class, 'id_approval_1');
    }

    public function approval2()
    {
        return $this->belongsTo(M_karyawan::class, 'id_approval_2');
    }
}
