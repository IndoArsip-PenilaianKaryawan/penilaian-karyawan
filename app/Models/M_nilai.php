<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_nilai extends Model
{
    use HasFactory;

    protected $table = 'm_nilai';

    protected $casts = [
        'indeks' => 'array', // Mengonversi kolom indeks dari JSON ke array
        'nilai_approval_1' => 'array', // Mengonversi kolom nilai_approval_1 dari JSON ke array
        'nilai_approval_2' => 'array', // Mengonversi kolom nilai_approval_2 dari JSON ke array
    ];


    protected $fillable = [
        'indeks',
        'nilai_approval_1',
        'nilai_approval_2',
        'status_approval_1',
        'status_approval_2'
    ];

    public function karyawan()
    {
        return $this->belongsTo(M_karyawan::class, 'id_karyawan');
    }



    public function periode()
    {
        return $this->belongsTo(M_periode::class, 'id_periode');
    }

    public function scopeDeleteNilai($query, $id)
    {
        return $query->where('id', $id)->delete();
    }

    public function scopeEditNilai($query, $id)
    {
        return $query->where('id', $id)->first();
    }

    public function scopeAddNilai($query, $data)
    {
        return $query->insert($data);
    }

    public function scopeUpdateNilai($query, $data, $id)
    {
        return $query->where('id', $id)->update($data);
    }




}
