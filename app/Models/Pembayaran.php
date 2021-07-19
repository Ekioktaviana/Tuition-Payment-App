<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = "pembayaran";

    protected $fillable = [
        'id_user','nisn','tanggal_bayar','bulan_dibayar','tahun_dibayar','id_spp','jumlah_bayar',
    ];
}
