@extends('templates.app')

@section('title', 'Dashboard Admin')

@section('content')


{{-- <div class="row mb-5">
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
</div> --}}
<h4 class="fw-bold"><a class="text-muted fw-light" href="{{ route('dashboard.admin') }}">Dashboard /</a> Profile
</h4>
<span class="fw-bold">Halaman Profile</span>

<div class="card mt-4">
    <h5 class="card-header">Details {{ $profile->biodata->nama }}</h5>
    <!-- Account -->
    <div class="card-body">
        <div class="d-flex align-items-start align-items-sm-center gap-4">
            <img src="{{ $profile->biodata->foto != '' ? asset($profile->biodata->foto) : asset('assets/img/profile.svg') }}"
                alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
            <div class="button-wrapper">
                <h5>{{ $profile->biodata->nama }}</h5>

                <p class="text-muted mb-0">
                    {{ $profile->username }}
                </p>
            </div>
        </div>
    </div>
    <hr class="my-0" />
    <div class="card-body">
        <form id="formAccountSettings" method="POST" onsubmit="return false">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input class="form-control" type="text" id="nama" name="nama" value="{{ $profile->biodata->nama }}"
                        autofocus readonly />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="username" class="form-label">Username</label>
                    <input class="form-control" type="text" name="username" id="username"
                        value="{{ $profile->username }}" readonly />
                </div>

                <div class="mb-3 col-md-6">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input class="form-control" type="text" id="alamat" name="alamat"
                        value="{{ $profile->biodata->alamat }}" placeholder="john.doe@example.com" readonly />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ $profile->email }}"
                        readonly />
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="telepon">Telepon</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">ID (+62)</span>
                        <input type="text" id="telepon" name="telepon" class="form-control" placeholder="821 5448 8769"
                            value="{{ $profile->biodata->telepon }}" disabled />
                    </div>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="role" class="form-label">Role</label>
                    <input type="text" class="form-control" id="role" name="role" placeholder="role"
                        value="{{ $profile->role }}" readonly />
                </div>

                @if ($profile->role == 'guru')
                <div class="mb-3 col-md-6">
                    <label for="nuptk" class="form-label">NUPTK</label>
                    <input class="form-control" type="text" id="nuptk" name="nuptk"
                        value="{{ $profile->biodata->guru->nuptk }}" placeholder="mail.doe@example.com" readonly />
                </div>
                @elseif ($profile->role == 'siswa')
                <div class="mb-3 col-md-6">
                    <label for="nis" class="form-label">NIS</label>
                    <input class="form-control" type="text" id="nis" name="nis"
                        value="{{ $profile->biodata->siswa->nis }}" placeholder="john.doe@example.com" readonly />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="kelas" class="form-label">Kelas</label>
                    <input type="text" class="form-control" id="kelas" name="kelas"
                        value="{{ $profile->biodata->siswa->kelas }}" readonly />
                </div>

                <div class="mb-3 col-md-6">
                    <label for="nama_ortu" class="form-label">Nama Orang Tua</label>
                    <input class="form-control" type="text" id="nama_ortu" name="nama_ortu"
                        value="{{ $profile->biodata->siswa->nama_ortu }}" placeholder="Winang" readonly />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="telepon_ortu" class="form-label">Telepon Orang Tua</label>
                    <input type="text" class="form-control" id="telepon_ortu" name="telepon_ortu"
                        value="{{ $profile->biodata->siswa->telepon_ortu }}" readonly />
                </div>
                @endif
            </div>
            <div class="mt-2">
                <a href="#" data-bs-toggle="modal" data-bs-target="#ubahProfile-{{ $profile->biodata->id }}"
                    class="btn btn-warning"><i class="menu-icon tf-icons bx bx-edit"></i> Ubah Profile</a>
            </div>
        </form>
        @include('templates.profile.update_profile')
    </div>
    <!-- /Account -->
</div>
@endsection