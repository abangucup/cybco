<div class="modal fade" id="ubahUser-{{ $data->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Tambah Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.update', $data->id) }}" method="post" enctype="multipart/form-data">
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
                            <label for="telepon" class="form-label">Nomor WA Aktif</label>
                            <div class="input-group">
                                <span class="input-group-text">+62</span>
                                <input type="text" id="telepon" minlength="10" maxlength="13" class="form-control"
                                    value="{{ $data->biodata->telepon }}" placeholder="821xxxxxx" name="telepon"
                                    required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" id="alamat" class="form-control" placeholder="Masukan Alamat"
                                value="{{ $data->biodata->alamat }}" name="alamat" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" class="form-control" placeholder="Username / NUPTK / NIS"
                                value="{{ $data->username }}" name="username" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="password" class="form-label">Password (Jika Perlu)</label>
                            <div class="input-group input-group-merge">
                                <input type="password" class="form-control password" name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer togglePassword"><i
                                        class="bx bx-hide"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="role" class="form-label">Level User</label>
                            <select name="role" id="role" class="form-select" required>
                                <option value="{{ $data->role }}">{{ Str::ucfirst($data->role) }}</option>
                                <option>-- Pilih Level --</option>
                                <option value="admin">Admin</option>
                                <option value="guru">Guru</option>
                                <option value="siswa">Siswa</option>
                            </select>
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