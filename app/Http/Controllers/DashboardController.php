<?php

namespace App\Http\Controllers;

use App\Models\ManagementPelajaran\Mapel;
use App\Models\ManagementPelajaran\Nilai;
use App\Models\ManagementSiswa\Kelas;
use App\Models\ManagementSiswa\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $mapel = Mapel::count();
        $kelas = Kelas::count();
        $siswa = Siswa::count();
        $total_nilai = Nilai::sum('nilai');

        $jml_nilai_rata_rata = $mapel > 0 ? round($total_nilai / $mapel, 2) : 0;

        // Fetching data for the chart
        $nilaiData = Nilai::selectRaw('id_mapel, AVG(nilai) as average_nilai')
            ->groupBy('id_mapel')
            ->get();

        $chartData = [];
        foreach ($nilaiData as $nilai) {
            $chartData[$nilai->id_mapel] = $nilai->average_nilai;
        }


        return view('dashboard', [
            'mapel' => $mapel,
            'kelas' => $kelas,
            'siswa' => $siswa,
            'jml_nilai' => $jml_nilai_rata_rata,
            'chartData' => $chartData,
        ]);
    }

    public function welcome()
    {
        return view('welcome');
    }
}
