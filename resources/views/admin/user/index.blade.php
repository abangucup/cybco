@extends('templates.app')

@section('title', 'Halaman User')

@section('content')
<h4 class="fw-bold"><a class="text-muted fw-light" href="{{ route('dashboard.admin') }}">Dashboard /</a> User
</h4>
<span class="fw-bold">List semua data user / pengguna</span>

<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title fw-bold">Tabel User</h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahUser">Tambah User</button>
    </div>
    <div class="card-body">
        {{-- MODAL TAMBAH --}}
        @include('admin.user.modal_tambah')
        {{-- END MODAL TAMBAH --}}
        <div class="table-responsive text-nowrap">
            <table class="table table-bordered myTable">
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
                        <td>{{ $data->biodata->telepon ?? 'Kosong'}}</td>
                        <td>{{ $data->role }}</td>
                        <td class="text-nowrap">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#hapusUser-{{ $data->id }}"
                                class="btn btn-danger">Hapus</a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#ubahUser-{{ $data->id }}"
                                class="btn btn-warning">Edit</a>
                        </td>
                    </tr>

                    {{-- MODAL UBAH USER --}}
                    @include('admin.user.modal_ubah')
                    {{-- END UBAH USER --}}

                    {{-- MODAL HAPUS USER --}}
                    @include('admin.user.modal_hapus')
                    {{-- END HAPUS USER --}}

                    @endforeach
                </tbody>
            </table>
            <div class="p-4">
                {{ $user->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
            $('.togglePassword').click(function() {
                const passwordInput = $('.password');
                const passwordFieldType = passwordInput.attr('type');

                if (passwordFieldType === 'password') {
                    passwordInput.attr('type', 'text');
                    $('.togglePassword i').removeClass('bx-hide').addClass('bx-show');
                } else {
                    passwordInput.attr('type', 'password');
                    $('.togglePassword i').removeClass('bx-show').addClass('bx-hide');
                }
            });
        });
</script>
@endpush