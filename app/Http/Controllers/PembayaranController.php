<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\ViewPembayaran;
use App\Models\ViewSiswa;
use App\Models\Kelas;
use App\Models\Spp;
use App\Models\Siswa;
use App\Exports\pembayaranExport;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Auth;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembayaran = ViewPembayaran::orderBy('created_at', 'DESC')->get();
        return view('pembayaran.index', compact('pembayaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $siswa = Siswa::pluck('nisn','nama_siswa');
        // dd($siswa);
        return view('pembayaran.create', compact('siswa'));
    }

    public function create2()
    {
        $siswa = Siswa::pluck('nisn','nama_siswa');
        // dd($siswa);
        return view('pembayaran.create2', compact('siswa'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $siswa = Siswa::where('nisn', $request->nisn)->first();
        $spp = Spp::where('id',$siswa->id_spp)->first();
        
        // $kembalian = $request->jumlah_bayar - $spp->nominal;
        // $number_format = number_format($kembalian,2,',','.');
        
        $pembayaran = Pembayaran::where('nisn', $request->nisn)->get();
        $months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember'];
        
        // dd($pembayaran);
        if (sizeof($pembayaran) == 0 ) {
            $urutan = 6;
            $tahun = $spp->tahun;
        }else {
            $a = count(end($pembayaran));
            $akhir = $pembayaran[$a-1];
            // dd($akhir);
            $b = array_search($akhir->bulan_dibayar, $months);
            if ($b == 11) {
                $urutan = 0;
                $tahun = $akhir->tahun_dibayar + 1;
            }else {
                $urutan = $b+1;
                $tahun = $akhir->tahun_dibayar;
            }
        }

        // if ($request->jumlah_bayar < $spp->nominal) {
            // return redirect('pembayaran/create')->with('error','Tolong Masukan Uang Yang Cukup !');
        // }elseif ($request->jumlah_bayar >= $spp->nominal) {
            Pembayaran::create([
                'id_user' => Auth::user()->id,
                'nisn' => $request->nisn,
                'tanggal_bayar' => Carbon::now()->timezone('Asia/Jakarta'),
                'bulan_dibayar' => $months[$urutan],
                'tahun_dibayar' => $tahun,
                'id_spp' => $spp->id,
                'jumlah_bayar' => $spp->nominal,
            ]);
            
            return redirect('pembayarans')->with('sukses', 'Pembayaran Berhasil !');
        // }
    }

    public function store2(Request $request)
    {
        // $x = intval($request->jumlah_bulan_bayar);
        // dd($x);

        
        // foreach ($i as $key => $value) {
        //     dd($value);
        // }
        
        // while ($a <= $request->jumlah_bulan_bayar ) {
        //     dd($a);
        // }
        // foreach ($request->jumlah_bulan_bayar as $key => $value) {
        //     dd($value);
        // }

        $siswa = Siswa::where('nisn', $request->nisn)->first();
        $spp = Spp::where('id',$siswa->id_spp)->first();
        
        $pembayaran = Pembayaran::where('nisn', $request->nisn)->get();
        $months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember'];
        
        for ($i=0; $i < $request->jumlah_bulan_bayar ; $i++) { 
            if (sizeof($pembayaran) == 0 ) {
                $urutan = 5;
                $tahun = $spp->tahun;
            }else {
                $a = count(end($pembayaran));
                $akhir = $pembayaran[$a-1];
                
                $b = array_search($akhir->bulan_dibayar, $months);
                if ($b == 11) {
                    $urutan = -1;
                    $tahun = $akhir->tahun_dibayar + 1;
                }else {
                    $urutan = $b;
                    $tahun = $akhir->tahun_dibayar;
                }
            }
            
            Pembayaran::create([
                'id_user' => Auth::user()->id,
                'nisn' => $request->nisn,
                'tanggal_bayar' => Carbon::now()->timezone('Asia/Jakarta'),
                'bulan_dibayar' => $months[$urutan+$i+1],
                'tahun_dibayar' => $tahun,
                'id_spp' => $spp->id,
                'jumlah_bayar' => $spp->nominal,
                ]);
                
                
            }
            // dd($i);
            
            return redirect('pembayarans')->with('sukses', 'Pembayaran Berhasil !');
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function show(ViewPembayaran $id)
    {
        return view('pembayaran.show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembayaran $id)
    {
        $id->delete();

        return redirect('pembayarans');
    }

    public function riwayat()
    {
        
        if (Auth::user()->level == 'admin' OR Auth::user()->level == 'petugas') {
            $pembayaran = ViewPembayaran::orderBy('created_at', 'DESC')->get();
        }elseif (Auth::user()->level == 'siswa') {
            $pembayaran = ViewPembayaran::orderBy('created_at', 'DESC')->where('nama_siswa', Auth::user()->name)->get();
        }

        return view('laporan.index',compact('pembayaran'));   
    }

    public function export()
    {
        return Excel::download(new pembayaranExport, 'pembayaran.xlsx');
    }

    public function getDataSpp($nisn)
    {
        $siswa = Siswa::where('nisn', $nisn)->first();
        $spp = Spp::where('id', $siswa->id_spp)->first();

        $pembayaran = Pembayaran::where('nisn', $nisn)->latest()->first(); 

        if ($pembayaran == null ) {
            $pembayaran['bulan_dibayar'] = "( Belum Pernah Bayar SPP! )";
            $pembayaran['tahun_dibayar'] = "( Belum Pernah Bayar SPP! )";
        }

        $data = [
            'harga' => $spp->nominal,
            'bulan_terakhir' => $pembayaran['bulan_dibayar'],
            'tahun_terakhir' => $pembayaran['tahun_dibayar'],
        ];  

        return response()->json($data);
    }
}
