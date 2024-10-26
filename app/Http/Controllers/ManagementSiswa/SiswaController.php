<?php

namespace App\Http\Controllers\ManagementSiswa;

use App\Http\Controllers\Controller;
use App\Models\ManagementSiswa\Kelas;
use App\Models\ManagementSiswa\Semester;
use App\Models\ManagementSiswa\Siswa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Siswa::with(['kelas', 'semester'])->select('*');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<button onclick="openEditModal(' . $row->id . ')" class="edit btn btn-success btn-sm">Edit</button> ';
                    $actionBtn .= '<button onclick="deleteData(' . $row->id . ')" class="delete btn btn-danger btn-sm">Delete</button>';
                    return $actionBtn;
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d/m/Y H:i');
                })
                ->editColumn('id_kelas', function ($row) {
                    return $row->kelas ? $row->kelas->nama . " " . $row->kelas->tipe : '-';
                })
                ->editColumn('id_semester', function ($row) {
                    return $row->semester ? $row->semester->nama : '-';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        // Load data kelas dan semester untuk form
        $kelas = Kelas::orderBy('nama', 'asc')->get();
        $semester = Semester::orderBy('nama', 'asc')->get();

        return view('pages.siswa.siswa', compact('kelas', 'semester'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jk' => 'required',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'id_kelas' => 'required|exists:kelas,id',
            'id_semester' => 'required|exists:semesters,id'
        ]);

        $siswa = Siswa::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data siswa berhasil ditambahkan',
            'data' => $siswa
        ], 201);
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return response()->json($siswa);
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jk' => 'required|in:L,P',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'id_kelas' => 'required|exists:kelas,id',
            'id_semester' => 'required|exists:semesters,id'
        ]);

        $siswa->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data siswa berhasil diperbarui',
            'data' => $siswa
        ]);
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data siswa berhasil dihapus'
        ]);
    }
}
