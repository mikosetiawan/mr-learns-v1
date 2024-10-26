<?php

namespace App\Models\ManagementSiswa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    
    protected $table = 'kelas';
    protected $fillable = [
        'nama',
        'tipe',
    ];

     // Relasi one-to-many dengan Siswa
     public function siswas()
     {
         return $this->hasMany(Siswa::class, 'id_kelas');
     }
}

