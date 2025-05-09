<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mata_pelajaran extends Model
{
    protected $table = 'mata_pelajaran';

    protected $primaryKey = 'id_mapel';

    protected $fillable = ['nama_mapel', 'kode_mapel', 'deskripsi', 'guru_id', 'kelas_id'];


    public function guru()
    {
        return $this->belongsTo(guru_kelas::class, 'guru_id', 'id_guru_kelas');
    }

    
}
