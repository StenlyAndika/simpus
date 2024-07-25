<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class DashboardObat extends Controller
{
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

    public function destroy(Obat $obat, Request $request)
    {
        Obat::destroy($obat->id);
        return redirect()->route('admin.obat.index')->with('toast_success','Data berhasil dihapus!');
    }
}
