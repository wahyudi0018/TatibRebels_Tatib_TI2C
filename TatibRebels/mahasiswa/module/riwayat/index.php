<link rel="stylesheet" href="assets/css/Style.css">
    
    <!-- INI HTML RIWAYAT PELANGGARAN-->
    <div class="container-riwayat-pelanggaran">
        <div class="title">
             <p style="font-size: 20px; font-weight: var(--font-weight-manrope-bold);">Pelanggaran Anda</p>
        </div>
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Pelapor</th>
                        <th class="pelanggaran-column">Pelanggaran</th>
                        <th>Tingkat Pelanggaran</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Fungsi Tampil Riwayat Pelanggaran -->
                    <?php
                    $mahasiswa->tampilRiwayatPelanggaran();
                    ?>
                </tbody>
            </table>
<?php

?>
    </div>