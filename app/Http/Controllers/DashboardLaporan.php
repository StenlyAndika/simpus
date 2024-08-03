<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;

class DashboardLaporan extends Controller
{
    public function berobat(Request $request) {
        $awal = $request->input('tgl_awal') ?? '0';
        $akhir = $request->input('tgl_akhir') ?? '0';

        $query = Pendaftaran::join('pasien', 'pasien.nik', 'pendaftaran.nik')
        ->join('diagnosa', 'diagnosa.idp', 'pendaftaran.idp')
        ->join('dokter', 'dokter.idd', 'diagnosa.idd')
        ->select('pendaftaran.*', 'diagnosa.*', 'pasien.*', 'pendaftaran.tgl as tglpendaftaran', 'pasien.tgl as tgllahir', 'dokter.nama as namadokter')
        ->orderBy('pendaftaran.tgl', 'desc');

        if ($awal && $awal != null) {
            $query->where('pendaftaran.tgl', '>=', $awal);
            $query->where('pendaftaran.tgl', '<=', $akhir);
        }

        $pendaftaran = $query->get();

        return view('dashboard.laporan.berobat', [
            'title' => 'Laporan Berobat',
            'pendaftaran' => $pendaftaran,
            'tgl_awal' => $awal,
            'tgl_akhir' => $akhir
        ]);
    }

    public function printberobat($tgl_awal, $tgl_akhir) {
        $awal = $tgl_awal;
        $akhir = $tgl_akhir;

        $query = Pendaftaran::join('pasien', 'pasien.nik', 'pendaftaran.nik')
        ->join('diagnosa', 'diagnosa.idp', 'pendaftaran.idp')
        ->join('dokter', 'dokter.idd', 'diagnosa.idd')
        ->select('pendaftaran.*', 'diagnosa.*', 'pasien.*', 'pendaftaran.tgl as tglpendaftaran', 'pasien.tgl as tgllahir', 'dokter.nama as namadokter')
        ->orderBy('pendaftaran.tgl', 'desc');

        if ($awal && $awal != null) {
            $query->where('pendaftaran.tgl', '>=', $awal);
            $query->where('pendaftaran.tgl', '<=', $akhir);
        }

        $pendaftaran = $query->get();

        $pdf = PDF::loadView('dashboard.laporan.berobat-print', ['pendaftaran' => $pendaftaran, 'tgl_awal' => $awal, 'tgl_akhir' => $akhir]);
        $pdf->setPaper('A3', 'landscape');
        $a = Carbon::parse($awal)->format('d-m-Y');
        $b = Carbon::parse($akhir)->format('d-m-Y');

        return $pdf->download('Laporan-Berobat '. $a .' - '. $b .'.pdf');
    }
}
