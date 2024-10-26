<?php

namespace App\Models\ManagementSiswa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    
    protected $table = 'semesters';
    protected $fillable = [
        'nama',
        'status',
    ];


     // Relasi one-to-many dengan Siswa
     public function siswas()
     {
         return $this->hasMany(Siswa::class, 'id_semester');
     }
}
