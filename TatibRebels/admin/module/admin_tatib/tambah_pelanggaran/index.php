<?php
$query_tingkat_pelanggaran = "SELECT t.id AS id_tingkat, 
                            s.id AS id_sanksi, 
                            t.deskripsi AS tingkat, 
                            s.deskripsi AS sanksi 
                            FROM pelanggaran p
                            INNER JOIN tingkat_pelanggaran t ON p.id_tingkat = t.id
                            INNER JOIN sanksi s ON p.id_sanksi = s.id";

$result_tingkat_pelanggaran = mysqli_query($koneksi, $query_tingkat_pelanggaran);
$sanksi_deskripsi = "";
?>

<link rel="stylesheet" href="assets/css/Style.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- INI FORM Tambah Data Pelanggaran -->
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
        Tambah Kualifikasi Pelanggaran
    </div>
    <div class="form-content">
        <form action="fungsi/tambah.php?pelanggaran=tambah" method="post" enctype="multipart/form-data" id="pelanggaranForm"
            style="display: flex; gap: 16px;">
            <div class="input-field-laporan">
                <label for="no_urut">Nomor Urut</label>
                <input class="no-urut" type="text" id="no_urut" name="no_urut" placeholder="Masukkan Nomor Urut">
            </div>
            <div class="input-field-laporan">
                <label for="jenis_pelanggaran">Jenis Pelanggaran</label>
                <textarea name="jenis_pelanggaran" id="jenis" cols="20" rows="5"
                    class="text-area" placeholder="Masukkan Jenis Pelanggaran"></textarea>
            </div>
            <div class="input-field-laporan">
                <label for="tingkat">Tingkat Pelanggaran</label>
                <select id="tingkatSelect" name="tingkat" class="select2" style="width: 100%;" required>
                    <option value="">Pilih Tingkat Pelanggaran</option>
                    <?php
                    $uniqueTingkat = array();
                    while ($row = mysqli_fetch_assoc($result_tingkat_pelanggaran)) {
                        if (!in_array($row['tingkat'], $uniqueTingkat)) {
                    ?>
                    <option value="<?= $row['id_tingkat'] ?>" data-sanksi="<?= $row['sanksi'] ?>"><?= $row['tingkat'] ?></option>
                    <?php
                    $uniqueTingkat[] = $row['tingkat'];
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="input-field-laporan">
                <label for="sanksi">Sanksi</label>
                <input type="text" id="sanksi" name="sanksi" value="<?= $sanksi_deskripsi ?>" readonly>
            </div>
            <button class="btn-kirim" type="submit">
                <div class="value-btn">Kirim</div>
            </button>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#tingkatSelect').select2();
    });
    document.addEventListener("DOMContentLoaded", function () {
        var tingkatSelect = document.getElementById("tingkatSelect");
        var sanksiInput = document.getElementById("sanksi");

        tingkatSelect.addEventListener("change", function () {
            if (tingkatSelect.value !== "") {
                var selectedOption = tingkatSelect.options[tingkatSelect.selectedIndex];
                var sanksiValue = selectedOption.getAttribute("data-sanksi");

                sanksiInput.value = sanksiValue;

                sanksiInput.removeAttribute("disabled");
            } else {
                sanksiInput.value = "";
                sanksiInput.setAttribute("disabled", "disabled");
            }
        });
    });
</script>