<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $primaryKey = 'id_siswa';

    protected $fillable = [
        'nama', 'nis', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir',
        'alamat', 'no_telepon', 'email', 'guru_kelas_id',
    ];
    

    public function guruKelas()
    {
        return $this->belongsTo(guru_kelas::class, 'guru_kelas_id', 'id_guru_kelas');
    }
}
