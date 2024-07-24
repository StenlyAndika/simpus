@extends('layout.admin')

@section('container')
    @php
        use Carbon\Carbon;
    @endphp
    <div class="card radius-10 full-height">
        <div class="card-header">
            <h5 class="mt-2">Diagnosa Pasien</h5>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('admin.poli.diagnosa.store') }}">
                @csrf
                <div class="row mb-2">
                    <div class="col-md-6">
                        <input type="hidden" name="idpas" value="{{ $pasien->idpas }}">
                        <input type="hidden" name="idp" value="{{ $pendaftaran->id }}">
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
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text col-md-5">Riwayat Riwayat</span>
                            <button type="button" class="btn btn-primary col-md-7" data-bs-toggle="modal" data-bs-target="#dataRiwayat">Cek Data</button>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text col-md-5">Subjective (Subjektif)</span>
                            @if (session('temp_soap_data.s'))
                                <input type="text" class="form-control" value="Data sudah diisi" readonly>
                                <span class="input-group-text"><i class='bx bx-check'></i></span>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahSubjektif">Cek Data</button>
                            @else
                                <input type="text" class="form-control" value="Data belum diisi" readonly>
                                <span class="input-group-text"><i class='bx bx-x'></i></span>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahSubjektif">Isi Data</button>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text col-md-5">Objective (Objektif)</span>
                            @if (session('temp_soap_data.td'))
                                <input type="text" class="form-control" value="Data sudah diisi" readonly>
                                <span class="input-group-text"><i class='bx bx-check'></i></span>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahObjektif">Cek Data</button>
                            @else
                                <input type="text" class="form-control" value="Data belum diisi" readonly>
                                <span class="input-group-text"><i class='bx bx-x'></i></span>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahObjektif">Isi Data</button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text col-md-5">Assesment (Penilaian)</span>
                            @if (session('temp_soap_data.a'))
                                <input type="text" class="form-control" value="Data sudah diisi" readonly>
                                <span class="input-group-text"><i class='bx bx-check'></i></span>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahPenilaian">Cek Data</button>
                            @else
                                <input type="text" class="form-control" value="Data belum diisi" readonly>
                                <span class="input-group-text"><i class='bx bx-x'></i></span>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPenilaian">Isi Data</button>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text col-md-5">Plan (Perencanaan)</span>
                            @if (session('temp_soap_data.p'))
                                <input type="text" class="form-control" value="Data sudah diisi" readonly>
                                <span class="input-group-text"><i class='bx bx-check'></i></span>
                                <button type="button" class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#tambahPerencanaan">Cek Data</button>
                            @else
                                <input type="text" class="form-control" value="Data belum diisi" readonly>
                                <span class="input-group-text"><i class='bx bx-x'></i></span>
                                <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#tambahPerencanaan">Isi Data</button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6">
                        <label>Alergi Obat</label>
                        <input type="hidden" id="alergi" name="alergi" value="">
                        <trix-editor input="alergi"></trix-editor>
                    </div>
                    <div class="col-md-6">
                        <label>KIE (Komunikasi, Informasi dan Edukasi)</label>
                        <input type="hidden" id="kie" name="kie">
                        <trix-editor input="kie"></trix-editor>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6">
                        <label>Rujukan dan lain-lain</label>
                        <input type="hidden" id="rujukan" name="rujukan">
                        <trix-editor input="rujukan"></trix-editor>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text col-md-5">Dokter</span>
                            <select class="select2-bootstrap4 form-control bg-light" id="idd" name="idd">
                                <option value="1" selected>-- Pilih --</option>
                                @foreach ($dokter as $item)
                                    <option value="{{ $item->idd }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-secondary btn-round">Batal</a>
                </div>
            </form>
        </div>
    </div>
    @include('dashboard.poli.riwayat')
    @include('dashboard.poli.subjective')
    @include('dashboard.poli.objective')
    @include('dashboard.poli.assesment')
    @include('dashboard.poli.plan')
@endsection