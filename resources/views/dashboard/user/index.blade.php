@extends('layout.admin')

@section('container')
    <div class="card radius-10 full-height">
        <div class="card-header">
            <h5 class="mt-2">Data Admin OPD</h5>
        </div>
        <div class="card-header mt-2 border-start border-0 border-4 border-danger">
            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#tambahAdmin">
                Data Baru
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped datatable">
                    <thead>
                        <tr>
                            <th style="text-align: center;">#</th>
                            <th style="text-align: center;">Username</th>
                            <th style="text-align: center;">Poli</th>
                            <th style="text-align: center;">Akses Super Admin</th>
                            <th style="text-align: center;">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $row)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td style="text-align: left;">{{ $row->username }}</td>
                            <td style="text-align: left;">{{ $row->poli }}</td>
                            <td style="text-align: left;">
                                @if ($row->is_root == 1)
                                    <button type="submit" class="btn btn-block btn-sm btn-success">Ya</button>
                                @else
                                    <form action="{{ route('admin.user.set_root', $row->id) }}" method="post" class="d-inline">
                                        @method('patch')
                                        @csrf
                                        <button type="submit" class="btn btn-block btn-sm btn-danger setSuperAdmin">Tidak</button>
                                    </form>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.user.edit', $row->id) }}" class="btn btn-sm btn-primary">Ubah</a>
                                <form action="{{ route('admin.user.destroy', $row->id) }}" method="post" class="d-inline">
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
    <div class="modal fade" id="tambahAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('admin.user.store') }}" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-1">
                            <select class="select2-bootstrap4 form-control bg-light fs-6" data-dropdown-parent="#tambahAdmin" id="poli" name="poli">
                                <option value="1" selected>-- Pilih Poli --</option>
                                @foreach ($poli as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-floating mb-1">
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="username" value="{{ old('username') }}">
                            <label for="username">Username</label>
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-floating mb-1">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="password" value="{{ old('password') }}">
                            <label for="password">Password</label>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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