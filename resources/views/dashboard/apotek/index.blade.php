@extends('layout.admin')

@section('container')
    <div class="card radius-10 full-height">
        <div class="card-header">
            <h5 class="mt-2">Data Pasien Hari Ini</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped datatable">
                    <thead>
                        <tr>
                            <th style="text-align: center;">#</th>
                            <th style="text-align: left;">No Antri</th>
                            <th style="text-align: left;">NIK</th>
                            <th style="text-align: left;">Nama</th>
                            <th style="text-align: left;">Poli</th>
                            <th style="text-align: left;">Status</th>
                            <th style="text-align: left;">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendaftaran as $row)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td style="text-align: left;">{{ $row->no }}</td>
                            <td style="text-align: left;">{{ $row->nik }}</td>
                            <td style="text-align: left;">{{ $row->namapas }}</td>
                            <td style="text-align: left;">{{ $row->poli }}</td>
                            <td style="text-align: left;">
                                @if ($row->status == "1")
                                    Antri
                                @else
                                    Selesai
                                @endif
                            </td>
                            <td>
                                @if ($row->status == "1")
                                    <a href="{{ route('admin.apotek.index' , $row->idp) }}" class="btn btn-block btn-sm btn-primary">Proses Pengambilan Obat</a>
                                @else
                                    <a href="{{ route('admin.apotek.printresep', $row->idp) }}" class="btn btn-block btn-sm btn-success">Cetak Resep Obat</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection