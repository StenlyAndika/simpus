<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-size: 12px !important;
        }
        .container {
            text-align: center;
        }
        h4, h5 {
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse; /* Ensures that borders are not doubled */
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>PUSKESMAS SIULAK MUKAI</h1>
    </div>
    <h4>LAPORAN BEROBAT DARI TANGGAL : {{ Carbon\Carbon::parse($tgl_awal)->format('d-m-Y') }} SD {{ Carbon\Carbon::parse($tgl_akhir)->format('d-m-Y') }}</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tgl Pendaftaran</th>
                <th>Poli</th>
                <th>Nama Dokter</th>
                <th>Nama Pasien</th>
                <th>Nomor Induk Kependudukan</th>
                <th>Nama KK</th>
                <th>No MR</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>S</th>
                <th style="width: 150px">O</th>
                <th>A</th>
                <th>P</th>
                <th>KIE</th>
                <th>Rujukan dan Lain-lain</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendaftaran as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->tglpendaftaran }}</td>
                    <td>{{ $item->poli }}</td>
                    <td>{{ $item->namadokter }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->nik }}</td>
                    <td>{{ $item->namakk }}</td>
                    <td>{{ $item->nomr }}</td>
                    <td>{{ $item->jekel }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{!! $item->s !!}</td>
                    <td>
                        @php
                            $objektif = App\Models\Objektif::where('idp', $item->idp)->first();
                        @endphp
                        td : {{ $objektif->td }} MmHg, n : {{ $objektif->n }} x/mnt <br>
                        r : {{ $objektif->r }} x/mnt, s : {{ $objektif->s }} °C <br>
                        tb : {{ $objektif->tb }} cm, bb : {{ $objektif->bb }} kg <br>
                        kepala : {{ $objektif->kepala }}, dada : {{ $objektif->dada }} <br>
                        abdomen : {{ $objektif->abdomen }}, extermitas : {{ $objektif->extermitas }}
                    </td>
                    <td>{!! $item->a !!}</td>
                    <td>
                        {!! $item->p !!}
                        Alergi terhadap obat:
                        {!! $item->alergi!!}
                        <br>
                        Obat diambil :
                        <br>
                        @php
                            $obatkeluar = App\Models\ObatKeluar::join('obat', 'obat.id', 'obatkeluar.idobat')->where('idp', $item->idp)->get();
                        @endphp
                        @foreach ($obatkeluar as $row)
                            {{ $row->nama }} {{ $row->jumlah }} {{ $row->jenis }} <br>
                        @endforeach
                    </td>
                    <td>{!! $item->kie !!}</td>
                    <td>{!! $item->rujukan !!}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>