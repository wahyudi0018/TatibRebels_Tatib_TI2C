<link rel="stylesheet" href="assets/css/Style.css">

    <!-- INI HTML RIWAYAT PELANGGARAN-->
    <div class="container-riwayat-pelanggaran">
        <div class="title">
            <p style="font-size: 20px; font-weight: var(--font-weight-manrope-bold);">Pelaporan Anda</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th class="tgl-column">Tanggal</th>
                    <th class="nim-terlapor-column">NIM</th>
                    <th class="nama-terlapor-column">Nama</th>
                    <th class="pelanggaran-column">Pelanggaran</th>
                    <th class="tingkat-column">Tingkat Pelanggaran</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!-- Fungsi Tampil Riwayat Pelanggaran -->
                <?php
                $dosen->tampilRiwayatLaporan();
                ?>
            </tbody>
        </table>
    </div>