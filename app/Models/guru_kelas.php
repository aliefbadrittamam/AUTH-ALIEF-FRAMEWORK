<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class guru_kelas extends Model
{
    protected $table = 'guru_kelas';

    protected $primaryKey = 'id_guru_kelas';
    
    protected $fillable = [
        'nama',
        'nip',
        'kelas',
    ];
}
