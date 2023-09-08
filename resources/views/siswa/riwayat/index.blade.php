@extends('templates.app')

@section('title', 'Riwayat Konseling')

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
                        <th>NUPTK</th>
                        <th>Waktu Konseling</th>
                        <th>Hasil Konseling</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0 text-center">
                    @foreach ($riwayats as $riwayat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $riwayat->jadwal->guru->biodata->nama }}</td>
                        <td>{{ $riwayat->jadwal->guru->nuptk }}</td>
                        <td>{{ $riwayat->jadwal->tanggal_konseling.", Jam ".$riwayat->jadwal->jam_konseling }}</td>
                        <td>{{ $riwayat->keterangan }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-4">
                {{ $riwayats->links() }}
            </div>

        </div>
    </div>
</div>
@endsection