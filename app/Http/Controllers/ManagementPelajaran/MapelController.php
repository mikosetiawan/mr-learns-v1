<?php

namespace App\Http\Controllers\ManagementPelajaran;

use App\Http\Controllers\Controller;
use App\Models\ManagementPelajaran\Mapel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MapelController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Mapel::select(['id', 'nama', 'status', 'created_at']);

            return DataTables::of($data)
                ->addIndexColumn() // Ini akan menambahkan DT_RowIndex
                ->addColumn('action', function ($row) {
                    $actionBtn = '<button onclick="openEditModal(' . $row->id . ')" class="edit btn btn-success btn-sm">Edit</button> ';
                    $actionBtn .= '<button onclick="deleteData(' . $row->id . ')" class="delete btn btn-danger btn-sm">Delete</button>';
                    return $actionBtn;
                })
                ->editColumn('created_at', function ($row) {
                    return date('d-m-Y H:i:s', strtotime($row->created_at));
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.siswa.mapel');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'status' => 'required|string|in:Aktif,Tidak Aktif'
        ]);

        $semester = Mapel::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data semester berhasil ditambahkan'
        ]);
    }

    public function edit($id)
    {
        $semester = Mapel::findOrFail($id);
        return response()->json($semester);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'status' => 'required|string|in:Aktif,Tidak Aktif'
        ]);

        $semester = Mapel::findOrFail($id);
        $semester->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data semester berhasil diperbarui'
        ]);
    }

    public function destroy($id)
    {
        $semester = Mapel::findOrFail($id);
        $semester->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data semester berhasil dihapus'
        ]);
    }
}
