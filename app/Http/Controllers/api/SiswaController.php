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
        //  cari id untuk memastikan ada 
        $siswa = Siswa::findOrFail($request->id);

        // Validasi field yang dikirim saja
        $rules = [
            'id' => 'required|integer|exists:siswa,id_siswa',
        ];

        if ($request->has('nama')) {
            $rules['nama'] = 'string|max:255';
        }

        if ($request->has('nis')) {
            $rules['nis'] = 'string|unique:siswa,nis,' . $request->id . ',id_siswa';
        }

        if ($request->has('jenis_kelamin')) {
            $rules['jenis_kelamin'] = 'in:Laki-laki,Perempuan';
        }

        if ($request->has('tempat_lahir')) {
            $rules['tempat_lahir'] = 'string|max:255';
        }

        if ($request->has('tanggal_lahir')) {
            $rules['tanggal_lahir'] = 'date';
        }

        if ($request->has('alamat')) {
            $rules['alamat'] = 'string|max:500';
        }

        if ($request->has('no_telepon')) {
            $rules['no_telepon'] = 'nullable|string|max:20';
        }

        if ($request->has('email')) {
            $rules['email'] = 'email|unique:siswa,email,' . $request->id . ',id_siswa';
        }

        if ($request->has('guru_kelas_id')) {
            $rules['guru_kelas_id'] = 'nullable|integer|exists:guru_kelas,id_guru_kelas';
        }

        // Jalankan validasi
        $validated = $request->validate($rules, [
            'id.required' => 'ID siswa harus diisi!',
            'id.exists' => 'Data siswa tidak ditemukan!',
            'nis.unique' => 'NIS sudah digunakan!',
            'email.unique' => 'Email sudah digunakan!',
        ]);

        // Update data yang dikirim saja
        $siswa->fill($validated);
        $siswa->save();

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
