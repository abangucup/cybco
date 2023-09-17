<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style layout-menu-fixed"
    data-assets-path="{{ asset('assets/') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Test</title>
</head>

<body>

    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <div class="layout-page">

                <div class="content-wrapper">

                    <div class="container-xxl flex-grow-1 container-p-y">

                        <table class="table table-bordered myTable">
                            <thead class="text-center">
                                <tr>
                                    <th>Nama Siswa</th>
                                    <th>Waktu Konseling</th>
                                    <th>Hasil Konseling</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0 text-center">
                                @foreach ($jadwals as $jadwal)


                                <tr>
                                    <td>{{ $jadwal->siswa->biodata->nama ?? ''}}</td>
                                    <td>{{ $jadwal->tanggal_konseling.", Jam ".$jadwal->jam_konseling ?? ''}}</td>
                                    <td class="text-wrap">{{ $jadwal->riwayat->keterangan ?? ''}}</td>
                                    <td>
                                        <a href="{{ route('unduh.perid', ['id' => $jadwal->id]) }}" target="_blank"><i
                                                class="menu-icon tf-icon bx bx-printer"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>


                    </div>


                    <div class="content-backdrop fade"></div>
                </div>
            </div>

        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

</body>

</html>