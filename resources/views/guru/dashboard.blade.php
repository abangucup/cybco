@extends('templates.app')

@section('title', 'Dashboard Guru')

@section('content')


<div class="row mb-5">
    <div class="col-md-3">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-2 ms-md-5 mt-md-2 mt-4">
                    <img class="card-img card-img-left" style="height: 100px;"
                        src="{{ asset('assets/img/teacher.svg') }}" alt="Card image">
                </div>
                <div class="col-md-8 text-center">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Guru</h5>
                        <p class="card-text">{{ $jumlahGuru }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-2 ms-md-5 mt-md-2 mt-4">
                    <img class="card-img card-img-left" style="height: 100px"
                        src="{{ asset('assets/img/student.svg') }}" alt="Card image">
                </div>
                <div class="col-md-8 text-center">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Siswa</h5>
                        <p class="card-text">{{ $jumlahSiswa }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-2 ms-md-5 mt-md-2 mt-4">
                    <img class="card-img card-img-left" style="height: 100px" src="{{ asset('assets/img/quiz.svg') }}"
                        alt="Card image">
                </div>
                <div class="col-md-8 text-center">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Kuisioner</h5>
                        <p class="card-text">100
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-2 ms-md-5 mt-md-2 mt-4">
                    <img class="card-img card-img-left" style="height: 100px" src="{{ asset('assets/img/jadwal.svg') }}"
                        alt="Card image">
                </div>
                <div class="col-md-8 text-center">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Jadwal</h5>
                        <p class="card-text">100
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection