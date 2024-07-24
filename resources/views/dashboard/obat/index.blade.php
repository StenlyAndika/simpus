@extends('layout.admin')

@section('container')
    <div class="card radius-10 full-height">
        <div class="card-header">
            <h5 class="mt-2">Data Obat</h5>
        </div>
        <div class="card-header mt-2 border-start border-0 border-4 border-danger">
            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#tambahObat">
                Data Baru
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped datatable">
                    <thead>
                        <tr>
                            <th style="text-align: center;">#</th>
                            <th style="text-align: left;">Nama</th>
                            <th style="text-align: left;">Jenis</th>
                            <th style="text-align: left;">Stok</th>
                            <th style="text-align: center;">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($obat as $row)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td style="text-align: left;">{{ $row->nama }}</td>
                            <td style="text-align: left;">{{ $row->jenis }}</td>
                            <td style="text-align: left;">{{ $row->stok }}</td>
                            <td style="text-align: center;">
                                <a href="{{ route('admin.obat.edit', $row->id) }}" class="btn btn-sm btn-primary">Ubah</a>
                                <form action="{{ route('admin.obat.destroy', $row->id) }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger hapusDataM">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="tambahObat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hiden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('admin.obat.store') }}" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="form-floating mb-1">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="nama" value="{{ old('nama') }}">
                            <label for="nama">Nama obat</label>
                        </div>
                        <div class="mb-1">
                            <select class="select2-bootstrap4 form-control bg-light fs-6" data-dropdown-parent="#tambahObat" id="jenis" name="jenis">
                                <option value="1" selected>-- Pilih --</option>
                                @foreach ($jenis as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-floating mb-1">
                            <input type="text" class="form-control" id="stok" name="stok" placeholder="stok" value="{{ old('stok') }}">
                            <label for="stok">Stok Obat</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection