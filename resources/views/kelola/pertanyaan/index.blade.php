@extends('templates.app')

@section('title', 'Pertanyaan')

@section('content')
<h4 class="fw-bold"><a class="text-muted fw-light" href="{{ route('dashboard.admin') }}">Dashboard /</a> Pertanyaan
</h4>
<span class="fw-bold">List semua data pertanyaan</span>

<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title fw-bold">Table Siswa</h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPertanyaan">Tambah
            Pertanyaan</button>
    </div>


    <div class="card-body">
        {{-- MODAL TAMBAH SISWA--}}
        <div class="modal fade" id="tambahPertanyaan" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Tambah Pertanyaan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('pertanyaan.store') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="pertanyaan" class="form-label">Pertanyaan</label>
                                    <textarea class="form-control" name="pertanyaan" id="pertanyaan" cols="30"
                                        rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- END MODAL TAMBAH --}}
        <div class="table-responsive text-nowrap">
            <table class="table table-bordered myTable">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Pertanyaan</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0 text-center">
                    @foreach ($pertanyaans as $pertanyaan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pertanyaan->pertanyaan }}</td>
                        <td class="text-nowrap">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#hapusPertanyaan-{{ $pertanyaan->id }}"
                                class="btn btn-danger"><i class="menu-icon tf-icons bx bx-trash"></i></a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#ubahPertanyaan-{{ $pertanyaan->id }}"
                                class="btn btn-warning"><i class="menu-icon tf-icons bx bx-edit"></i></a>
                        </td>
                    </tr>

                    {{-- MODAL UBAH --}}
                    <div class="modal fade" id="ubahPertanyaan-{{ $pertanyaan->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel1">Ubah Pertanyaan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('pertanyaan.update', $pertanyaan->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="pertanyaan" class="form-label">Pertanyaan</label>
                                                <textarea class="form-control" name="pertanyaan" id="pertanyaan"
                                                    cols="30" rows="5">{{ $pertanyaan->pertanyaan }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                        <button type="submit" class="btn btn-warning">Ubah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- END MODAL UBAH --}}

                    {{-- MODAL HAPUS --}}
                    <div class="modal fade" id="hapusPertanyaan-{{ $pertanyaan->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel1">Hapus Pertanyaan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('pertanyaan.destroy', $pertanyaan->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col mb-3">
                                                <span class="fw-bold text-danger h5 text-wrap">Yakin ingin hapus data
                                                    pertanyaan</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                            Tidak
                                        </button>
                                        <button type="submit" class="btn btn-danger">Konfirmasi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- END MODAL HAPUS --}}

                    @endforeach
                </tbody>
            </table>
            <div class="p-4">
                {{ $pertanyaans->links() }}
            </div>

        </div>
    </div>
</div>
@endsection