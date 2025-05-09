<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $table = 'mata_pelajaran';

    protected $primaryKey = 'id_mapel';

    protected $fillable = ['nama', 'guru_kelas_id'];

    public function guru()
    {
        return $this->belongsTo(guru_kelas::class, 'guru_kelas_id', 'id_guru_kelas');
    }
}

    
    

