<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class DashboardObat extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $jenis = [
            "Syrup",
            "Tablet",
            "Cap",
            "Supplemen",
            "Injeksi",
            "Susp",
            "Tab Vagina",
            "Kaplet"
        ];

        return view('dashboard.obat.index', [
            'title' => 'Data Obat',
            'obat' => Obat::orderBy('id', 'ASC')->get(),
            'jenis' => $jenis
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'jenis' => 'required',
            'stok' => 'required'
        ];

        $validatedData = $request->validate($rules);

        $validatedData['nama'] = strtoupper($request->nama);

        Obat::create($validatedData);

        return redirect()->route('admin.obat.index')->with('toast_success', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Obat $obat
     * @return \Illuminate\Http\Response
     */
    public function show(Obat $obat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Obat $obat
     * @return \Illuminate\Http\Response
     */
    public function edit(Obat $obat)
    {

        $jenis = [
            "Syrup",
            "Tablet",
            "Cap",
            "Supplemen",
            "Injeksi",
            "Susp",
            "Tab Vagina",
            "Kaplet"
        ];

        return view('dashboard.obat.edit', [
            'title' => 'Edit Data',
            'jenis' => $jenis
        ], compact('obat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Obat $obat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Obat $obat)
    {
        $rules = [
            'nama' => 'required',
            'jenis' => 'required',
            'stok' => 'required'
        ];

        $validatedData = $request->validate($rules);

        $validatedData['nama'] = strtoupper($request->nama);

        Obat::where('id', $obat->id)->update($validatedData);

        return redirect()->route('admin.obat.index')->with('toast_success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Obat $obat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Obat $obat, Request $request)
    {
        Obat::destroy($obat->id);
        return redirect()->route('admin.obat.index')->with('toast_success','Data berhasil dihapus!');
    }
}
