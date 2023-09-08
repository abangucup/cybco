@extends('templates.app')

@section('title', 'Jadwal')

@section('content')
<h4 class="fw-bold"><a class="text-muted fw-light" href="{{ route('dashboard.admin') }}">Dashboard /</a> Siswa
</h4>
<span class="fw-bold">List semua data siswa</span>

<div class="card mt-4">
    <div class="card-body">
        <div class="table-responsive  text-nowrap">
            <table class="table table-bordered myTable">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Guru</th>
                        <th>Tanggal Konseling</th>
                        <th>Jam Konseling</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0 text-center">
                    @foreach ($siswa->jadwal as $jadwal)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $jadwal->guru->biodata->nama }}</td>
                        <td>{{ $jadwal->tanggal_konseling }}</td>
                        <td>{{ $jadwal->jam_konseling }}</td>
                        <td>{{ $jadwal->keterangan }}</td>
                        <td
                            class="{{ $jadwal->status == 'menunggu' ? 'text-danger' : ($jadwal->status == 'berlangsung' ? 'text-warning' : 'text-success') }}">
                            {{ $jadwal->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-4">
                {{-- {{ $siswa->links() }} --}}
            </div>

        </div>
    </div>
</div>
@endsection