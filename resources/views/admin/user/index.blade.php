@extends('templates.app')

@section('title', 'Halaman User')

@section('content')
<h4 class="fw-bold"><a class="text-muted fw-light" href="{{ route('dashboard.admin') }}">Dashboard /</a> User
</h4>
<span class="fw-bold">List semua data user / pengguna</span>

<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-header fw-bold">Tabel User</h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahUser">Tambah User</button>
    </div>
    <div class="modal fade" id="tambahUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label">Name</label>
                            <input type="text" id="nameBasic" class="form-control" placeholder="Enter Name" />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="emailBasic" class="form-label">Email</label>
                            <input type="text" id="emailBasic" class="form-control" placeholder="xxxx@xxx.xx" />
                        </div>
                        <div class="col mb-0">
                            <label for="dobBasic" class="form-label">DOB</label>
                            <input type="text" id="dobBasic" class="form-control" placeholder="DD / MM / YY" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table myTable">
            <thead class="text-center">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Level</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0 text-center">
                @foreach ($user as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->biodata->nama }}</td>
                    <td>{{ $data->username }}</td>
                    <td>{{ $data->email ?? 'Kosong'}}</td>
                    <td>{{ $data->telepon ?? 'Kosong'}}</td>
                    <td>{{ $data->role }}</td>
                    <td>
                        <a href="" class="btn btn-danger">Hapus</a>
                        <a href="" class="btn btn-warning">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">
            {{ $user->links() }}
        </div>
    </div>
</div>
@endsection