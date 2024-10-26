<?php

namespace App\Http\Controllers\ManagementPelajaran;

use App\Http\Controllers\Controller;
use App\Models\ManagementPelajaran\Nilai;
use App\Models\ManagementPelajaran\Mapel;
use App\Models\ManagementSiswa\Kelas;
use App\Models\ManagementSiswa\Semester;
use App\Models\ManagementSiswa\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Nilai::with(['siswa.kelas', 'siswa.semester', 'mapel'])
                ->select('nilais.*');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return view('components.action-buttons', [
                        'id' => $row->id,
                        'editButton' => true,
                        'deleteButton' => true
                    ])->render();
                })
                ->addColumn('siswa.nama', function ($row) {
                    return $row->siswa ? $row->siswa->nama : '-';
                })
                ->addColumn('siswa.kelas.nama', function ($row) {
                    return $row->siswa->kelas ? $row->siswa->kelas->nama : '-';
                })
                ->addColumn('siswa.semester.nama', function ($row) {
                    return $row->siswa->semester ? $row->siswa->semester->nama : '-';
                })
                ->addColumn('mapel.nama', function ($row) {
                    return $row->mapel ? $row->mapel->nama : '-';
                })
                ->editColumn('nilai', function ($row) {
                    return $row->nilai;
                })
                ->editColumn('grade', function ($row) {
                    return '<span class="badge bg-' . $this->getGradeBadgeColor($row->grade) . '">' . $row->grade . '</span>';
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at ? date('d/m/Y H:i', strtotime($row->created_at)) : '-';
                })
                ->rawColumns(['action', 'grade'])
                ->make(true);
        }

        $mapel = Mapel::all();
        $siswa = Siswa::with(['kelas', 'semester'])->get();
        $kelas = Kelas::all();
        $semester = Semester::all();

        return view('pages.penilaian.nilai', compact('mapel', 'siswa', 'kelas', 'semester'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_siswa' => 'required|exists:siswas,id',
            'id_mapel' => 'required|exists:mapels,id',
            'nilai' => 'required|numeric|min:0|max:100',
        ]);

        // Check if nilai already exists for this siswa and mapel
        $existingNilai = Nilai::where('id_siswa', $validated['id_siswa'])
            ->where('id_mapel', $validated['id_mapel'])
            ->first();

        if ($existingNilai) {
            return response()->json([
                'success' => false,
                'message' => 'Nilai untuk siswa dan mata pelajaran ini sudah ada'
            ], 422);
        }

        // Calculate grade based on nilai
        $validated['grade'] = $this->calculateGrade($validated['nilai']);

        $nilai = Nilai::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data nilai berhasil ditambahkan',
            'data' => $nilai
        ], 201);
    }

    public function edit($id)
    {
        $nilai = Nilai::with(['siswa.kelas', 'siswa.semester', 'mapel'])->findOrFail($id);
        return response()->json($nilai);
    }

    public function update(Request $request, $id)
    {
        $nilai = Nilai::findOrFail($id);

        $validated = $request->validate([
            'id_siswa' => 'required|exists:siswas,id',
            'id_mapel' => 'required|exists:mapels,id',
            'nilai' => 'required|numeric|min:0|max:100',
        ]);

        // Check if nilai already exists for different record
        $existingNilai = Nilai::where('id_siswa', $validated['id_siswa'])
            ->where('id_mapel', $validated['id_mapel'])
            ->where('id', '!=', $id)
            ->first();

        if ($existingNilai) {
            return response()->json([
                'success' => false,
                'message' => 'Nilai untuk siswa dan mata pelajaran ini sudah ada'
            ], 422);
        }

        // Calculate grade based on nilai
        $validated['grade'] = $this->calculateGrade($validated['nilai']);

        $nilai->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data nilai berhasil diperbarui',
            'data' => $nilai
        ]);
    }

    public function destroy($id)
    {
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data nilai berhasil dihapus'
        ]);
    }

    private function calculateGrade($nilai)
    {
        if ($nilai >= 85) {
            return 'A';
        } elseif ($nilai >= 75) {
            return 'B';
        } elseif ($nilai >= 65) {
            return 'C';
        } elseif ($nilai >= 50) {
            return 'D';
        } else {
            return 'E';
        }
    }

    private function getGradeBadgeColor($grade)
    {
        return [
            'A' => 'success',
            'B' => 'primary',
            'C' => 'warning',
            'D' => 'info',
            'E' => 'danger',
        ][$grade] ?? 'secondary';
    }
}
