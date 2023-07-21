@extends('templates.app')

@section('title', 'Halaman Jadwal')

@section('content')
<h4 class="fw-bold"><a class="text-muted fw-light" href="{{ route('dashboard.admin') }}">Dashboard /</a> Jadwal
</h4>
<span class="fw-bold">List semua jadwal konseling siswa saya</span>

<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title fw-bold">Tabel Jadwal Konseling</h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahSiswa">Tambah Jadwal</button>
    </div>

    <div class="card-body">
        {{-- MODAL TAMBAH SISWA--}}
        @include('guru.jadwal.modal_tambah')
        {{-- END MODAL TAMBAH --}}

        <div class="table-responsive  text-nowrap">
            <table class="table table-bordered myTable">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>NIS</th>
                        <th>Kelas</th>
                        <th>Waktu Konseling</th>
                        <th>Telepon</th>
                        <th>Keterangan</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0 text-center">
                    @foreach ($jadwals as $jadwal)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $jadwal->siswa->biodata->nama }}</td>
                        <td>{{ $jadwal->siswa->nis }}</td>
                        <td>{{ $jadwal->siswa->kelas }}</td>
                        <td>{{ $jadwal->tanggal_konseling.', Jam '. $jadwal->jam_konseling}}</td>
                        <td>{{ $jadwal->siswa->biodata->telepon }}</td>
                        <td class="text-wrap">{{ $jadwal->keterangan }}</td>
                        <td>
                            <a href="#" class="text-danger" data-bs-toggle="modal"
                                data-bs-target="#hapusJadwal-{{ $jadwal->id }}" data-bs-offset="0,4"
                                data-bs-placement="top" data-bs-html="true" title="Hapus Jadwal"><i
                                    class="menu-icon tf-icons bx bx-trash"></i></a>
                            <a href="#" class="text-warning" data-bs-toggle="modal"
                                data-bs-target="#ubahJadwal-{{ $jadwal->id }}" data-bs-offset="0,4"
                                data-bs-placement="top" data-bs-html="true" title="Ubah Jadwal"><i
                                    class="menu-icon tf-icons bx bx-edit"></i></a>
                            <a href="#" class="text-success" data-bs-offset="0,4" data-bs-placement="top"
                                data-bs-html="true" title="Chat WhatsApp"><i
                                    class="menu-icon tf-icon bx bx-message-square-dots"></i></a>
                        </td>
                    </tr>

                    {{-- MODAL UBAH --}}
                    @include('guru.jadwal.modal_ubah')
                    {{-- END MODAL UBAH --}}

                    {{-- MODAL HAPUS --}}
                    @include('guru.jadwal.modal_hapus')
                    {{-- END MODAL HAPUS --}}

                    @endforeach
                </tbody>
            </table>
            <div class="p-4">
                {{ $jadwals->links() }}
            </div>

        </div>
    </div>
</div>
@endsection