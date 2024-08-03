<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Opd;
use App\Models\Pasien;
use App\Models\ActivityLog;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->is_root) {
            return view('dashboard.index', [
                'title' => 'Dashboard Admin',
            ]);
        } else {
            if (auth()->user()->poli == "PENDAFTARAN") {
                return view('dashboard.pendaftaran.index', [
                    'title' => 'Dashboard Pendaftaran',
                    'pendaftaran' => Pendaftaran::whereDate('pendaftaran.tgl', Carbon::today())
                        ->join('pasien', 'pasien.nik', 'pendaftaran.nik')
                        ->select('pendaftaran.*', 'pasien.idpas as idpas', 'pasien.nama as namapas')
                        ->orderBy('pendaftaran.created_at', 'desc')
                        ->get()
                ]);
            } else if (auth()->user()->poli == "APOTEK") {
                return view('dashboard.apotek.index', [
                    'title' => 'Dashboard Apotek',
                    'pendaftaran' => Pendaftaran::join('pasien', 'pasien.nik', 'pendaftaran.nik')
                    ->where('pendaftaran.tgl', Carbon::today())
                    ->whereIn('status' , ['1', '2'])
                    ->orderBy('no', 'asc')
                    ->select('pendaftaran.*','pasien.nama as namapas')
                    ->get()
                ]);
            } else {
                $poli = [
                    "UMUM",
                    "GIGI",
                    "MTBS",
                    "KIA-KB",
                    "LANSIA"
                ];
                session()->forget('temp_soap_data');
                session()->forget('temp_obat_data');
                return view('dashboard.poli.index', [
                    'title' => 'Dashboard Poli',
                    'poli' => $poli,
                    'pendaftaran' => Pendaftaran::where('poli', auth()->user()->poli)
                        ->join('pasien', 'pasien.nik', 'pendaftaran.nik')
                        ->where('pendaftaran.tgl', Carbon::today())
                        ->where('status', '0')
                        ->orderBy('no', 'asc')
                        ->select('pendaftaran.*','pasien.nama as namapas')
                        ->get()
                ]);
            }
            
        }
    }

}
