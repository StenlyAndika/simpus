<?php

namespace App\Http\Controllers;

// use App\Models\Pendaftaran;
use Carbon\Carbon;
use App\Models\Pasien;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class DashboardPendaftaran extends Controller
{
    public function caripasien(Request $request)
    {
        $search = $request->get('term');

        $pasien = Pasien::where('nama', 'LIKE', '%' . $search . '%')->get();

        $result = [];
        foreach ($pasien as $pas) {
            $result[] = ['value' => $pas->nama, 'idpas' => $pas->idpas];
        }

        return response()->json($result);
    }

    public function getpasien(Request $request, $idpas)
    {
        $pasien = Pasien::find($idpas);
        if ($pasien) {
            return response()->json($pasien);
        }
        return response()->json(['message' => 'User not found'], 404);
    }

    public function noantri($request)
    {
        $prefix = strtoupper(substr($request, 0, 2));
        $noantri = Pendaftaran::where('poli', 'LIKE', $prefix . '%')
            ->where('tgl', Carbon::today())
            ->orderBy('no', 'desc')
            ->first();

        return response()->json(['noantrian' => $noantri->no ?? null]);
    }

    public function cetakKartu($idpas) {
        $pasien = Pasien::where('idpas', $idpas)->first();

        $customPaper = array(0,0,200, 330);
        $pdf = PDF::loadView('dashboard.pendaftaran.printkartu', ['pasien' => $pasien]);
        $pdf->setPaper($customPaper, 'landscape');

        $formatNama = str_replace(' ', '-', ucwords(strtolower($pasien->nama)));

        return $pdf->download('Kartu-Berobat-'.$formatNama.'.pdf');
    }

    public function create()
    {
        $poli = [
            "UMUM",
            "GIGI",
            "MTBS",
            "KIA-KB",
            "GIZI",
            "P2M",
            "PKPR"
        ];

        return view('dashboard.pendaftaran.create', [
            'title' => 'Dashboard Admin',
            'poli' => $poli
        ]);
    }

    public function store(Request $request)
    {
        if($request->status == "Belum Terdaftar") {
            $rules = [
                'nama' => 'required',
                'tgl' => 'required',
                'bln' => 'required',
                'thn' => 'required',
                'namakk' => 'required',
                'nomr' => 'required',
                'nik' => 'required',
                'pekerjaan' => 'required',
                'jekel' => 'required',
                'alamat' => 'required',
                'nohp' => 'required',
                'noantrian' => 'required'
            ];
    
            $validatedData = $request->validate($rules);
    
            $validatedData['nama'] = strtoupper($request->nama);
    
            $tgl = sprintf('%04d-%02d-%02d', $request->thn, $request->bln, $request->tgl);
            $validatedData['tgl'] = $tgl;
            $validatedData['namakk'] = strtoupper($request->namakk);
    
            $dateOfBirth = Carbon::parse($tgl);
            $currentDate = Carbon::now();
            $umur = $dateOfBirth->diffInYears($currentDate);
            $validatedData['umur'] = $umur;
    
            Pasien::create($validatedData);

            $pendaftaranrules = [
                'noantrian' => 'required',
                'nik' => 'required',
                'poli' => 'required',
                'pembayaran' => 'required',
                'keterangan' => 'required'
            ];

            $validatedPendaftaran = $request->validate($pendaftaranrules);

            $validatedPendaftaran['no'] = $request->noantrian;
            $validatedPendaftaran['tgl'] = Carbon::now();
            $validatedPendaftaran['poli'] = strtoupper($request->poli);
            $validatedPendaftaran['pembayaran'] = strtoupper($request->pembayaran);

            Pendaftaran::create($validatedPendaftaran);
        } else {
            $rules = [
                'nama' => 'required',
                'tgl' => 'required',
                'namakk' => 'required',
                'nomr' => 'required',
                'nik' => 'required',
                'pekerjaan' => 'required',
                'jekel' => 'required',
                'alamat' => 'required',
                'nohp' => 'required'
            ];
    
            $validatedData = $request->validate($rules);
    
            $validatedData['nama'] = strtoupper($request->nama);
    
            $tgl = sprintf('%04d-%02d-%02d', $request->thn, $request->bln, $request->tgl);
            $validatedData['tgl'] = $tgl;
            $validatedData['namakk'] = strtoupper($request->namakk);
    
            $dateOfBirth = Carbon::parse($tgl);
            $currentDate = Carbon::now();
            $umur = $dateOfBirth->diffInYears($currentDate);
            $validatedData['umur'] = $umur;
    
            Pasien::where('idpas', $request->idpas)->update($validatedData);

            $pendaftaranrules = [
                'noantrian' => 'required',
                'nik' => 'required',
                'poli' => 'required',
                'pembayaran' => 'required',
                'keterangan' => 'required'
            ];

            $validatedPendaftaran = $request->validate($pendaftaranrules);

            $validatedPendaftaran['no'] = $request->noantrian;
            $validatedPendaftaran['tgl'] = Carbon::now();
            $validatedPendaftaran['poli'] = strtoupper($request->poli);
            $validatedPendaftaran['pembayaran'] = strtoupper($request->pembayaran);

            Pendaftaran::create($validatedPendaftaran);
        }

        return redirect()->route('admin.dashboard')->with('toast_success', 'Data berhasil ditambah!');
    }

}
