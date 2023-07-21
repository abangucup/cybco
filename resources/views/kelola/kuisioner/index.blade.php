@extends('templates.app')

@section('title', 'Kuisioner')

@section('content')
<h4 class="fw-bold"><a class="text-muted fw-light" href="{{ route('dashboard.admin') }}">Dashboard /</a> Kuisioner
</h4>

<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title fw-bold">Data Kuisioner</h5>
        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalPanduan"><i
                class="bx bx-file me-3"></i>Baca Panduan</button>
    </div>


    <div class="card-body">
        {{-- MODAL PANDUAN --}}
        <div class="modal fade" id="modalPanduan" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="exampleModalLabel1">Panduan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="bg-danger p-4 rounded text-white">
                            <p>1. Halaman kuisioner ini berisi data terkait dengan siswa yang telah melakukan pengisian
                                kuisioner pada masing masing akunnya</p>
                            <p>2. Halaman kuisioner ini memuat jumlah jawaban ya dari hasil kuisioner yang telah
                                dilakukan
                                oleh siswa</p>
                            <p>3. Siswa akan diberi keterangan terindikasi bermasalah ketika mencapai batas tertentu
                                (minimal 50%) dari banyak pertanyaan yang menjawab yes</p>
                            <p>4. Siswa yang terindikasi bermasalah atau jawabn "ya" > 50% maka akan ditandai merah
                                sehingga guru dapat membuat jadwal konseling kepada siswa yang bermasalah</p>
                            <p>5. Setelah guru melihat data siswa yang terindikasi bermasalah, maka guru dapat membuat
                                jadwal dengan mudah. pada halaman <a
                                    class="fw-bold text-white text-decoration-underline"
                                    href="{{ route('jadwal.index') }}">Jadwal Konseling</a>
                            </p>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            SELESAI BACA
                        </button>
                    </div>
                </div>
            </div>
        </div>
        {{-- END MODAL PANDUAN --}}

        <div class="table-responsive px-2">
            <table class="table table-bordered myTable">
                <thead class="text-center">
                    <tr>
                        <th rowspan="2" style="width: 5%">No</th>
                        <th rowspan="2" style="width: 50%">Nama Siswa</th>
                        <th colspan="2" style="width: 20%">Jumlah Jawaban</th>
                        <th rowspan="2" style="width: 20%">Keterangan</th>
                    </tr>
                    <tr>
                        <th>Yes</th>
                        <th>No</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswas as $siswa)
                    @php
                    if ($siswa->kuisioner != null) {
                    $totalYa = $siswa->kuisioner()->where('jawaban', 'ya')->count();
                    $persen = ($totalYa / $jumlahKuis) * 100;
                    }
                    @endphp
                    <tr class="{{ $persen > 50/100 ? 'text-white bg-danger' : 'text-white bg-info' }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $siswa->biodata->nama }}</td>
                        <td>{{ $siswa->kuisioner()->where('jawaban', 'ya')->count() ?? 0 }}</td>
                        <td>{{ $siswa->kuisioner()->where('jawaban', 'tidak')->count() ?? 0 }}</td>
                        <td>{{ $persen > 50/100 ?
                            'Bermasalah' :
                            'Baik-baik saja'}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-4">
                {{ $siswas->links() }}
            </div>
        </div>
    </div>
</div>
@endsection