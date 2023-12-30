<?php
include 'config/koneksi.php';

$nim = $_SESSION['username'];
$id_riwayat = $_GET['id_riwayat'];
$row = $mahasiswa -> tampilDetailPelanggaran();

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

$buttonClass = getButtonClass($row['status']);
function getButtonClass($status)
{
    switch ($status) {
        case 'Baru':
            return 'button-container';
        case 'Dikerjakan':
            return 'button-container';
        default:
            return 'button-container hidden';
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

    <!-- INI DETAIL PELANGGARAN -->
    <?php
            if (isset($_SESSION['_flashdata'])) {
                foreach ($_SESSION['_flashdata'] as $key => $val) {
                    echo get_flashdata($key);
                }
            }
        ?>
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
                            <p style="font-size: var(--font-size-sm); font-weight: var(--font-weight-manrope-medium); opacity: 60%;">Nama Pelapor</p>
                            <p style="font-weight: var(--font-weight-manrope-medium);"><?= $row['nama_pelapor'] ?></p>
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
                <div class="<?= $buttonClass ?>">
                    <?php
                    $bandingStyle = getBandingStyle($row['status']);
                    function getBandingStyle($status)
                    {
                        switch ($status) {
                            case 'Baru':
                                return 'color: red; border: 1px solid red; background-color: white; text-decoration: none;';
                            case 'Dikerjakan':
                                return 'background-color: #D9D9D9; color: #9D9D9D; text-decoration: none;';
                            default:
                                return '';
                        }
                    }
                    $bandingLink = getBandingLink($row['status'], $row['id_riwayat']);
                    function getBandingLink($status, $id_riwayat)
                    {
                        switch ($status) {
                            case 'Baru':
                                return 'index.php?page=riwayat/detail/banding&id_riwayat=' . $id_riwayat;
                            default:
                                return '';
                        }
                    }
                    $kerjakanLink = getKerjakanLink($row['status'], $row['id_riwayat']);
                    function getKerjakanLink($status, $id_riwayat)
                    {
                        switch ($status) {
                            case 'Baru':
                                return 'index.php?page=riwayat/detail/kumpulkan&id_riwayat=' . $id_riwayat;
                            case 'Dikerjakan':
                                    return 'index.php?page=riwayat/detail/kumpulkan&id_riwayat=' . $id_riwayat;
                            default:
                                return '';
                        }
                    }
                    ?>                    
                    <a href="<?= $bandingLink ?>" class="button" style="<?= $bandingStyle ?>">
                        <div class="value-btn">Ajukan Banding</div>
                    </a>
                    
                    <a href="<?= $kerjakanLink ?>" class="button" style="text-decoration: none;">
                        <div class="value-btn">Kerjakan</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class=verif-banding>
        <!-- INI AJUAN BANDING OLEH TERLAPOR -->
        <?php if (isset($row['alasan_banding']) && $row['alasan_banding'] !== NULL): ?>
        <div class="<?= $bandingClass ?>">
            <div class="title-row">
                Ajuan Banding
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
        </div>
        <?php endif; ?>
    </div>
    <!-- INI PENGERJAAN SANKSI OLEH TERLAPOR -->
    <div class="verif-banding">
    <?php if (isset($row['kumpul_sanksi']) && $row['kumpul_sanksi'] !== NULL): ?>
        <div class="<?= $sanksiClass ?>">
            <div class="title-row">
                Pengerjaan Sanksi
            </div>
            <div class="isi-form-sanksi">
                <!-- Bagian gambar bukti pelanggaran atau preview PDF -->
                <?php
                $fileExtension = pathinfo($row['kumpul_sanksi'], PATHINFO_EXTENSION);

                if (in_array($fileExtension, ['jpg', 'jpeg', 'png'])) {
                    // File gambar (JPG, JPEG, atau PNG)
                    echo '<img class="bukti-pelanggaran" alt="" src="assets/sanksi/' . $row['kumpul_sanksi'] . '" />';
                } else {
                    // File PDF
                    echo '<embed src="assets/sanksi/' . $row['kumpul_sanksi'] . '" type="application/pdf" width="595" height="842" />';
                }
                ?>
            </div>
        </div>
    <?php endif; ?>
    </div>