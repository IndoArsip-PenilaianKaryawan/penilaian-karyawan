<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_departement extends Model
{
    use HasFactory;

    protected $table = 'm_departement';

    protected $fillable = [
        'nama_departement',
    ];

    public function bidang()
    {
        return $this->hasMany(M_bidang::class, 'id_departement');
    }

}
