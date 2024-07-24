@extends('layout.admin')

@section('container')
    <div class="card radius-10 full-height">
        <div class="card-header">
            <h5 class="mt-2">Ubah Data</h5>
        </div>
        <div class="card-body">          
            <form method="post" action="{{ route('admin.dokter.update', $dokter->idd) }}" autocomplete="off">
                @csrf
                @method('put')
                <div class="form-floating mb-1">
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="nama" value="{{ $dokter->nama }}">
                    <label for="nama">Nama</label>
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <hr>
                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    <a class="btn btn-sm btn-secondary" href="{{ route('admin.dokter.index') }}">Batal</a>
                </div>
                <hr>
            </form>
        </div>
    </div>
@endsection