@extends('templates.app')

@section('title', 'Halaman User')

@section('content')
<h4 class="fw-bold"><a class="text-muted fw-light" href="{{ route('dashboard.admin') }}">Dashboard /</a> User
</h4>
<span class="fw-bold">List semua data user / pengguna siswa</span>

<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-header fw-bold">Tabel User</h5>
        <button class="btn btn-primary">Tambah User</button>
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