<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::orderBy('created_at','DESC')->get();
        return view('petugas.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('petugas.create');
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
            'name' => ['required', 'string', 'max:255'],
            // 'nama_user' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'level' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $request['name'],
            // 'nama_user' => $request['nama_user'],
            'email' => $request['email'],
            'level' => $request['level'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect('petugas')->with('sukses','Akun Berhasil Ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $id)
    {
        return view('petugas.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $id)
    {
        // dd($id->level);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // 'nama_user' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'level' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($id->level == 'siswa') {
            $siswa = Siswa::where('nama_siswa', $id->name)->first();

            $siswa->update([
                'nama_siswa' => $request['name'],
            ]);
        }

        $id->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'level' => $request['level'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect('petugas')->with('sukses', 'Akun Berhasil Diubah !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $id)
    {
        $id->delete();

        return redirect('petugas')->with('sukses','Akun Berhasil Dihapus !');
    }
}
