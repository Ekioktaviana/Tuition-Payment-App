<?php

namespace App\Exports;

use App\Pembayaran;
use App\Models\ViewPembayaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class pembayaranExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ViewPembayaran::all();
    }

    public function headings(): array
    {
        return [
            'ID','ID Petugas','Nama Petugas','Email','Level','NISN','NIS','Nama Siswa','ID Kelas','Nama Kelas','Kompetensi Keahlian','Alamat','No Telepon','ID SPP','Tahun','Nominal','Tanggal Bayar','Bulan Dibayar', 'Tahun Dibayar','Jumlah Bayar','Created AT','Updated AT', 
        ];
    }
}
