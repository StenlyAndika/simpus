@extends('layout.admin')

@section('container')
    <div class="card radius-10 full-height">
        <div class="card-header">
            <h5 class="mt-2">Ubah Data</h5>
        </div>
        <div class="card-body">          
            <form method="post" action="{{ route('admin.obat.update', $obat->id) }}" autocomplete="off">
                @csrf
                @method('put')
                <div class="form-floating mb-1">
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="nama" value="{{ $obat->nama }}">
                    <label for="nama">Nama</label>
                </div>
                <div class="mb-1">
                    <select class="select2-bootstrap4 form-control bg-light fs-6" data-dropdown-parent="#tambahObat" id="jenis" name="jenis">
                        <option value="1" selected>-- Pilih --</option>
                        @foreach ($jenis as $item)
                            <option value="{{ $item }}" @if ($obat->jenis == $item) selected @endif>{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-floating mb-1">
                    <input type="text" class="form-control" id="stok" name="stok" placeholder="stok" value="{{ $obat->stok }}">
                    <label for="stok">Stok Obat</label>
                </div>
                <hr>
                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    <a class="btn btn-sm btn-secondary" href="{{ route('admin.obat.index') }}">Batal</a>
                </div>
                <hr>
            </form>
        </div>
    </div>
@endsection