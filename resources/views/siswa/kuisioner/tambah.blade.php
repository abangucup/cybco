<div class="bg-danger p-3 rounded text-white">
    <h5 class="fw-bold text-white">Peringatan *</h5>
    <p>1. Silahkan para siswa untuk mengisi kuisioner yang telah disediakan oleh guru BK</p>
    <p>2. Siswa wajib mengisi kuisioner dengan jawaban yang sebenar-benarnya dengan memilih jawaban "ya" atau "tidak"
    </p>
    <p>3. Jawaban yang dipilih oleh siswa akan dikumaltif oleh sistem untuk dijadikan sebagai acuan guru seberapa tinggi
        masalah anda</p>
    <p>4. Jika siswa telah mengisi kuisioner, maka halaman ini akan menampilkan hasil dari siswa berdasarakan pertanyaan
    </p>
    <p>5. Jika terdapat siswa yang memiliki tingkat masalah yang tinggi, guru akan menjadwalkan waktu untuk melakukan
        konseling lebih lanjut melalui whatsapp</p>
    <p>6. Konseling dilakukan untuk mendapatkan penyebab permasalahan yang siswa hadapi</p>
    <p>7. Hasil konseling akan dikirimkan ke orang tua siswa sebagai bahan evaluasi orang tua dan guru</p>
</div>

<div class="row mt-4 text-dark">
    <!-- List group Numbered -->
    <div class="col-lg-12 mb-4 mb-xl-0">
        <h4 class="text-dark fw-bold">KUISIONER</h4>
        <form action="{{ route('kuisioner.store') }}" method="post">
            @csrf

            <div class="demo-inline-spacing mt-3">
                <ol class="list-group list-group-numbered">
                    @foreach ($pertanyaans as $pertanyaan)

                    <input type="text" hidden readonly name="pertanyaan[]" value="{{ $pertanyaan->id }}">
                    <input type="text" hidden readonly name="siswa" value="{{ $siswa->id }}">
                    <li class="list-group-item">{{ $pertanyaan->pertanyaan }}
                        <p class="text-danger fw-bold pt-2">
                            <label for="pertanyaan" class="form-lable">Pilih Jawaban</label>
                            <select name="jawaban[]" id="pertanyaan" class="form-select">
                                <option value="ya">Ya</option>
                                <option value="tidak">Tidak</option>
                            </select>
                        </p>
                    </li>
                    @endforeach
                </ol>
            </div>

            <button class="btn btn-primary mt-2" type="submit">Simpan Kuisioner</button>

        </form>
    </div>
</div>