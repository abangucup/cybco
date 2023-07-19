@extends('templates.app')

@section('title', 'Halaman Guru')

@section('content')

<h4 class="fw-bold"><a class="text-muted fw-light" href="{{ route('dashboard.admin') }}">Dashboard /</a> Guru
</h4>
<span class="fw-bold">List semua data guru BK</span>

<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title fw-bold">Table Guru</h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahGuru">Tambah Guru</button>
    </div>

    <div class="card-body">
        {{-- MODAL TAMBAH --}}
        @include('admin.guru.modal_tambah')
        {{-- END MODAL TAMBAH --}}

        <div class="table-responsive text-nowrap">
            <table class="table table-bordered myTable">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Guru</th>
                        <th>NUPTK</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0 text-center">
                    @foreach ($guru as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->biodata->nama }}</td>
                        <td>{{ $data->nuptk }}</td>
                        <td>{{ $data->biodata->alamat ?? 'Kosong'}}</td>
                        <td>{{ $data->biodata->telepon ?? 'Kosong'}}</td>
                        <td>{{ $data->biodata->user->username }}</td>
                        <td>{{ $data->biodata->user->email ?? 'Kosong'}}</td>
                        <td>
                            <a href="#" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#hapusGuru-{{ $data->id }}">Hapus</a>
                            <a href="#" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editGuru-{{ $data->id }}">Edit</a>
                        </td>
                    </tr>

                    {{-- MODAL EDIT GURU--}}
                    @include('admin.guru.modal_edit')
                    {{-- END MODAL EDIT --}}

                    {{-- KONFIRMASI HAPUS --}}
                    @include('admin.guru.modal_hapus')
                    {{-- END KONFIRMASI HAPUS --}}
                    @endforeach
                </tbody>
            </table>
            <div class="p-4">
                {{ $guru->links() }}
            </div>
        </div>
    </div>
</div>
@endsection