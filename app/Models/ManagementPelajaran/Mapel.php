<?php

namespace App\Models\ManagementPelajaran;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'mapels';

    protected $fillable = [
        'nama',
        'status'
    ];

      // Relasi ke Nilai
      public function nilais()
      {
          return $this->hasMany(Nilai::class, 'id_mapel');
      }
}
