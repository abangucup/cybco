<div class="modal fade" id="modalOrtu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Tambah Biodata Orang Tua</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('profile.ortu') }}" method="post">
                @csrf
                <div class="modal-body">
                    @if ($user->biodata->siswa->nama_ortu == null)
                    <div class="row">
                        <div class="col mb-3">
                            <label for="namaOrtu" class="form-label">Nama Orang Tua</label>
                            <input type="text" class="form-control" placeholder="Nama Orang Tua" id="namaOrtu"
                                name="nama_ortu" required />
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col mb-3">
                            <label for="teleponOrtu" class="form-label">Telepon Wa Aktif Orang Tua</label>
                            <input type="number" class="form-control" placeholder="08xxxxx" name="telepon_ortu"
                                id="teleponOrtu" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>