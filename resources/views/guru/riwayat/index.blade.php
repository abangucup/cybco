@extends('templates.app')

@section('title', 'Riwayat Konseling')

@section('content')
<h4 class="fw-bold"><a class="text-muted fw-light" href="{{ route('dashboard.admin') }}">Dashboard /</a> Riwayat
</h4>
<span class="fw-bold">List semua riwayat konseling siswa</span>

<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title fw-bold">Tabel Riwayat Konseling</h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahRiwayat">Tambah Riwayat</button>
    </div>

    <div class="card-body">
        {{-- MODAL TAMBAH SISWA--}}
        @include('guru.riwayat.modal_tambah')
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
                    @foreach ($riwayats as $riwayat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $riwayat->jadwal->siswa->biodata->nama }}</td>
                        <td>{{ $riwayat->jadwal->tanggal_konseling.", Jam ".$riwayat->jadwal->jam_konseling }}</td>
                        <td class="text-wrap">{{ $riwayat->keterangan }}</td>
                        <td>
                            <a href="#" class="text-danger" data-bs-toggle="modal"
                                data-bs-target="#hapusRiwayat-{{ $riwayat->id }}" data-bs-offset="0,4"
                                data-bs-placement="top" data-bs-html="true" title="Hapus Riwayat"><i
                                    class="menu-icon tf-icons bx bx-trash"></i></a>
                            {{-- <a href="{{ route('riwayat.show', $riwayat->id) }}" class="text-success"
                                data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                title="Detail Riwayat"><i class="menu-icon tf-icon bx bx-show"></i></a> --}}
                        </td>
                    </tr>

                    {{-- MODAL HAPUS --}}
                    @include('guru.riwayat.modal_hapus')
                    {{-- END MODAL HAPUS --}}

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