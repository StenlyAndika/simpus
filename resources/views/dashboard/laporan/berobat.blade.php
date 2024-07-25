@extends('layout.admin')

@section('container')
    <div class="card radius-10 full-height">
        <div class="card-header">
            <h5 class="mt-2">Laporan Berobat</h5>
        </div>
        <div class="card-header mt-2 border-start border-0 border-4 border-danger">
            <form method="GET" action="{{ url('/dashboard/laporan/berobat') }}">
                <input type="date" name="tgl_awal" value="{{ $tgl_awal }}">
                <input type="date" name="tgl_akhir" value="{{ $tgl_akhir }}">
                <button type="submit" class="btn btn-sm btn-success">
                    Cari Data
                </button>
                <a href="{{ route('admin.laporan.printberobat', ['tgl_awal' => $tgl_awal, 'tgl_akhir' => $tgl_akhir]) }}" class="btn btn-sm btn-primary">
                    Cetak Laporan
                </a>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tgl Pendaftaran</th>
                            <th>Poli</th>
                            <th>Nama Dokter</th>
                            <th>Nama Pasien</th>
                            <th>Nomor Induk Kependudukan</th>
                            <th>Nama KK</th>
                            <th>No MR</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>S</th>
                            <th>O</th>
                            <th>A</th>
                            <th>P</th>
                            <th>KIE</th>
                            <th>Rujukan dan Lain-lain</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendaftaran as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->tglpendaftaran }}</td>
                                <td>{{ $item->poli }}</td>
                                <td>{{ $item->namadokter }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->nik }}</td>
                                <td>{{ $item->namakk }}</td>
                                <td>{{ $item->nomr }}</td>
                                <td>{{ $item->jekel }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{!! $item->s !!}</td>
                                <td>
                                    @php
                                        $objektif = App\Models\Objektif::where('idp', $item->idp)->first();
                                    @endphp
                                    td : {{ $objektif->td }} MmHg, n : {{ $objektif->n }} x/mnt <br>
                                    r : {{ $objektif->r }} x/mnt, s : {{ $objektif->s }} °C <br>
                                    tb : {{ $objektif->tb }} cm, bb : {{ $objektif->bb }} kg <br>
                                    kepala : {{ $objektif->kepala }}, dada : {{ $objektif->dada }} <br>
                                    abdomen : {{ $objektif->abdomen }}, extermitas : {{ $objektif->extermitas }}
                                </td>
                                <td>{!! $item->a !!}</td>
                                <td>
                                    {!! $item->p !!}
                                    Alergi terhadap obat:
                                    {!! $item->alergi!!}
                                    <br>
                                    Obat diambil :
                                    @php
                                        $obatkeluar = App\Models\ObatKeluar::join('obat', 'obat.id', 'obatkeluar.idobat')->where('idp', $item->idp)->get();
                                    @endphp
                                    @foreach ($obatkeluar as $row)
                                        {{ $row->nama }} {{ $row->jumlah }} {{ $row->jenis }} <br>
                                    @endforeach
                                </td>
                                <td>{!! $item->kie !!}</td>
                                <td>{!! $item->rujukan !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection