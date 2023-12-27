<?php
include 'config/koneksi.php';

$id_riwayat = $_GET['id_riwayat'];
$row = $admin -> tampilDetailLaporan();

$statusColor = getStatusColor($row['status']);
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

$buttonClass = getButtonClass($row['status']);
function getButtonClass($status)
{
    switch ($status) {
        case 'Dikerjakan':
            return 'button-container hidden';
        case 'Selesai':
            return 'button-container hidden';
        default:
            return 'button-container';
    }
}

$sanksiClass = getSanksiClass($row['status']);
function getSanksiClass($status)
{
    switch ($status) {
        case 'Selesai':
            return 'kumpul-sanksi';
        default:
            return 'kumpul-sanksi hidden';
    }
}

?>
<link rel="stylesheet" href="assets/css/Style.css">
    
    <!-- INI DETAIL PELAPORAN & AJUAN BANDING-->
    <div class="verif-banding">
            <div class="container-laporan-pelanggaran">
                <div class="header-det-pelanggaran">
                    <p style="font-size: var(--font-size-xl); font-weight: var(--font-weight-manrope-bold);">Detail Pelaporan
                    </p>
                    <div class="status-pelanggaran">
                        <span class="dot" style="background-color: <?= $statusColor ?>;"></span>
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
                                    <p
                                        style="font-size: var(--font-size-sm); font-weight: var(--font-weight-manrope-medium); opacity: 60%;">
                                        Nama Pelapor</p>
                                    <p style="font-weight: var(--font-weight-manrope-medium);"><?= $row['nama_pelapor'] ?></p>
                                </div>
                                <div class="deskripsi-pelanggaran">
                                    <p
                                        style="font-size: var(--font-size-sm); font-weight: var(--font-weight-manrope-medium); opacity: 60%;">
                                        Waktu</p>
                                    <p style="font-weight: var(--font-weight-manrope-medium);"><?= $row['waktu'] ?></p>
                                </div>
                            </div>
                            <div class="deskripsi-pelanggaran">
                                <p
                                    style="font-size: var(--font-size-sm); font-weight: var(--font-weight-manrope-medium); opacity: 60%;">
                                    Tingkat Pelanggaran</p>
                                <p style="font-weight: var(--font-weight-manrope-medium);"><?= $row['tingkat'] ?></p>
                            </div>
                            <div class="deskripsi-pelanggaran">
                                <p
                                    style="font-size: var(--font-size-sm); font-weight: var(--font-weight-manrope-medium); opacity: 60%;">
                                    Pelanggaran</p>
                                <p style="font-weight: var(--font-weight-manrope-medium);"><?= $row['pelanggaran'] ?></p>
                            </div>
                            <div class="deskripsi-pelanggaran">
                                <p
                                    style="font-size: var(--font-size-sm); font-weight: var(--font-weight-manrope-medium); opacity: 60%;">
                                    Sanksi</p>
                                <p style="font-weight: var(--font-weight-manrope-medium);"><?= $row['sanksi'] ?></p>
                            </div>
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
                <div class="<?= $buttonClass ?>">
                <form action="fungsi/tolak_banding.php" method="post">
                <input type="hidden" name="id_riwayat" value="<?= $id_riwayat ?>">
                    <button class="button" type="submit" style="color: red; border: 1px solid red; background-color: white; width: 349px">
                        <div class="value-btn">Tolak Banding</div>
                    </button>
                </form>
                <form action="fungsi/setujui_banding.php" method="post">
                <input type="hidden" name="id_riwayat" value="<?= $id_riwayat ?>">
                    <button class="button" type="submit" style="width: 349px;">
                        <div class="value-btn">Setujui Banding</div>
                    </button>
                </form>
                </div>
            <?php endif; ?>
            </div>

            <!-- INI PENGERJAAN SANKSI OLEH TERLAPOR -->
            <div class="container-laporan-pelanggaran">
            <?php if (isset($row['kumpul_sanksi']) && $row['kumpul_sanksi'] !== NULL): ?>
                <div class="<?= $sanksiClass ?>">
                    <div class="title-row">
                        Pengerjaan Sanksi oleh Terlapor
                    </div>
                    <div class="isi-form-sanksi">
                        <!-- Bagian gambar bukti pelanggaran atau preview PDF -->
                    <?php
                    $fileExtension = pathinfo($row['kumpul_sanksi'], PATHINFO_EXTENSION);
                    
                    if (in_array($fileExtension, ['jpg', 'jpeg', 'png'])) {
                        // File  gambar (JPG, JPEG, atau PNG)
                        echo '<img class="bukti-pelanggaran" alt="" src="assets/sanksi/' . $row['kumpul_sanksi'] . '" />';
                    } else {
                        // File PDF
                        echo '<embed src="assets/sanksi/' . $row['kumpul_sanksi'] . '" type="application/pdf" width="595" height="842" />';
                    } 
                    ?>
                    </div>
                <form action="fungsi/ulangi_sanksi.php" method="post">
                    <div class="button-container">
                    <input type="hidden" name="id_riwayat" value="<?= $id_riwayat ?>">
                        <button class="button" type="submit" style="color: red; border: 1px solid red; background-color: white;">
                        <div class="value-btn">Ulangi Pengerjaan Sanksi</div>
                        </button>
                    </div>
                </form>
            <?php endif; ?>
            </div>
        </div>
    <script>
        // Menggunakan JavaScript untuk menetapkan atribut disabled
        document.getElementById('alasan-banding').disabled = true;
    </script>