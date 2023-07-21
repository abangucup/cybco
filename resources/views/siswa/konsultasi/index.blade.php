@extends('templates.app')

@section('title', 'Konsultasi')

@section('content')
<h4 class="fw-bold"><a class="text-muted fw-light" href="{{ route('dashboard.admin') }}">Dashboard /</a> Konsultasi
</h4>
<span class="fw-bold">List guru untuk berkonsultasi</span>

<div class="card mt-4">
    <div class="card-body">
        <div class="table-responsive  text-nowrap">
            <table class="table table-bordered myTable">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Guru</th>
                        <th>NUPTK</th>
                        <th>Nomor Telepon</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0 text-center">
                    @foreach ($gurus as $guru)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $guru->biodata->nama }}</td>
                        <td>{{ $guru->nuptk }}</td>
                        <td>{{ $guru->biodata->telepon }}</td>
                        <td><a href=""><i class="menu-icon tf-icons bx bx-message-square-dots"></i> Chat WhatsApp</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-4">
                {{ $gurus->links() }}
            </div>

        </div>
    </div>
</div>
@endsection