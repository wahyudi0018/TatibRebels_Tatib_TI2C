<?php
include 'config/koneksi.php';

$nim = $_SESSION['username'];
$id_riwayat = $_GET['id_riwayat'];
$query = "SELECT rp.id AS id_riwayat, rp.status AS status
        FROM riwayat_pelanggaran rp
        INNER JOIN mhs m ON rp.id_mhs = m.id
        WHERE m.nim = '$nim' AND rp.id = '$id_riwayat'";
?>
<link rel="stylesheet" href="assets/css/Style.css">    
    <!-- INI AJUKAN BANDING -->
<form action="fungsi/form_banding.php" method="post" id="bandingForm" enctype="multipart/form-data">
    <div class="form-banding">
        <div class="title-row">
            <div onclick="history.back()" style="display: flex;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" fill="none">
                    <path fill="#292D32"
                        d="M9.57 19.32c-.19 0-.38-.07-.53-.22l-6.07-6.07a.754.754 0 0 1 0-1.06L9.04 5.9c.29-.29.77-.29 1.06 0 .29.29.29.77 0 1.06L4.56 12.5l5.54 5.54c.29.29.29.77 0 1.06-.14.15-.34.22-.53.22Z" />
                    <path fill="#292D32"
                        d="M20.5 13.25H3.67c-.41 0-.75-.34-.75-.75s.34-.75.75-.75H20.5c.41 0 .75.34.75.75s-.34.75-.75.75Z" />
                </svg>
            </div>
            Ajukan Banding
        </div>
        <div class="isi-form-banding">
            <div class="container-alasan">
                <p style="font-weight: var(--font-weight-manrope-semibold);">Berikan alasan Anda</p>
                <textarea name="alasan-banding" id="alasan-banding" name="alasan-banding" cols="20" rows="5" class="text-area"
                    placeholder="Saya menolak laporan ini karena..."></textarea>
            </div>
            <div class="container-unggah-file">
                <p style="font-weight: var(--font-weight-manrope-semibold);">Unggah bukti</p>
                <label for="input-file">
                    <div class="div" style="display: flex;">
                        <input type="text" id="file-name" value="JPG, JPEG, atau PNG" style="font-size: 14px; opacity: 60%;"disabled>
                        <div class="btn-unggah">
                            Pilih File
                        </div>
                    </div>
                    <input type="file" id="input-file" name="file" accept=".jpg, .jpeg, .png">
                </label>
            </div>
        </div>
        <input type="hidden" name="id_riwayat" value="<?= $id_riwayat ?>">
        <button class="btn-kirim" type="submit" form="bandingForm">
            <div class="value-btn">Kirim</div>
        </button>
    </div>
</form>
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