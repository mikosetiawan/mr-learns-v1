<?php

namespace App\Models\ManagementPelajaran;

use App\Models\ManagementSiswa\Kelas;
use App\Models\ManagementSiswa\Siswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nilai extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'nilais';

    protected $fillable = [
        'nilai',
        'id_siswa',
        'id_mapel',
        'grade'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel');
    }
}
