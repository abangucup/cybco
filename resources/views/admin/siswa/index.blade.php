@extends('templates.app')

@section('title', 'Halaman Siswa')

@section('content')

<h4 class="fw-bold"><a class="text-muted fw-light" href="{{ route('dashboard.admin') }}">Dashboard /</a> Siswa
</h4>
<span class="fw-bold">List semua data siswa</span>

<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-header fw-bold">Table Siswa</h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahSiswa">Tambah Siswa</button>
    </div>

    {{-- MODAL TAMBAH SISWA--}}
    @include('admin.siswa.modal_tambah')
    {{-- END MODAL TAMBAH --}}

    <div class="table-responsive">
        <table class="table myTable">
            <thead class="text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>NIS</th>
                    <th>Kelas</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Nama Ortu</th>
                    <th>Nomor Telp. Ortu</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0 text-center">
                @foreach ($siswa as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->biodata->nama }}</td>
                    <td>{{ $data->nis }}</td>
                    <td>{{ $data->kelas }}</td>
                    <td>{{ $data->biodata->alamat ?? 'Kosong'}}</td>
                    <td>{{ $data->biodata->telepon ?? 'Kosong'}}</td>
                    <td>{{ $data->nama_ortu ?? 'Kosong'}}</td>
                    <td>{{ $data->telepon_ortu ?? 'Kosong' }}</td>
                    <td class="text-nowrap">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#hapusSiswa-{{ $data->id }}"
                            class="btn btn-danger"><i class="menu-icon tf-icons bx bx-trash"></i></a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#editSiswa-{{ $data->id }}"
                            class="btn btn-warning"><i class="menu-icon tf-icons bx bx-edit"></i></a>
                    </td>
                </tr>

                {{-- MODAL UBAH --}}
                @include('admin.siswa.modal_ubah')
                {{-- END MODAL UBAH --}}

                {{-- MODAL HAPUS --}}
                @include('admin.siswa.modal_hapus')
                {{-- END MODAL HAPUS --}}

                @endforeach
            </tbody>
        </table>
        <div class="p-4">
            {{ $siswa->links() }}
        </div>

    </div>
</div>
@endsection