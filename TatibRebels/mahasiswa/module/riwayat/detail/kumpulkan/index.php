<?php
include 'config/koneksi.php';

$nim = $_SESSION['username'];
$id_riwayat = $_GET['id_riwayat'];
$query = "SELECT rp.id AS id_riwayat, rp.status AS status,rp.bukti_pelanggaran AS bukti, d.nama AS nama_pelapor, CONCAT(DATE_FORMAT(rp.tanggal, '%d/%m/%Y'), ' ', rp.jam) AS waktu, CONCAT('Tingkat ', tp.tingkat) AS tingkat, p.deskripsi AS pelanggaran, s.deskripsi AS sanksi
        FROM riwayat_pelanggaran rp
        INNER JOIN mhs m ON rp.id_mhs = m.id
        INNER JOIN dosen d ON rp.id_dosen = d.id
        INNER JOIN pelanggaran p ON rp.id_pelanggaran = p.id
        INNER JOIN tingkat_pelanggaran tp ON p.id_tingkat = tp.id
        INNER JOIN sanksi s ON p.id_sanksi = s.id
        WHERE m.nim = '$nim' AND rp.id = '$id_riwayat'";

$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);
?>
<link rel="stylesheet" href="assets/css/Style.css">

    <!-- INI PENGUMPULAN SANKSI-->
<form action="fungsi/form_kumpul.php" method="post" id="kumpulForm" enctype="multipart/form-data">
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
        <div class="container-unggah-file">
            <p style="font-weight: var(--font-weight-manrope-semibold);">Pengumpulan Sanksi <span style="color: red">*</span></p>
            <label for="input-file">
                <div class="div" style="display: flex;">
                    <input type="text" id="file-name" value="JPG, JPEG, PNG, atau PDF" style="font-size: 14px; opacity: 60%;"
                        disabled>
                    <div class="btn-unggah">
                        Pilih File
                    </div>
                </div>
                <input type="file" id="input-file" name="file" accept=".jpg, .jpeg, .png, .pdf">
            </label>
        </div>
        <input type="hidden" name="id_riwayat" value="<?= $id_riwayat ?>">
        <button class="btn-kirim" type="submit" form="kumpulForm">
            <div class="value-btn">Kirim</div>
        </button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inputFile = document.getElementById('input-file');
            const fileNameInput = document.getElementById('file-name');

            inputFile.addEventListener('change', function () {
                if (inputFile.files.length > 0) {
                    const fileName = inputFile.files[0].name;

                    fileNameInput.value = fileName;
                } else {
                    fileNameInput.value = '';
                }
            });
        });
    </script>
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