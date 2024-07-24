<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Obat;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Diagnosa;
use App\Models\Objektif;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class DashboardDiagnosa extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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


        // ObatKeluar::create($validatedObat);


        // Start store data pendaftaran
        $validatedPendaftaran['status'] = '1';

        Pendaftaran::where('idp', $request->idp)->update($validatedPendaftaran);
        // End store data pendaftaran


        return redirect()->route('admin.dashboard')->with('toast_success', 'Data berhasil disubmit!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
