<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'nama', 'alamat', 'tanggal_lahir', 'jenis_kelamin', 'asal_sekolah', 'agama_id', 'nilai_ind', 'nilai_ipa', 'nilai_mtk'
    ];
}
