@extends('templates.app')

@section('title', 'Kuisioner')

@section('content')
<h4 class="fw-bold"><a class="text-muted fw-light" href="{{ route('dashboard.admin') }}">Dashboard /</a> Halaman
    Kuisioner
</h4>

@if ($siswa->kuisioner->isEmpty())
@include('siswa.kuisioner.tambah')

@else
<div class="row mt-4 text-dark">
    <!-- List group Numbered -->
    <div class="col-lg-12 mb-4 mb-xl-0">
        <h4 class="text-dark fw-bold">HASIL KUISIONER</h4>
        <div class="demo-inline-spacing mt-3">
            <ol class="list-group list-group-numbered">
                @foreach ($siswa->kuisioner as $kuisioner)
                <li class="list-group-item">{{ $kuisioner->pertanyaan->pertanyaan }}
                    <p class="text-danger fw-bold pt-2">
                        <label for="pertanyaan" class="form-lable">Jawaban Saya</label>
                        <select id="pertanyaan" class="form-select" disabled>
                            <option>{{ $kuisioner->jawaban }}</option>
                        </select>
                    </p>
                </li>
                @endforeach
            </ol>
        </div>
    </div>
</div>
@endif

@endsection