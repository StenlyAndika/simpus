<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Kartu</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        .container {
            text-align: center;
            width: 480px;
            border: 2px solid black;
            margin: 0;
            padding: 0;
        }
        h4, h5 {
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h4>PUSKESMAS SIULAK MUKAI</h4>
        <h5>RESEP OBAT</h5>
        <hr>
        <table>
            <tr>
                <td style="width: 150px">Nama</td>
                <td>:</td>
                <td style="width: 300px">{{ ucwords(strtolower($pendaftaran->nama)) }}</td>
            </tr>
            <tr>
                <td style="width: 150px">Tanggal Lahir</td>
                <td>:</td>
                <td style="width: 300px">{{ Carbon\Carbon::parse($pendaftaran->tgllahir)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td style="width: 150px">No RM</td>
                <td>:</td>
                <td style="width: 300px">{{ $pendaftaran->nomr }}</td>
            </tr>
            <tr>
                <td style="width: 150px">Jenis Kelamin</td>
                <td>:</td>
                <td style="width: 300px">{{ $pendaftaran->jekel }}</td>
            </tr>
            <tr>
                <td style="width: 150px">Alamat</td>
                <td>:</td>
                <td style="width: 300px">{{ $pendaftaran->alamat }}</td>
            </tr>
        </table>
        <hr>
        <table>
            <tr>
                <td style="width: 240px">Obat Yang Diambil</td>
                <td style="width: 50px">Jumlah</td>
                <td style="width: 50px">Jenis</td>
                <td>Dosis</td>
            </tr>
        </table>
        <hr>
        <table>
            @foreach ($obatkeluar as $row)
                <tr>
                    <td style="width: 240px">{{ ucwords(strtolower($row->nama)) }}</td>
                    <td style="width: 50px">{{ $row->jumlah }}</td>
                    <td style="width: 50px">{{ $row->jenis }}</td>
                    <td>{{ $row->dosis }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>