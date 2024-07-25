<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DashboardDokter extends Controller
{
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

    public function edit(Dokter $dokter)
    {
        return view('dashboard.dokter.edit', [
            'title' => 'Edit Data'
        ], compact('dokter'));
    }

    public function update(Request $request, Dokter $dokter)
    {
        $rules = [
            'nama' => 'required'
        ];

        $validatedData = $request->validate($rules);

        Dokter::where('idd', $dokter->idd)->update($validatedData);

        return redirect()->route('admin.dokter.index')->with('toast_success', 'Data berhasil diupdate!');
    }

    public function destroy(Dokter $dokter, Request $request)
    {
        Dokter::destroy($dokter->idd);
        return redirect()->route('admin.dokter.index')->with('toast_success','Data berhasil dihapus!');
    }
}
