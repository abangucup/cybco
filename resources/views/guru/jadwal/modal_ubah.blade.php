<div class="modal fade" id="ubahJadwal-{{ $jadwal->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Ubah Jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('jadwal.update', $jadwal->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <select name="siswa_id" id="nama" class="form-select">
                                <option value="{{ $jadwal->siswa_id }}">{{ $jadwal->siswa->biodata->nama }}</option>
                                <option value="">-- Pilih Siswa --</option>
                                @foreach ($siswas as $siswa)
                                <option value="{{ $siswa->id }}">{{ $siswa->biodata->nama }}</option>
                                @endforeach
                            </select>
                            <sup class="text-danger">list siswa berupa siswa yang bermasalah (ya > 50%)</sup>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="tanggal" class="form-label">Tanggal Konseling</label>
                            <input type="date" id="tanggal" class="form-control" name="tanggal_konseling"
                                value="{{ $jadwal->tanggal_konseling }}" required />
                            <sup class="text-danger">* Format tanggal (Bulan / Hari / Tahun) <br>Contoh (07 / 22 /
                                2023)</sup>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="jam" class="form-label">Jam Konseling</label>
                            <input type="time" id="jam" class="form-control" name="jam_konseling"
                                value="{{ $jadwal->jam_konseling }}" required />
                            <sup class="text-danger">- AM (jam 12:00 malam - 11:59 siang) <br>- PM (jam 12:00 siang -
                                11:59 malam)</sup>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" cols="10" rows="5"
                                class="form-control">{{ $jadwal->keterangan }}</textarea>
                            <sup class="text-danger text-wrap">* berikan keterangan singkat, dimana keterangan ini akan
                                dikirimkan secara otomatis ke anda sesuai dengan jadwal sebagai pengingat</sup>
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