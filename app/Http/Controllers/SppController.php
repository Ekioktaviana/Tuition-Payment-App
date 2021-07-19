<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use Illuminate\Http\Request;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spp = Spp::orderBy('created_at', 'DESC')->get();
        return view('spp.index', compact('spp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('spp.create');
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
            'tahun' => 'required',
            'nominal' => 'required',
        ]);

        Spp::create([
            'tahun' => $request->tahun,
            'nominal' => $request->nominal,
        ]);

        return redirect('spps')->with('sukses', 'Data Spp Berhasil Ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function show(Spp $spp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function edit(Spp $id)
    {
        return view('spp.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spp $id)
    {
        $request->validate([
            'tahun' => 'required',
            'nominal' => 'required',
        ]);

        $id->update([
            'tahun' => $request->tahun,
            'nominal' => $request->nominal,
        ]);

        return redirect('spps')->with('sukses','Data Spp Berhasil Diubah !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spp $id)
    {
        $id->delete();

        return redirect('spps')->with('sukses', 'Data Spp Berhasil Dihapus !');
    }
}
