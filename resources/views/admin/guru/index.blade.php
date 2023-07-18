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
    <div class="modal fade" id="tambahGuru" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Tambah Guru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('guru.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" id="nama" class="form-control" placeholder="Masukan Nama" name="nama"
                                    required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nuptk" class="form-label">NUPTK / Username</label>
                                <input type="text" id="nuptk" class="form-control" placeholder="Masukan NUPTK"
                                    name="nuptk" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" id="alamat" class="form-control"
                                    placeholder="Alamat Lengkap (jika ada)" name="alamat" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="telepon" class="form-label">Nomor WA Aktif</label>
                                <input type="number" id="telepon" class="form-control" placeholder="08xxxxxxx"
                                    name="telepon" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="foto" class="form-label">Foto (jika ada)</label>
                                <input type="file" id="foto" class="form-control" name="foto" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table myTable">
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
@endsection