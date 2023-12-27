<?php
include 'fungsi/pesan_kilat.php';
?>
<link rel="stylesheet" href="assets/css/Style.css">

    <!-- INI DATA DOSEN-->
    <div class="container-riwayat-pelanggaran">
        <div class="title">
            <p style="font-size: 20px; font-weight: var(--font-weight-manrope-bold);">Data Dosen</p>
        </div>
        <div class="container-tambah-search">
            <a href="index.php?page=admin_dosen/tambah" class="btn-tambah-data" style="text-decoration: none;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none">
                    <path fill="#fff"
                        d="M13.5 9.562h-9A.567.567 0 0 1 3.938 9c0-.307.254-.562.562-.562h9c.307 0 .562.255.562.562a.567.567 0 0 1-.562.562Z" />
                    <path fill="#fff"
                        d="M9 14.062a.567.567 0 0 1-.562-.562v-9c0-.308.255-.562.562-.562.307 0 .562.254.562.562v9a.567.567 0 0 1-.562.562Z" />
                </svg>
                <p style="font-weight: var(--font-weight-manrope-medium);">Tambah Dosen</p>
            </a>
        </div>
        <?php
            if (isset($_SESSION['_flashdata'])) {
                foreach ($_SESSION['_flashdata'] as $key => $val) {
                    echo get_flashdata($key);
                }
            }
        ?>
        <table>
            <thead>
                <tr>
                    <th class="nama-dosen-column">Nama</th>
                    <th class="nip-column">NIP</th>
                    <th class="tgl-lahir-column">Tgl Lahir</th>
                    <th class="jenis-kelamin-column">Jenis Kelamin</th>
                    <th class="telp-column">Nomor Telepon</th>
                    <th class="email-column">Email</th>
                    <th class="button-edit-hapus">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Fungsi Tampil Data Dosen -->
                <?php
                    $admin->tampilDataDosen();
                ?>
            </tbody>
        </table>
    </div>