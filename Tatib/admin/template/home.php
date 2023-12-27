<?php
include 'fungsi/pesan_kilat.php';
?>
<link rel="stylesheet" href="assets/css/Style.css">

    <!-- HOMEPAGE ADMIN-->
    <div class="homepage-admin">
        <div class="full-content-homepage-admin">
            <?php
            if (isset($_SESSION['_flashdata'])) {
                foreach ($_SESSION['_flashdata'] as $key => $val) {
                    echo get_flashdata($key);
                }
            }
            ?>
            <div class="container-pelaporan" style="margin-top: 20px;">
                <!-- Fungsi Hitung Semua Laporan -->
                <?php
                $result_hitung = $admin->hitungSemuaLaporan();
                while ($row = mysqli_fetch_assoc($result_hitung)) {
                ?>
                <div class="informasi-pelaporan">
                    <div class="icon-info-pelaporan">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none">
                            <rect width="40" height="40" fill="#FEBB3A" fill-opacity=".2" rx="20" />
                            <path fill="#FEBB3A"
                                d="M20 21.75c-.41 0-.75-.34-.75-.75v-5.25c0-.41.34-.75.75-.75s.75.34.75.75V21c0 .41-.34.75-.75.75Zm0 3.5a.99.99 0 0 1-.71-.29c-.09-.1-.16-.21-.22-.33a.986.986 0 0 1-.07-.38c0-.26.11-.52.29-.71.37-.37 1.05-.37 1.42 0 .18.19.29.45.29.71 0 .13-.03.26-.08.38s-.12.23-.21.33a.99.99 0 0 1-.71.29Z" />
                            <path fill="#FEBB3A"
                                d="M20 30.75c-.67 0-1.35-.17-1.95-.52l-5.94-3.43c-1.2-.7-1.95-1.99-1.95-3.38v-6.84c0-1.39.75-2.68 1.95-3.38l5.94-3.43c1.2-.7 2.69-.7 3.9 0l5.94 3.43c1.2.7 1.95 1.99 1.95 3.38v6.84c0 1.39-.75 2.68-1.95 3.38l-5.94 3.43c-.6.35-1.28.52-1.95.52Zm0-20c-.41 0-.83.11-1.2.32l-5.94 3.43c-.74.43-1.2 1.22-1.2 2.08v6.84c0 .85.46 1.65 1.2 2.08l5.94 3.43c.74.43 1.66.43 2.39 0l5.94-3.43c.74-.43 1.2-1.22 1.2-2.08v-6.84c0-.85-.46-1.65-1.2-2.08l-5.94-3.43c-.36-.21-.78-.32-1.19-.32Z" />
                        </svg>
                    </div>
                    <p style="font-weight: var(--font-weight-manrope-semibold); opacity: 80%;">Laporan yang Diajukan Dosen
                    </p>
                    <div class="jumlah-pelanggaran">
                        <p style="font-size: var(--font-size-15xl); font-weight: var(--font-weight-manrope-semibold);"><?=$row['Baru']?>
                        </p>
                    </div>
                </div>
                <div class="informasi-pelaporan">
                    <div class="icon-info-pelaporan">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none">
                            <rect width="40" height="40" fill="#FEBB3A" fill-opacity=".2" rx="20" />
                            <path fill="#FEBB3A"
                                d="M20 30.75c-1.13 0-2.21-.33-3.02-.94l-4.3-3.21c-1.14-.85-2.03-2.62-2.03-4.04v-7.44c0-1.54 1.13-3.18 2.58-3.72l4.99-1.87c.99-.37 2.55-.37 3.54 0l5 1.87c1.45.54 2.58 2.18 2.58 3.72v3.43c0 .41-.34.75-.75.75s-.75-.34-.75-.75v-3.43c0-.91-.75-1.99-1.61-2.32l-4.99-1.87c-.66-.25-1.83-.25-2.49 0l-4.99 1.88c-.86.32-1.61 1.4-1.61 2.32v7.43c0 .95.67 2.28 1.42 2.84l4.3 3.21c.55.41 1.32.64 2.12.64.41 0 .75.34.75.75s-.33.75-.74.75Z" />
                            <path fill="#FEBB3A"
                                d="M24 28.75c-2.62 0-4.75-2.13-4.75-4.75s2.13-4.75 4.75-4.75 4.75 2.13 4.75 4.75-2.13 4.75-4.75 4.75Zm0-7.99c-1.79 0-3.25 1.46-3.25 3.25s1.46 3.25 3.25 3.25 3.25-1.46 3.25-3.25-1.46-3.25-3.25-3.25ZM29 30c-.07 0-.13-.01-.2-.02a.636.636 0 0 1-.18-.06.757.757 0 0 1-.18-.09l-.15-.12c-.18-.19-.29-.45-.29-.71 0-.13.03-.26.08-.38s.12-.23.21-.33c.37-.37 1.05-.37 1.42 0 .09.1.16.21.21.33.05.12.08.25.08.38 0 .26-.11.52-.29.71-.19.18-.45.29-.71.29Z" />
                        </svg>
                    </div>
                    <p style="font-weight: var(--font-weight-manrope-semibold); opacity: 80%;">Laporan Diverifikasi oleh
                        Admin</p>
                    <div class="jumlah-pelanggaran">
                        <p style="font-size: var(--font-size-15xl); font-weight: var(--font-weight-manrope-semibold);"><?=$row['Verifikasi']?>
                        </p>
                    </div>
                </div>
                <div class="informasi-pelaporan">
                    <div class="icon-info-pelaporan">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none">
                            <rect width="40" height="40" fill="#FEBB3A" fill-opacity=".2" rx="20" />
                            <path fill="#FEBB3A"
                                d="M20 20.75c-3.17 0-5.75-2.58-5.75-5.75S16.83 9.25 20 9.25s5.75 2.58 5.75 5.75-2.58 5.75-5.75 5.75Zm0-10A4.26 4.26 0 0 0 15.75 15 4.26 4.26 0 0 0 20 19.25 4.26 4.26 0 0 0 24.25 15 4.26 4.26 0 0 0 20 10.75Zm8.59 20c-.41 0-.75-.34-.75-.75 0-3.45-3.52-6.25-7.84-6.25s-7.84 2.8-7.84 6.25c0 .41-.34.75-.75.75s-.75-.34-.75-.75c0-4.27 4.19-7.75 9.34-7.75 5.15 0 9.34 3.48 9.34 7.75 0 .41-.34.75-.75.75Z" />
                        </svg>
                    </div>
                    <p style="font-weight: var(--font-weight-manrope-semibold); opacity: 80%;">Laporan Dikerjakan
                        Mahasiswa</p>
                    <div class="jumlah-pelanggaran">
                        <p style="font-size: var(--font-size-15xl); font-weight: var(--font-weight-manrope-semibold);"><?=$row['Dikerjakan']?>
                        </p>
                    </div>
                </div>
                <div class="informasi-pelaporan">
                    <div class="icon-info-pelaporan">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none">
                            <rect width="40" height="40" fill="#FEBB3A" fill-opacity=".2" rx="20" />
                            <path fill="#FEBB3A"
                                d="M20 30.75c-5.93 0-10.75-4.82-10.75-10.75S14.07 9.25 20 9.25 30.75 14.07 30.75 20 25.93 30.75 20 30.75Zm0-20c-5.1 0-9.25 4.15-9.25 9.25s4.15 9.25 9.25 9.25 9.25-4.15 9.25-9.25-4.15-9.25-9.25-9.25Z" />
                            <path fill="#FEBB3A"
                                d="M18.58 23.58a.75.75 0 0 1-.53-.22l-2.83-2.83a.754.754 0 0 1 0-1.06c.29-.29.77-.29 1.06 0l2.3 2.3 5.14-5.14c.29-.29.77-.29 1.06 0 .29.29.29.77 0 1.06l-5.67 5.67a.75.75 0 0 1-.53.22Z" />
                        </svg>
                    </div>
                    <p style="font-weight: var(--font-weight-manrope-semibold); opacity: 80%;">Laporan Selesai
                        Dikerjakan Mahasiswa</p>
                    <div class="jumlah-pelanggaran">
                        <p style="font-size: var(--font-size-15xl); font-weight: var(--font-weight-manrope-semibold);"><?=$row['Selesai']?>
                        </p>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
            <div class="container-laporan-pelanggaran">
                <div class="title">
                    <p style="font-size: 20px; font-weight: var(--font-weight-manrope-bold);">Riwayat Pelaporan</p>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th class="tgl-column">Tanggal</th>
                            <th>Nama Pelapor</th>
                            <th class="pelanggaran-column">Pelanggaran</th>
                            <th class="tingkat-column">Tingkat Pelanggaran</th>
                            <th>Status</th>
                            <th></th>
            
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Fungsi Tampil Riwayat Pelanggaran -->
                        <?php
                        $admin->tampilRiwayatLaporan();
                        ?>
                    </tbody>
                </table>
            </div>
    </div>