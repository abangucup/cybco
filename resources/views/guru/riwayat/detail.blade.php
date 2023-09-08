@extends('templates.app')

@section('title', 'Riwayat Konseling')

@section('content')
<h4 class="fw-bold"><a class="text-muted fw-light" href="{{ route('dashboard.admin') }}">Dashboard /</a>
    <a class="text-muted fw-light" href="{{ route('riwayat.index') }}">Riwayat / </a>{{
    $riwayat->jadwal->siswa->biodata->nama . "( " .
    $riwayat->jadwal->tanggal_konseling. ", ".$riwayat->jadwal->jam_konseling." )" }}
</h4>
<span class="fw-bold">Detail riwayat {{ $riwayat->jadwal->siswa->biodata->nama }}</span>

<div class="col-xl-12 mt-4">
    <div class="nav-align-top mb-4">
        <ul class="nav nav-tabs nav-fill" role="tablist">
            <li class="nav-item">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                    data-bs-target="#tabBiodata" aria-controls="tabBiodata" aria-selected="true">
                    <i class="tf-icons bx bx-user pe-3"></i> Biodata
                </button>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="tabBiodata" role="tabpanel">
                <div class="mb-3 row">
                    <label for="nama" class="col-md-2 col-form-label">Nama</label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" value="Sneat" id="nama" />
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection