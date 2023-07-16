@extends('templates.app')

@section('title', 'Halaman Siswa')

@section('content')

<h4 class="fw-bold"><a class="text-muted fw-light" href="{{ route('dashboard.admin') }}">Dashboard /</a> Siswa
</h4>
<span class="fw-bold">List semua data siswa</span>

<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="card-header fw-bold">Table Siswa</h5>
        <button class="btn btn-primary"></button>
    </div>
    <div class="table-responsive text-nowrap">
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
                    <td>
                        <a href="" class="btn btn-danger">Hapus</a>
                        <a href="" class="btn btn-warning">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">
            {{ $siswa->links() }}
        </div>
    </div>
</div>
@endsection