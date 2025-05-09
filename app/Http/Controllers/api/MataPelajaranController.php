<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    public function GetMataPelajaran()
    {
        try {
            return response()->json(
                [
                    $data_mapel = MataPelajaran::with('guru')->get(),
                    'status' => true,
                    'message' => 'Berhasil mendapatkan data mata pelajaran',
                    // 'data' => 'berikut adalah data mata pelajaran di database' . MataPelajaran::all(),
                ],
                200,
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Gagal mendapatkan data mata pelajaran',
                    'error' => $th->getMessage(),
                ],
                500,
            );
        }
    }


   

public function SetMataPelajaran(Request $request)
{
    try {
        $request->validate([
            'nama' => 'required|string|max:255',
            'guru_kelas_id' => 'required|integer|exists:guru_kelas,id_guru_kelas',
        ], [
            'nama.required' => 'Nama mata pelajaran harus diisi!',
            'guru_kelas_id.required' => 'Guru kelas harus dipilih!',
            'guru_kelas_id.exists' => 'Guru kelas tidak ditemukan!',
        ]);

        $mapel = MataPelajaran::create([
            'nama' => $request->nama,
            'guru_kelas_id' => $request->guru_kelas_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Berhasil menambahkan data mata pelajaran',
            'data_mapel' => $mapel
        ], 201);

    } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => 'Gagal menambahkan data mata pelajaran',
            'error' => $th->getMessage(),
        ], 500);
    }
}

public function updateMataPelajaran(Request $request)
{
    try {
        $request->validate([
            'id' => 'required|integer|exists:mata_pelajaran,id_mata_pelajaran',
            'nama' => 'required|string|max:255',
            'guru_kelas_id' => 'required|integer|exists:guru_kelas,id_guru_kelas',
        ], [
            'id.required' => 'ID mata pelajaran harus diisi!',
            'id.exists' => 'Data mata pelajaran tidak ditemukan!',
            'nama.required' => 'Nama mata pelajaran harus diisi!',
            'guru_kelas_id.required' => 'Guru kelas harus dipilih!',
            'guru_kelas_id.exists' => 'Guru kelas tidak ditemukan!',
            'guru_kelas_id.integer' => 'ID guru kelas harus berupa angka!',
        ]);

        $mapel = MataPelajaran::find($request->id);

        $mapel->update([
            'nama' => $request->nama,
            'guru_kelas_id' => $request->guru_kelas_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Berhasil memperbarui data mata pelajaran',
            'data_mapel' => $mapel
        ]);

    } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => 'Gagal memperbarui data mata pelajaran',
            'error' => $th->getMessage(),
        ], 500);
    }
}

public function deleteMataPelajaran(Request $request)
{
    try {
        $request->validate([
            'id' => 'required|integer|exists:mata_pelajaran,id_mata_pelajaran',
        ], [
            'id.required' => 'ID mata pelajaran harus diisi!',
            'id.exists' => 'Data mata pelajaran tidak ditemukan!',
        ]);

        $mapel = MataPelajaran::find($request->id);

        MataPelajaran::destroy($request->id);

        return response()->json([
            'status' => true,
            'message' => 'Berhasil menghapus data mata pelajaran',
            'data_terhapus' => $mapel
        ]);

    } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => 'Gagal menghapus data mata pelajaran',
            'error' => $th->getMessage(),
        ], 500);
    }
}


}