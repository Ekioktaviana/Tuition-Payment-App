<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class pembayaranUser implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }
}
