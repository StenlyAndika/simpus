<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Obat;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Diagnosa;
use App\Models\Objektif;
use App\Models\ObatKeluar;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class DashboardDiagnosa extends Controller
{
    public function index($idp)
    {
        $pendaftaran = Pendaftaran::where('idp', $idp)->first();
        return view('dashboard.poli.diagnosa', [
            'title' => 'Diagnosa Pasien',
            'pendaftaran' => $pendaftaran,
            'dokter' => Dokter::where('poli', auth()->user()->poli)->get(),
            'pasien' => Pasien::where('nik', $pendaftaran->nik)->first()
        ]);
    }

    public function savetempSOAP(Request $request) {

        $tempSoapData = session('temp_soap_data', []);

        $newData = $request->all();
        $tempSoapData = array_merge($tempSoapData, array_filter($newData));

        session(['temp_soap_data' => $tempSoapData]);

        return response()->json(['success' => true]);
    }

    public function cekAntri()
    {
        $waitingCount = Pendaftaran::where('status', '0')->where('tgl', Carbon::now()->format('Y-m-d'))->count();
        return response()->json(['waiting' => $waitingCount > 0]);
    }

    public function cekRiwayat($id) {
        $data = Pendaftaran::join('diagnosa', 'diagnosa.idp', 'pendaftaran.idp')
        ->join('dokter', 'dokter.idd', 'diagnosa.idd')
        ->select('pendaftaran.*', 'diagnosa.*', 'dokter.*')
        ->where('pendaftaran.nik', $id)
        ->orderBy('pendaftaran.tgl' , 'desc')->get();
        return response()->json(['data' => $data]);
    }

    public function getRiwayat($id) {
        $data = Pendaftaran::join('diagnosa', 'diagnosa.idp', 'pendaftaran.idp')
        ->join('dokter', 'dokter.idd', 'diagnosa.idd')
        ->select('pendaftaran.*', 'diagnosa.*', 'dokter.*')
        ->where('pendaftaran.idp', $id)
        ->orderBy('pendaftaran.tgl' , 'desc')->get();
        return response()->json(['data' => $data]);
    }

    public function savetempObat(Request $request) {
        $id = $request->input('id');
        $jumlah = $request->input('jumlah');

        $tempObatData = session('temp_obat_data', []);

        if ($id) {
            $tempObatData[$id] = $jumlah;
        }

        session(['temp_obat_data' => $tempObatData]);

        return response()->json(['success' => true]);
    }    
    
    public function gettempObat() {
        $tempObatData = session('temp_obat_data', []);
    
        $obatItems = [];
        foreach ($tempObatData as $id => $jumlah) {
            $obat = Obat::find($id);
            if ($obat) {
                $obatItems[] = [
                    'id' => $obat->id,
                    'nama' => $obat->nama,
                    'jumlah' => $jumlah
                ];
            }
        }
    
        return response()->json(['data' => $obatItems]);
    }

    public function cariobat(Request $request)
    {
        $search = $request->get('term');

        $obat = Obat::where('nama', 'LIKE', '%' . $search . '%')->get();

        $result = [];
        foreach ($obat as $row) {
            $result[] = ['value' => $row->nama, 'id' => $row->id];
        }

        return response()->json($result);
    }

    public function getobat(Request $request, $idpas)
    {
        $obat = Obat::find($idpas);
        if ($obat) {
            return response()->json($obat);
        }
        return response()->json(['message' => 'Obat not found'], 404);
    }

    public function deleteObat($id)
    {
        $tempObatData = session('temp_obat_data', []);

        if (isset($tempObatData[$id])) {
            unset($tempObatData[$id]);
            session(['temp_obat_data' => $tempObatData]);
        }

        return response()->json(['success' => true]);
    }

    public function store(Request $request)
    {
        $rules = [
            'idp' => 'required',
            'idd' => 'required'
        ];

        $tempSOAPData = session('temp_soap_data');

        // Start store data diagnosa
        $validatedDiagnosa = $request->validate($rules);

        $validatedDiagnosa['idp'] = $request->idp;
        $validatedDiagnosa['idd'] = $request->idd;
        $validatedDiagnosa['s'] = $tempSOAPData['s'] ?? '';
        $validatedDiagnosa['a'] = $tempSOAPData['a'] ?? '';
        $validatedDiagnosa['alergi'] = $request->alergi ?? '';
        $validatedDiagnosa['kie'] = $request->kie ?? '';
        $validatedDiagnosa['rujukan'] = $request->rujukan ?? '';

        Diagnosa::create($validatedDiagnosa);
        // End store data diagnosa


        // Start store data objektif
        $validatedObjektif['idp'] = $request->idp;
        $validatedObjektif['td'] = $tempSOAPData['td'] ?? '';
        $validatedObjektif['n'] = $tempSOAPData['n'] ?? '';
        $validatedObjektif['r'] = $tempSOAPData['r'] ?? '';
        $validatedObjektif['s'] = $tempSOAPData['suhu'] ?? '';
        $validatedObjektif['tb'] = $tempSOAPData['tb'] ?? '';
        $validatedObjektif['bb'] = $tempSOAPData['bb'] ?? '';
        $validatedObjektif['kepala'] = $tempSOAPData['kepala'] ?? '';
        $validatedObjektif['dada'] = $tempSOAPData['dada'] ?? '';
        $validatedObjektif['abdomen'] = $tempSOAPData['abdomen'] ?? '';
        $validatedObjektif['extermitas'] = $tempSOAPData['extermitas'] ?? '';

        Objektif::create($validatedObjektif);
        // End store data objektif

        // Start store data obat keluar
        $tempObatData = session('temp_obat_data', []);
    
        // Iterate over the session data and create database records
        foreach ($tempObatData as $id => $jumlah) {
            $validatedObat = [
                'idp' => $request->idp,
                'idobat' => $id,
                'jumlah' => $jumlah
            ];
            
            ObatKeluar::create($validatedObat);
        }
        // End store data obat keluar


        // Start store data pendaftaran
        $validatedPendaftaran['status'] = '1';

        Pendaftaran::where('idp', $request->idp)->update($validatedPendaftaran);
        // End store data pendaftaran


        return redirect()->route('admin.dashboard')->with('toast_success', 'Data berhasil disubmit!');
    }
}
