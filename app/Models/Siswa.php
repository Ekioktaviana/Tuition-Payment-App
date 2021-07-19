<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $primaryKey = "nisn";

    protected $table = "siswa";

    protected $fillable = [
        'nisn','nis','nama_siswa','id_kelas','alamat','no_telepon','id_spp',
    ];
}
