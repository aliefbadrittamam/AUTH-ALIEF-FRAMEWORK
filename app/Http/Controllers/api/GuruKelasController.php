<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\guru_kelas;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class GuruKelasController extends Controller
{
    public function GetDataGuru(){
        
        try {
            return response()->json([
                'status' => true,
                'message' => 'Berikut data Data guru kelas anda',
                'data_guru' => 'Berikut adalah data2 guru di database'.guru_kelas::all(),
                'total_data' => guru_kelas::count(),
            'timestamp' => now(),
                'data di ambil pada : ' => now()->format('Y-m-d H:i:s'),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengambil data',
                'error' => $th->getMessage(),
            ]);
        }
    }

    public function SetDataGuru(Request $request){
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'nip' => 'required|string|max:255|unique:guru_kelas,nip',
                'kelas' => 'required|string|max:255',
            ],[
                'nama.required' => 'Nama harus diisi!',
                'nip.required' => 'NIP harus diisi!',
                'kelas.required' => 'Kelas harus diisi!',
            ]);
    
            $guru = guru_kelas::create([
                'nama' => $request->nama,
                'nip' => $request->nip,
                'kelas' => $request->kelas,
                'email' => $request->email,
                'no_telepon' => $request->no_telepon,
                'alamat' => $request->alamat,
            ]);
    
            return response()->json([
                'status' => true,
                'message' => 'Berhasil menambahkan data guru kelas',
                'data_guru' => $guru
            ], 201);
    
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menambahkan data guru kelas',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
    

    public function UpdateDataGuru(Request $request){
        try {
            $request->validate([
                'id' => 'required|integer|exists:guru_kelas,id_guru_kelas',
                'nama' => 'required|string|max:255',
                'nip' => 'required|string|max:255|unique:guru_kelas,nip,' . $request->id . ',id_guru_kelas',
                'kelas' => 'required|string|max:255',
            ],[
                'id.required' => 'ID guru harus dikirim.',
                'nama.required' => 'Nama harus diisi!',
                'nip.required' => 'NIP harus diisi!',
                'kelas.required' => 'Kelas harus diisi!',
            ]);
    
            $guru = guru_kelas::where('id_guru_kelas', $request->id)->first();
    
            if (!$guru) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data guru kelas tidak ditemukan',
                ], 404);
            }
    
            $guru->update([
                'nama' => $request->nama,
                'nip' => $request->nip,
                'kelas' => $request->kelas,
            ]);
    
            return response()->json([
                'status' => true,
                'message' => 'Berhasil memperbarui data guru kelas',
                'data' => $guru
            ]);
    
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal memperbarui data guru kelas',
                'error' => $th->getMessage(),
            ], 500);
        }
    }
    

    public function HapusDataGuru(Request $request){
        try {
           
            $request->validate([
                'id' => 'required|integer|exists:guru_kelas,id',
            ], [
                'id.required' => 'ID harus diisi!',
                'id.exists' => 'ID tidak ditemukan!',
            ]);

            $guru = guru_kelas::find($request->id);
            $data_terhapus = guru_kelas::find($request->id);
            $guru->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus data guru kelas',
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
