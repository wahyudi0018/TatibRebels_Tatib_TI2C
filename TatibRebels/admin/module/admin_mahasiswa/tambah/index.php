<link rel="stylesheet" href="assets/css/Style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- INI FORM Tambah Data Mahasiswa -->
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
            Tambah Data Mahasiswa
        </div>
        <div class="form-content">
            <form action="fungsi/tambah.php?mahasiswa=tambah" method="post" enctype="multipart/form-data" id="reportForm" style="display: flex; gap: 16px;">
                <div class="input-field-laporan">
                    <label for="nama">Nama <span style="color: red" for="nama">*</span></label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama" required>
                </div>
                <div class="input-field-laporan">
                    <label for="nim">NIM <span style="color: red" for="nim">*</span></label>
                    <input type="text" id="nim" name="nim" placeholder="Masukkan NIM" required>
                </div>
                <div class="input-field-laporan">
                    <label for="tanggal_lahir">Tanggal Lahir <span style="color: red" for="tanggal_lahir">*</span></label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>
                </div>
                <div class="input-field-laporan">
                    <label for="jenis_kelamin">Jenis Kelamin <span style="color: red" for="jenis_kelamin">*</span></label>
                    <div class="input-field-laporan-radio">
                        <div class="input-field-laporan-radio-option">
                            <input type="radio" name="jenis_kelamin" value="Laki-Laki" checked>
                            Laki-Laki
                        </div>
                        <div class="input-field-laporan-radio-option">
                            <input type="radio" name="jenis_kelamin" value="Perempuan">
                            Perempuan
                        </div>
                    </div>
                </div>
                <div class="input-field-laporan">
                    <label for="no_telp">Nomor Telepon <span style="color: red" for="no_telp">*</span></label>
                    <input type="tel" id="no_telp" name="no_telp" placeholder="Masukkan nomor telepon" required>
                </div>
                <div class="input-field-laporan" style="margin-bottom: 12px;">
                    <label for="email">Email <span style="color: red" for="email">*</span></label>
                    <input type="email" id="email" name="email" placeholder="Masukkan email" required>
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
    </script>