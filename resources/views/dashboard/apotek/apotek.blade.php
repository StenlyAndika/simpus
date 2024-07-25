@extends('layout.admin')

@section('container')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="card radius-10 full-height">
        <div class="card-header">
            <h5 class="mt-2">Apotek</h5>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('admin.apotek.store') }}">
                @csrf
                <div class="row mb-2">
                    <div class="col-md-6">
                        <input type="hidden" name="idp" value="{{ $pendaftaran->idp }}">
                        <div class="input-group">
                            <span class="input-group-text col-md-5">Nama Pasien</span>
                            <input type="text" class="form-control" name="nama" value="{{ $pasien->nama }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text col-md-5">Tanggal Lahir</span>
                            <input type="text" class="form-control" name="tgl" value="{{ Carbon::parse($pasien->tgl)->format('d-m-Y') }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text col-md-5">No Rekam Medis</span>
                            <input type="text" class="form-control" id="nomr" name="nomr" value="{{ $pasien->nomr }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text col-md-5">Umur</span>
                            <input type="text" class="form-control" id="umur" name="umur" value="{{ Carbon::parse($pasien->tgl)->diffInYears(Carbon::now()) }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text col-md-5">Jenis Kelamin</span>
                            <input type="text" class="form-control" id="jekel" name="jekel" value="{{ $pasien->jekel }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text col-md-5">Alamat</span>
                            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $pasien->alamat }}" readonly>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table id="obatTable" class="table table-striped datatablea">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Obat Yang Diambil</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($obat as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->nama }}</td>
                                    <td>{{ $row->jumlah }} {{ $row->jenis }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-secondary btn-round">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection