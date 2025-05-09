<?php

namespace App\Http\Controllers\api;

use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiswaController extends Controller
{
    public function GetSiswa()
{
    try {
        $data_siswa = Siswa::with('guruKelas')->get();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil mendapatkan data siswa',
            'data' => $data_siswa,
        ], 200);

    } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => 'Gagal mendapatkan data siswa',
            'error' => $th->getMessage(),
        ], 500);
    }
}

public function SetSiswa(Request $request)
{
    try {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|unique:siswa,nis',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:500',
            'no_telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:siswa,email',
            'guru_kelas_id' => 'nullable|integer|exists:guru_kelas,id_guru_kelas',
        ], [
            'nama.required' => 'Nama siswa harus diisi!',
            'nis.required' => 'NIS harus diisi!',
            'nis.unique' => 'NIS sudah digunakan!',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih!',
            'tempat_lahir.required' => 'Tempat lahir harus diisi!',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi!',
            'alamat.required' => 'Alamat harus diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.unique' => 'Email sudah digunakan!',
            'guru_kelas_id.exists' => 'Guru kelas tidak ditemukan!',
        ]);

        $siswa = Siswa::create([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
            'email' => $request->email,
            'guru_kelas_id' => $request->guru_kelas_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Berhasil menambahkan data siswa',
            'data_siswa' => $siswa
        ], 201);

    } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => 'Gagal menambahkan data siswa',
            'error' => $th->getMessage(),
        ], 500);
    }

}

public function updateSiswa(Request $request)
{
    try {
        $request->validate([
            'id' => 'required|integer|exists:siswa,id_siswa',
            'nama' => 'required|string|max:255',
            'nis' => 'required|string|unique:siswa,nis,' . $request->id . ',id_siswa',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:500',
            'no_telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:siswa,email,' . $request->id . ',id_siswa',
            'guru_kelas_id' => 'nullable|integer|exists:guru_kelas,id_guru_kelas',
        ], [
            'id.required' => 'ID siswa harus diisi!',
            'id.exists' => 'Data siswa tidak ditemukan!',
            'nis.unique' => 'NIS sudah digunakan!',
            'email.unique' => 'Email sudah digunakan!',
        ]);

        $siswa = Siswa::find($request->id);

        $siswa->update([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
            'email' => $request->email,
            'guru_kelas_id' => $request->guru_kelas_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Berhasil memperbarui data siswa',
            'data_siswa' => $siswa
        ]);

    } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => 'Gagal memperbarui data siswa',
            'error' => $th->getMessage(),
        ], 500);
    }
}

public function deleteSiswa(Request $request)
{
    try {
        $request->validate([
            'id' => 'required|integer|exists:siswa,id_siswa',
        ], [
            'id.required' => 'ID siswa harus diisi!',
            'id.exists' => 'Data siswa tidak ditemukan!',
        ]);

        $siswa = Siswa::find($request->id);

        Siswa::destroy($request->id);

        return response()->json([
            'status' => true,
            'message' => 'Berhasil menghapus data siswa',
            'data_terhapus' => $siswa
        ]);

    } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => 'Gagal menghapus data siswa',
            'error' => $th->getMessage(),
        ], 500);
    }
}



}
