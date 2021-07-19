<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\ViewSiswa;
use App\Models\Spp;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = ViewSiswa::orderBy('created_at', 'DESC')->get();
        return view('siswa.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $spp = Spp::pluck('tahun', 'id');
        $kelas = Kelas::pluck('nama_kelas', 'id');
        // dd($kelas);
        return view('siswa.create', compact('spp','kelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required | string',
            'nis' => 'required | string',
            'nama_siswa' => 'required',
            'id_kelas' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required',
            'id_spp' => 'required',
        ]);

        Siswa::create([
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nama_siswa' => $request->nama_siswa,
            'id_kelas' => $request->id_kelas,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
            'id_spp' => $request->id_spp,
        ]);

        User::create([
            'name' => $request->nama_siswa,
            'email' => $request->nis.'@gmail.com',
            'level' => 'siswa',
            'password' => Hash::make($request->nis),
        ]); 

        return redirect('siswas')->with('sukses','Data Siswa Berhasil Ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $nisn)
    {
        $spp = Spp::pluck('tahun', 'id');
        $kelas = Kelas::pluck('nama_kelas', 'id');
        return view('siswa.edit',compact('nisn','spp','kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $nisn)
    {
        $user = User::where('name', $nisn->nama_siswa)->first();
        // dd($user);
        $request->validate([
            'nisn' => 'required | string',
            'nis' => 'required | string',
            'nama_siswa' => 'required',
            'id_kelas' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required',
            'id_spp' => 'required',
        ]);

        $user->update([
            'name' => $request->nama_siswa,
            'email' => $request->nis.'@gmail.com',
            'level' => 'siswa',
            'password' => Hash::make($request->nis),
        ]);

        $nisn->update([
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nama_siswa' => $request->nama_siswa,
            'id_kelas' => $request->id_kelas,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
            'id_spp' => $request->id_spp,
        ]); 
        

        return redirect('siswas')->with('sukses','Data Siswa Berhasil Diubah !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $nisn)
    {
        
        $user = User::where('name', $nisn->nama_siswa)->first();
        // dd($user);
        $nisn->delete();
        $user->delete();

        return redirect('siswas')->with('sukses','Data Siswa Berhasil Dihapus !');
    }
}
