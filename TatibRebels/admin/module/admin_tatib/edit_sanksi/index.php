<link rel="stylesheet" href="assets/css/Style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- INI FORM Edit Data Sanksi-->
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
            Edit Sanksi Pelanggaran
        </div>
        <div class="form-content">
            <form action="fungsi/edit.php?sanksi=edit" method="post" enctype="multipart/form-data" id="sanksiForm" style="display: flex; gap: 16px;">
            <!-- Fungsi Edit Data Sanksi -->
            <?php
            $id_sanksi = $_GET['id_sanksi'];
            $row = $admin -> editDataSanksi();
            ?>
                <div class="input-field-laporan">
                    <label for="nama">Sanksi Pelanggaran</label>
                    <input type="text" id="nama" name="nama" value="Pelanggaran Tingkat <?= $row['tingkat'] ?>" required disabled>
                </div>
                <div class="input-field-laporan">
                    <label for="sanksi_pelanggaran">Sanksi Pelanggaran</label>
                    <textarea name="sanksi_pelanggaran" id="sanksi_pelanggaran" cols="20" rows="5"
                        class="text-area"><?= $row['sanksi'] ?></textarea>
                </div>
                <input type="hidden" name="id_sanksi" value="<?= $id_sanksi ?>">
                <button class="btn-kirim" type="submit">
                    <div class="value-btn">Ubah</div>
                </button>
            </form>
        </div>
    </div>