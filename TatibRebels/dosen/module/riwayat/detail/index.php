<?php
include 'config/koneksi.php';

$nip = $_SESSION['username'];
$id_riwayat = $_GET['id_riwayat'];
$row = $dosen -> tampilDetailPelaporan();

$bandingClass = getBandingClass($row['status']);

function getBandingClass($status)
{
    switch ($status) {
        case 'Baru':
            return 'ajuan-banding hidden';
        default:
            return 'ajuan-banding';
    }
}
?>
<link rel="stylesheet" href="assets/css/Style.css">

    <!-- INI DETAIL PELANGGARAN -->
    <div class="container-det-pelanggaran">
        <div class="header-det-pelanggaran">
            <p style="font-size: var(--font-size-xl); font-weight: var(--font-weight-manrope-bold);">Detail Pelanggaran</p>
            <div class="status-pelanggaran">
                <span class="dot" style="background-color: <?= getStatusColor($row['status']) ?>;"></span>
                <p style="font-size: var(--font-size-sm); font-weight: var(--font-weight-manrope-medium);"><?= $row['status'] ?></p>
            </div>
        </div>
        <div class="content-det-pelanggaran">
            <!-- Bagian gambar bukti pelanggaran -->
            <img class="bukti-pelanggaran" alt="" src="assets/bukti/<?= $row['bukti'] ?>" />

            <div class="info-pelanggaran">
                <div class="container-deskripsi-pelanggaran">
                    <div class="container-nama-tgl">
                        <div class="deskripsi-pelanggaran">
                            <p style="font-size: var(--font-size-sm); font-weight: var(--font-weight-manrope-medium); opacity: 60%;">Nama Pelanggar</p>
                            <p style="font-weight: var(--font-weight-manrope-medium);"><?= $row['nama_pelanggar'] ?></p>
                        </div>
                        <div class="deskripsi-pelanggaran">
                            <p style="font-size: var(--font-size-sm); font-weight: var(--font-weight-manrope-medium); opacity: 60%;">Waktu</p>
                            <p style="font-weight: var(--font-weight-manrope-medium);"><?= $row['waktu'] ?></p>
                        </div>
                    </div>
                    <div class="deskripsi-pelanggaran">
                        <p style="font-size: var(--font-size-sm); font-weight: var(--font-weight-manrope-medium); opacity: 60%;">Tingkat Pelanggaran</p>
                        <p style="font-weight: var(--font-weight-manrope-medium);"><?= $row['tingkat'] ?></p>
                    </div>
                    <div class="deskripsi-pelanggaran">
                        <p style="font-size: var(--font-size-sm); font-weight: var(--font-weight-manrope-medium); opacity: 60%;">Pelanggaran</p>
                        <p style="font-weight: var(--font-weight-manrope-medium);"><?= $row['pelanggaran'] ?></p>
                    </div>
                    <div class="deskripsi-pelanggaran">
                        <p style="font-size: var(--font-size-sm); font-weight: var(--font-weight-manrope-medium); opacity: 60%;">Sanksi</p>
                        <p style="font-weight: var(--font-weight-manrope-medium);"><?= $row['sanksi'] ?></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- INI AJUAN BANDING OLEH TERLAPOR -->
        <?php if (isset($row['alasan_banding']) && $row['alasan_banding'] !== NULL): ?>
            <div class="<?= $bandingClass ?>">
                <div class="title-row">
                    Ajuan Banding oleh Terlapor
                </div>
                <div class="isi-form-banding">
                    <div class="container-alasan">
                        <p style="font-weight: var(--font-weight-manrope-semibold);">Alasan Banding</p>
                        <p style="font-family: var( --font-manrope);"><?= $row['alasan_banding'] ?></p>
                    </div>
                    <div class="container-unggah-file">
                        <p style="font-weight: var(--font-weight-manrope-semibold);">Bukti</p>
                        <!-- Bagian gambar bukti pelanggaran -->
                        <img class="bukti-pelanggaran" alt="" src="assets/banding/<?= $row['bukti_banding'] ?>" />
                    </div>
                </div>
        <?php endif; ?>
        </div>
    </div>
<?php
function getStatusColor($status)
{
    switch ($status) {
        case 'Baru':
            return '#1D6FEA';
        case 'Verifikasi':
            return '#F9CB40';
        case 'Dikerjakan':
            return '#FC5B29';
        case 'Selesai':
            return '#07AB3F';
        default:
            return '#000000';
    }
}
?>