<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Dokter;
use App\Models\Pasien;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\ObatKeluar;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class DashboardApotek extends Controller
{
    public function index($idp)
    {
        $pendaftaran = Pendaftaran::where('idp', $idp)->first();
        return view('dashboard.apotek.apotek', [
            'title' => 'Pengambilan Obat',
            'pendaftaran' => $pendaftaran,
            'dokter' => Dokter::where('poli', auth()->user()->poli)->get(),
            'pasien' => Pasien::where('nik', $pendaftaran->nik)->first(),
            'obat' => ObatKeluar::join('obat', 'obat.id', 'obatkeluar.idobat')->where('idp', $pendaftaran->idp)->get()
        ]);
    }

    public function store(Request $request) {
        $tempObatKeluar = ObatKeluar::where('idp', $request->idp)->get();
        foreach($tempObatKeluar as $row) {
            $tempStokObat = Obat::where('id', $row->idobat)->first();
            $newStok = $tempStokObat->stok - $row->jumlah;
            $dataStok = [
                'stok' => $newStok
            ];
            Obat::where('id', $row->idobat)->update($dataStok);
            $data = [
                'status' => '1'
            ];
            ObatKeluar::where('id', $row->id)->update($data);
        }

        $validatedPendaftaran['status'] = '2';

        Pendaftaran::where('idp', $request->idp)->update($validatedPendaftaran);

        return redirect()->route('admin.dashboard')->with('toast_success', 'Data berhasil disubmit!');
    }

    public function cetakResep($idp) {
        $pendaftaran = Pendaftaran::join('pasien', 'pasien.nik', 'pendaftaran.nik')
        ->select('pendaftaran.*', 'pasien.*', 'pasien.tgl as tgllahir')
        ->where('pendaftaran.idp', $idp)->first();
        $obatkeluar = ObatKeluar::join('obat', 'obat.id', 'obatkeluar.idobat')
        ->where('obatkeluar.idp', $pendaftaran->idp)->get();

        $customPaper = array(0,0,330, 350);
        $pdf = PDF::loadView('dashboard.apotek.printresep', ['pendaftaran' => $pendaftaran, 'obatkeluar' => $obatkeluar]);
        $pdf->setPaper($customPaper, 'portrait');

        $formatNama = str_replace(' ', '-', ucwords(strtolower($pendaftaran->nama)));

        return $pdf->download('Resep-Obat-'.$formatNama.'.pdf');
    }
}
