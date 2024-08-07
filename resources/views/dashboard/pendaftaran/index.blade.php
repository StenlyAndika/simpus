@extends('layout.admin')

@section('container')
    <div class="card radius-10 full-height">
        <div class="card-header">
            <h5 class="mt-2">Data Pendaftaran Hari Ini</h5>
        </div>
        <div class="card-header mt-2 border-start border-0 border-4 border-danger">
            <a href="{{ route('admin.pendaftaran.create') }}" class="btn btn-sm btn-success">Tambah Data</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped datatable">
                    <thead>
                        <tr>
                            <th style="text-align: center;">#</th>
                            <th style="text-align: left;">Kartu Berobat</th>
                            <th style="text-align: left;">No Antri</th>
                            <th style="text-align: left;">NIK</th>
                            <th style="text-align: left;">Nama</th>
                            <th style="text-align: left;">Poli</th>
                            <th style="text-align: left;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendaftaran as $row)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td>
                                <a href="{{ route('admin.dashboard.printkartu', $row->idpas) }}" class="btn btn-sm btn-primary">Cetak Kartu</a>
                            </td>
                            <td style="text-align: left;">{{ $row->no }}</td>
                            <td style="text-align: left;">{{ $row->nik }}</td>
                            <td style="text-align: left;">{{ $row->namapas }}</td>
                            <td style="text-align: left;">{{ $row->poli }}</td>
                            <td style="text-align: left;">
                                @if ($row->status == "0")
                                    Antri    
                                @elseif ($row->status == "1")
                                    Apotek
                                @else
                                    Selesai
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