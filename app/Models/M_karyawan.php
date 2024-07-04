<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_karyawan extends Model
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
        return $this->belongsTo(M_bidang::class, 'id_bidang');
    }

    public function atasan()
    {
<<<<<<< HEAD
        return $this->belongsTo(M_user::class, 'id_atasan');
=======
        return $this->belongsTo(M_users::class, 'id_atasan');
>>>>>>> origin/users
    }

    public function jabatan()
    {
        return $this->belongsTo(M_jabatan::class, 'id_jabatan');
    }

    public function approval1()
    {
<<<<<<< HEAD
        return $this->belongsTo(M_user::class, 'id_approval_1');
=======
        return $this->belongsTo(M_users::class, 'id_approval_1');
>>>>>>> origin/users
    }

    public function approval2()
    {
<<<<<<< HEAD
        return $this->belongsTo(M_user::class, 'id_approval_2');
=======
        return $this->belongsTo(M_users::class, 'id_approval_2');
    }

    public function scopeTotal($query)
    {
        return $query->count();
>>>>>>> origin/users
    }
}
