@extends('templates.app')

@section('title', 'Riwayat Konseling')

@section('content')
<h4 class="fw-bold"><a class="text-muted fw-light" href="{{ route('dashboard.admin') }}">Dashboard /</a> Riwayat
</h4>
<span class="fw-bold">Laporan</span>

<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title fw-bold">List Laporan</h5>
        {{-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahRiwayat">Unduh Data</button>
        --}}
        <a href="{{ route('unduh.semua') }}" class="btn btn-primary">Unduh Semua Data</a>

    </div>

    <div class="card-body">
        {{-- MODAL TAMBAH SISWA--}}
        {{-- @include('guru.riwayat.modal_tambah') --}}
        {{-- END MODAL TAMBAH --}}

        <div class="table-responsive  text-nowrap">
            <table class="table table-bordered myTable">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Waktu Konseling</th>
                        <th>Hasil Konseling</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0 text-center">
                    @foreach ($jadwals as $jadwal)

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $jadwal->siswa->biodata->nama ?? ''}}</td>
                        <td>{{ $jadwal->tanggal_konseling.", Jam ".$jadwal->jam_konseling ?? ''}}</td>
                        <td class="text-wrap">{{ $jadwal->riwayat->keterangan ?? ''}}</td>
                        <td>
                            <a href="{{ route('unduh.perid', ['id' => $jadwal->id]) }}" target="_blank"><i
                                    class="menu-icon tf-icon bx bx-printer"></i></a>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
            <div class="p-4">
                {{-- {{ $jadwals->links() }} --}}
            </div>

        </div>
    </div>
</div>
@endsection