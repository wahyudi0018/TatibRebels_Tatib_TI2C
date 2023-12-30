<?php
include 'fungsi/pesan_kilat.php';
?>

<link rel="stylesheet" href="assets/css/Style.css">

    <!-- INI HOMEPAGE -->
    <div class="homepage-dosen">
        <div class="full-content-homepage-dosen">
        <?php
            if (isset($_SESSION['_flashdata'])) {
                foreach ($_SESSION['_flashdata'] as $key => $val) {
                    echo get_flashdata($key);
                }
            }
        ?>
        </div>
            <div class="container-pelaporan">
                <!-- Fungsi Hitung Semua Laporan -->
                <?php
                $result_hitung = $dosen->hitungSemuaLaporan();
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
                    <p style="font-weight: var(--font-weight-manrope-semibold); opacity: 80%;">Laporan yang Anda Ajukan</p>
                    <div class="jumlah-pelanggaran">
                        <p style="font-size: var(--font-size-15xl); font-weight: var(--font-weight-manrope-semibold);"><?=$row['Baru']?></p>
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
                    <p style="font-weight: var(--font-weight-manrope-semibold); opacity: 80%;">Laporan Diverifikasi oleh Admin</p>
                    <div class="jumlah-pelanggaran">
                        <p style="font-size: var(--font-size-15xl); font-weight: var(--font-weight-manrope-semibold);"><?=$row['Verifikasi']?></p>
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
                    <p style="font-weight: var(--font-weight-manrope-semibold); opacity: 80%;">Laporan Dikerjakan Mahasiswa</p>
                    <div class="jumlah-pelanggaran">
                        <p style="font-size: var(--font-size-15xl); font-weight: var(--font-weight-manrope-semibold);"><?=$row['Dikerjakan']?></p>
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
                    <p style="font-weight: var(--font-weight-manrope-semibold); opacity: 80%;">Laporan Selesai Dikerjakan Mahasiswa</p>
                    <div class="jumlah-pelanggaran">
                        <p style="font-size: var(--font-size-15xl); font-weight: var(--font-weight-manrope-semibold);"><?=$row['Selesai']?></p>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
            <div class="container-biodata-laporan">
                <!-- Fungsi tampil Biodata -->
                <?php
                $result_biodata = $dosen->tampilBiodata();
                while ($row = mysqli_fetch_assoc($result_biodata)) {
                ?>
                <div class="biodata-dosen">
                    <p style="font-size: var(--font-size-xl); font-weight: var(--font-weight-manrope-bold); color: var(--dark-blue);">
                        Biodata Dosen</p>
                    <div class="content-homepage-dosen">
                        <div class="foto-dosen">
                            <img src="assets/img/dosen.png" alt="">
                        </div>
                        <div class="data-dosen">
                            <div class="detail-biodata">
                                <p style="font-weight: var(--font-weight-manrope-semibold); opacity: 60%;">Nama</p>
                                <p style="font-weight: var(--font-weight-manrope-semibold);"><?=$row['nama']?></p>
                            </div>
                            <div class="detail-biodata">
                                <p style="font-weight: var(--font-weight-manrope-semibold); opacity: 60%;">NIP</p>
                                <p style="font-weight: var(--font-weight-manrope-semibold);"><?=$row['nip']?></p>
                            </div>
                            <div class="detail-biodata">
                                <p style="font-weight: var(--font-weight-manrope-semibold); opacity: 60%;">Tanggal Lahir</p>
                                <p style="font-weight: var(--font-weight-manrope-semibold);"><?=$row['tgl_lahir']?></p>
                            </div>
                            <div class="detail-biodata">
                                <p style="font-weight: var(--font-weight-manrope-semibold); opacity: 60%;">Jenis Kelamin</p>
                                <p style="font-weight: var(--font-weight-manrope-semibold);"><?=$row['jk']?></p>
                            </div>
                            <div class="detail-biodata">
                                <p style="font-weight: var(--font-weight-manrope-semibold); opacity: 60%;">Nomor Telepon</p>
                                <p style="font-weight: var(--font-weight-manrope-semibold);"><?=$row['no_hp']?></p>
                            </div>
                            <div class="detail-biodata">
                                <p style="font-weight: var(--font-weight-manrope-semibold); opacity: 60%;">Email</p>
                                <p style="font-weight: var(--font-weight-manrope-semibold);"><?=$row['email']?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="ajukan-laporan">
                    <div class="header-ajukan-laporan">
                        <p style="font-size: var(--font-size-xl); font-weight: var(--font-weight-manrope-bold); color: var(--dark-blue);">Ingin Ajukan Laporan?</p>
                        <p style="font-size: var(--font-size-sm); font-weight: var(--font-weight-manrope-medium);">Pastikan laporan Anda dilengkapi
                            dengan bukti foto yang relevan</p>
                    </div>
                    <div class="empty-state">
                        <svg xmlns="http://www.w3.org/2000/svg" width="144" height="87" fill="none">
                            <path fill="#EAEAEA" fill-rule="evenodd"
                                d="M137.506 12.8c3.31 0 5.994 2.674 5.994 5.973s-2.684 5.973-5.994 5.973h-34.252c3.311 0 5.995 2.674 5.995 5.973s-2.684 5.973-5.995 5.973h18.839c3.31 0 5.994 2.674 5.994 5.973 0 3.3-2.684 5.973-5.994 5.973h-8.712c-4.174 0-7.558 2.675-7.558 5.974 0 2.199 1.713 4.19 5.138 5.973 3.31 0 5.994 2.674 5.994 5.973s-2.684 5.973-5.994 5.973H39.889c-3.31 0-5.994-2.674-5.994-5.973s2.684-5.973 5.994-5.973H6.494C3.184 60.585.5 57.91.5 54.612c0-3.3 2.684-5.974 5.994-5.974h34.252c3.31 0 5.993-2.674 5.993-5.973s-2.683-5.973-5.993-5.973H19.337c-3.31 0-5.994-2.674-5.994-5.973s2.684-5.973 5.994-5.973H53.59c-3.31 0-5.994-2.674-5.994-5.973 0-3.3 2.683-5.973 5.994-5.973h83.916Zm0 23.892c3.31 0 5.994 2.674 5.994 5.973 0 3.3-2.684 5.973-5.994 5.973-3.31 0-5.994-2.674-5.994-5.973s2.684-5.973 5.994-5.973Z"
                                clip-rule="evenodd" />
                            <path fill="#fff" fill-rule="evenodd"
                                d="m91.818 11.946 7.986 57.91.717 5.81a3.413 3.413 0 0 1-2.98 3.803L47.42 85.585a3.425 3.425 0 0 1-3.817-2.974L35.86 19.935a1.706 1.706 0 0 1 1.49-1.901l.018-.003 4.158-.463m3.367-.358 3.927-.438-3.927.439Z"
                                clip-rule="evenodd" />
                            <path fill="#2E3659"
                                d="M93.056 11.776a1.251 1.251 0 0 0-1.41-1.068 1.249 1.249 0 0 0-1.067 1.408l2.477-.34Zm6.748 58.08 1.24-.153-.002-.017-1.239.17Zm.717 5.81 1.241-.153-1.241.152Zm-2.98 3.803.153 1.24-.152-1.24ZM47.42 85.585l.153 1.241-.153-1.24Zm-3.817-2.974 1.241-.152-1.24.152ZM35.86 19.935l-1.24.152 1.24-.152Zm1.49-1.901.153 1.24-.153-1.24Zm.018-.003.14 1.243-.14-1.243Zm4.298.78a1.251 1.251 0 0 0-.279-2.484l.279 2.483Zm3.087-2.843a1.249 1.249 0 0 0-1.102 1.381c.077.686.695 1.18 1.382 1.104l-.28-2.485Zm4.207 2.047a1.249 1.249 0 0 0 1.103-1.381 1.251 1.251 0 0 0-1.382-1.104l.279 2.485Zm41.62-5.9 7.986 57.91 2.477-.34-7.986-57.909-2.477.34Zm7.984 57.893.718 5.81 2.481-.305-.718-5.81-2.481.305Zm.718 5.81a2.164 2.164 0 0 1-1.892 2.41l.305 2.481a4.662 4.662 0 0 0 4.068-5.196l-2.481.304Zm-1.892 2.41-50.122 6.117.304 2.481 50.123-6.117-.305-2.481Zm-50.122 6.117a2.174 2.174 0 0 1-2.424-1.886l-2.481.304a4.676 4.676 0 0 0 5.21 4.063l-.305-2.481Zm-2.424-1.886L37.1 19.783l-2.481.304 7.743 62.676 2.481-.304ZM37.1 19.783a.458.458 0 0 1 .402-.509l-.305-2.481a2.955 2.955 0 0 0-2.578 3.294l2.481-.304Zm.402-.509h.004l-.279-2.485-.03.004.305 2.481Zm.004 0 4.159-.464-.28-2.484-4.158.463.28 2.485Zm7.526-.821 3.927-.438-.28-2.485-3.927.438.28 2.485Z" />
                            <path fill="#EAEAEA" fill-rule="evenodd"
                                d="m89.674 15.59 7.21 52.464.648 5.263c.209 1.696-.985 3.237-2.666 3.443L49.96 82.254c-1.681.206-3.214-1.002-3.422-2.698l-6.943-56.348a1.998 1.998 0 0 1 1.74-2.228l5.27-.645"
                                clip-rule="evenodd" />
                            <path fill="#fff" stroke="#2E3659" stroke-width="2.5"
                                d="M52.846 4a2.75 2.75 0 0 1 2.75-2.75h38.201a2.75 2.75 0 0 1 1.94.801l11.171 11.125a2.75 2.75 0 0 1 .809 1.949v52.553a2.75 2.75 0 0 1-2.75 2.75h-49.37a2.75 2.75 0 0 1-2.75-2.75V4Z" />
                            <path stroke="#2E3659" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M94.41 2.05v9.896c0 1.414 1.15 2.56 2.57 2.56h6.793M61.296 58.025H83.56M61.296 14.506H83.56 61.296Zm0 10.24h36.82-36.82Zm0 11.093h36.82-36.82Zm0 11.093h36.82-36.82Z" />
                        </svg>

                    </div>
                    <a href="index.php?page=form" class="btn-buat-laporan" style="text-decoration: none;">  
                        <div class="value-btn">Buat Laporan</div>
                    </a>
                </div>
            </div>
        </div>