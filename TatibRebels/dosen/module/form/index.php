<?php
include 'config/koneksi.php';

$mhs = "SELECT id AS id_mhs, nim AS nim_mhs FROM mhs WHERE tanda='simpan'";
$mhsResult = mysqli_query($koneksi, $mhs);

$pelanggaran = "SELECT p.no_urut AS id_pelanggaran, p.deskripsi AS pelanggaran, s.deskripsi AS sanksi, p.tanda AS tanda FROM pelanggaran p INNER JOIN sanksi s ON p.id_sanksi = s.id WHERE tanda='simpan'";
$pelanggaranResult = mysqli_query($koneksi, $pelanggaran);
?>
<link rel="stylesheet" href="assets/css/Style.css">  
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
    <!-- INI FORM LAPORAN -->
    <div class="form-container">
        <div class="title-row">
            <div onclick="history.back()" style="display: flex;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" fill="none">
                    <path fill="#292D32"
                        d="M9.57 19.32c-.19 0-.38-.07-.53-.22l-6.07-6.07a.754.754 0 0 1 0-1.06L9.04 5.9c.29-.29.77-.29 1.06 0 .29.29.29.77 0 1.06L4.56 12.5l5.54 5.54c.29.29.29.77 0 1.06-.14.15-.34.22-.53.22Z" />
                    <path fill="#292D32"
                        d="M20.5 13.25H3.67c-.41 0-.75-.34-.75-.75s.34-.75.75-.75H20.5c.41 0 .75.34.75.75s-.34.75-.75.75Z" />
                </svg>
            </div>
            Buat Laporan
        </div>
        <div class="form-content">
            <form action="fungsi/form_tambah.php" method="post" id="reportForm" enctype="multipart/form-data">
                <div class="input-field-laporan">
                    <label for="tanggal">Tanggal <span style="color: red" for="tanggal">*</span></label>
                    <input class="date" type="date" id="tanggal" name="tanggal" style="font-weight: var(--font-weight-manrope-medium); font-size: var(--font-size-sm);" required>
                </div>
                <div class="input-field-laporan">
                    <label for="jam">Jam <span style="color: red" for="jam">*</span></label>
                    <input class="time" type="time" id="jam" name="jam" required>
                </div>
                <div class="input-field-laporan">
                    <label for="nim">Pelanggar <span style="color: red" for="nim">*</span></label>
                    <select id="nim" name="nim" class="select2" required>
                        <option value="">Pilih NIM Pelanggar</option>
                        <?php
                        while ($row = mysqli_fetch_assoc($mhsResult)) {
                        ?>
                        <option value="<?= $row['id_mhs'] ?>"><?= $row['nim_mhs'] ?></option>
                        <?php
                        }
                        ?>   
                    </select>
                </div>
                <div class="input-field-laporan">
                    <label for="pelanggaran">Pelanggaran <span style="color: red" for="pelanggaran">*</span></label>
                    <select id="pelanggaran" name="pelanggaran" class="select2" style="width: 100%;" required>
                        <option value="">Pilih Pelanggaran</option>
                        <?php
                        while ($row = mysqli_fetch_assoc($pelanggaranResult)) {
                        ?>
                        <option value="<?= $row['id_pelanggaran'] ?>" data-sanksi="<?= $row['sanksi'] ?>"><?= $row['pelanggaran'] ?></option>
                        <?php
                        }
                        ?>                  
                    </select>
                </div>
                <div class="input-field-laporan">
                    <label for="sanksi">Sanksi <span style="color: red" for="sanksi">*</span></label>
                    <input class="sanksi" type="text" id="sanksi" name="sanksi" placeholder="Sanksi" readonly></input>
                </div>
                <div class="container-unggah-file">
                    <label for="input-file">
                        Bukti Foto <span style="color: red" for="input-file">*</span>
                        <div class="div" style="display: flex;">
                            <input type="text" id="file-name" value="JPG, JPEG, atau PNG" style="font-size: 14px; opacity: 60%;"
                                disabled>
                            <div class="btn-unggah">
                                Pilih File
                            </div>
                        </div>
                        <input type="file" id="input-file" name="file" accept=".jpg, .jpeg, .png">
                    </label>
                </div>
            </form>
        </div>
        <button class="btn-kirim" type="submit" form="reportForm">
            <div class="value-btn">Kirim</div>
        </button>
    </div>

    <script>
        $(document).ready(function () {
            $('#nim').select2();
            $('#pelanggaran').select2();
        });
        document.addEventListener("DOMContentLoaded", function () {
        var pelanggaranSelect = document.getElementById("pelanggaran");
        var sanksiInput = document.getElementById("sanksi");

        pelanggaranSelect.addEventListener("change", function () {
            if (pelanggaranSelect.value !== "") {
                var selectedOption = pelanggaranSelect.options[pelanggaranSelect.selectedIndex];
                var sanksiValue = selectedOption.getAttribute("data-sanksi");

                sanksiInput.value = sanksiValue;

                sanksiInput.removeAttribute("disabled");
            } else {
                sanksiInput.value = "";
                sanksiInput.setAttribute("disabled", "disabled");
            }
        });
        });
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