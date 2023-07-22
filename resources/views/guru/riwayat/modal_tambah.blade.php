<div class="modal fade" id="tambahRiwayat" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Tambah Riwayat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('riwayat.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="jadwal" class="form-label">Jadwal Konseling</label>
                            <select name="jadwal" id="jadwal" class="form-select">
                                <option value="">-- Pilih Jadwal --</option>
                                @foreach ($jadwals as $jadwal)
                                <option value="{{ $jadwal->id }}">{{ $jadwal->siswa->biodata->nama.
                                    " - (Tanggal ".$jadwal->tanggal_konseling.", Jam ".$jadwal->jam_konseling.")" }}
                                </option>
                                @endforeach
                            </select>
                            <sup class="text-danger">jadwal yang muncul adalah jadwal yang belum memiliki riwayat.</sup>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="keterangan" class="form-label">Hasil Konseling</label>
                            <textarea name="keterangan" id="keterangan" cols="10" rows="10"
                                class="form-control"></textarea>
                            <sup class="text-danger">* jabarkan hasil konseling yang telah dilakukan melalui whatsapp.
                                riwayat ini juga akan secara otomatis akan mengirimkan pesa ke orang tua si siswa</sup>
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