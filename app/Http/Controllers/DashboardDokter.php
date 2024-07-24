<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DashboardDokter extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $poli = [
            "UMUM",
            "GIGI",
            "MTBS",
            "KIA/KB",
            "GIZI",
            "P2M",
            "PKPR"
        ];

        return view('dashboard.dokter.index', [
            'title' => 'Data Dokter',
            'dokter' => Dokter::orderBy('idd', 'ASC')->get(),
            'poli' => $poli
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
            'poli' => 'required'
        ];

        $validatedData = $request->validate($rules);

        $validatedData['poli'] = strtoupper($request->poli);

        Dokter::create($validatedData);

        return redirect()->route('admin.dokter.index')->with('toast_success', 'Data berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dokter $dokter
     * @return \Illuminate\Http\Response
     */
    public function show(Dokter $dokter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dokter $dokter
     * @return \Illuminate\Http\Response
     */
    public function edit(Dokter $dokter)
    {
        return view('dashboard.dokter.edit', [
            'title' => 'Edit Data'
        ], compact('dokter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Dokter $dokter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dokter $dokter)
    {
        $rules = [
            'nama' => 'required'
        ];

        $validatedData = $request->validate($rules);

        Dokter::where('idd', $dokter->idd)->update($validatedData);

        return redirect()->route('admin.dokter.index')->with('toast_success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dokter $dokter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dokter $dokter, Request $request)
    {
        Dokter::destroy($dokter->idd);
        return redirect()->route('admin.dokter.index')->with('toast_success','Data berhasil dihapus!');
    }
}
