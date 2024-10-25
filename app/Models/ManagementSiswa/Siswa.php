<?php

namespace App\Models\ManagementSiswa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'siswas';
    protected $fillable = [
        'nama',
        'no_tlp',
        'jk',
        'alamat',
    ];
}
