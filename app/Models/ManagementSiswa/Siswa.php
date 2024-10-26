<?php

namespace App\Models\ManagementSiswa;

use App\Models\ManagementPelajaran\Nilai;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'siswas';
    protected $fillable = [
        'nama',
        'jk',
        'no_hp',
        'alamat',
        'id_kelas',
        'id_semester',
    ];


     // Relasi ke Kelas
     public function kelas()
     {
         return $this->belongsTo(Kelas::class, 'id_kelas');
     }
 
     // Relasi ke Semester
     public function semester()
     {
         return $this->belongsTo(Semester::class, 'id_semester');
     }
 
     // Relasi ke Nilai
     public function nilais()
     {
         return $this->hasMany(Nilai::class, 'id_siswa');
     }

}
