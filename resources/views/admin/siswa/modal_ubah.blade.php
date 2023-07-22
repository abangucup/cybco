<div class="modal fade" id="editSiswa-{{ $data->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Ubah Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('siswa.update', $data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" id="nama" class="form-control" placeholder="Masukan Nama" name="nama"
                                value="{{ $data->biodata->nama }}" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nik" class="form-label">NIS</label>
                            <input type="text" id="nik" class="form-control" placeholder="Masukan NIS" name="nis"
                                value="{{ $data->nis }}" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <input type="text" id="kelas" class="form-control" placeholder="11 (A)" name="kelas"
                                value="{{ $data->kelas }}" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" id="alamat" class="form-control" placeholder="Alamat Lengkap (jika ada)"
                                value="{{ $data->biodata->alamat }}" name="alamat" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="telepon" class="form-label">Nomor WA Aktif</label>
                            <div class="input-group">
                                <span class="input-group-text">+62</span>
                                <input type="text" id="telepon" class="form-control" placeholder="821xxxxxxx"
                                    value="{{ $data->biodata->telepon }}" name="telepon" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nama_ortu" class="form-label">Nama Orang Tua</label>
                            <input type="text" id="nama_ortu" class="form-control" placeholder="Nama Orang Tua"
                                value="{{ $data->nama_ortu }}" name="nama_ortu" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="telepon_ortu" class="form-label">Nomor WA Orang Tua</label>
                            <div class="input-group">
                                <span class="input-group-text">+62</span>
                                <input type="text" id="telepon_ortu" class="form-control" placeholder="821xxxxx"
                                    value="{{ $data->telepon_ortu }}" name="telepon_ortu" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="foto" class="form-label">Foto (jika ada)</label>
                            <input type="file" id="foto" class="form-control" name="foto" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-warning">Ubah Data</button>
                </div>
            </form>
        </div>
    </div>
</div>