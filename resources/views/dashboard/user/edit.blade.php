@extends('layout.admin')

@section('container')
    <div class="card radius-10 full-height">
        <div class="card-header">
            <h5 class="mt-2">Ubah Data</h5>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('admin.user.updateroot', $user->id) }}" autocomplete="off">
                @csrf
                @method('put')
                <div class="form-floating mb-1">
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="username" value="{{ $user->username }}">
                    <label for="username">Username</label>
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating mb-1">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="password" value="{{ $user->password }}">
                    <label for="password">Password</label>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <hr>
                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    <a class="btn btn-sm btn-secondary" href="{{ route('admin.user.index') }}">Batal</a>
                </div>
                <hr>
            </form>
        </div>
    </div>
@endsection