<?php
include 'config/koneksi.php';
include 'fungsi/pesan_kilat.php';

$nim = $_SESSION['username'];
$query = "SELECT rp.status AS status
        FROM riwayat_pelanggaran rp
        INNER JOIN mhs m ON rp.id_mhs = m.id
        WHERE m.nim = '$nim'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);

function getPesanBaru($status)
{
    switch ($status) {
        case 'Baru':
            return 'banner-pesan';
        default:
            return 'banner-pesan hidden';
    }
}
?>
<link rel="stylesheet" href="assets/css/Style.css">

    <!-- INI HOMEPAGE -->
    <div class="homepage-mhs">
        <div class="<?= getPesanBaru($row['status']) ?>">
            <p style="font-size: var(--font-size-xl); font-weight: var(--font-weight-manrope-medium);">Anda telah dilaporkan melakukan pelanggaran</p>
            <p>Silahkan lihat detail pelanggaran pada menu riwayat pelanggaran</p>
        </div>
        <?php
            if (isset($_SESSION['_flashdata'])) {
                foreach ($_SESSION['_flashdata'] as $key => $val) {
                    echo get_flashdata($key);
                }
            }
        ?>
        <div class="full-content-homepage-mhs">
                <div class="biodata-mhs">
                    <p style="font-size: var(--font-size-xl); font-weight: var(--font-weight-manrope-bold); color: var(--dark-blue);">Biodata Mahasiswa</p>
                    <div class="content-homepage-mhs">
                        <div class="foto-mhs">
                            <img src="assets/img/mahasiswa.png" alt="">
                        </div>
                        <div class="data-mhs">
                        <!-- Fungsi tampil Biodata -->
                        <?php
                        $result_biodata = $mahasiswa->tampilBiodata();
                        while ($row = mysqli_fetch_assoc($result_biodata)) {
                        ?>
                            <div class="detail-biodata">
                                <p style="font-weight: var(--font-weight-manrope-semibold); opacity: 60%;">Nama</p>
                                <p style="font-weight: var(--font-weight-manrope-semibold);"><?=$row['nama']?></p>
                            </div>
                            <div class="detail-biodata">
                                <p style="font-weight: var(--font-weight-manrope-semibold); opacity: 60%;">NIM</p>
                                <p style="font-weight: var(--font-weight-manrope-semibold);"><?=$row['nim']?></p>
                            </div>
                            <div class="detail-biodata">
                                <p style="font-weight: var(--font-weight-manrope-semibold); opacity: 60%;">Tanggal Lahir</p>
                                <p style="font-weight: var(--font-weight-manrope-semibold);"><?=$row['tgl_lahir']?></p>
                            </div>
                            <div class="detail-biodata">
                                <p style="font-weight: var(--font-weight-manrope-semibold); opacity: 60%;">Jenis Kelamin</p>
                                <p style="font-weight: var(--font-weight-manrope-semibold);"><?=$row['jk']?></p>
                            </div>
                            <div class="detail-biodata">
                                <p style="font-weight: var(--font-weight-manrope-semibold); opacity: 60%;">Nomor Telepon</p>
                                <p style="font-weight: var(--font-weight-manrope-semibold);"><?=$row['no_hp']?></p>
                            </div>
                            <div class="detail-biodata">
                                <p style="font-weight: var(--font-weight-manrope-semibold); opacity: 60%;">Email</p>
                                <p style="font-weight: var(--font-weight-manrope-semibold);"><?=$row['email']?></p>
                            </div>
                        <?php
                        }
                        ?>
                        </div>
                    </div>
                </div>
            <div class="container-pelanggaran">
            <?php
                $result_hitung = $mahasiswa->hitungSemuaPelanggaran();
                while ($row = mysqli_fetch_assoc($result_hitung)) {
                $nim = $_SESSION['username'];
            ?>
                <div class="kategori-pelanggaran">
                    <p style="font-weight: var(--font-weight-manrope-semibold); opacity: 80%;">Pelanggaran Tingkat I</p>
                    <div class="jumlah-pelanggaran">
                        <p style="font-size: var(--font-size-9xl); font-weight: var(--font-weight-manrope-semibold);"><?=$row['Tingkat1']?></p>
                        <p style="font-weight: var(--font-weight-manrope-semibold); opacity: 80%;">Pelanggaran</p>
                    </div>
                </div>
                <div class="kategori-pelanggaran"> 
                    <p style="font-weight: var(--font-weight-manrope-semibold); opacity: 80%;">Pelanggaran Tingkat II</p>
                    <div class="jumlah-pelanggaran">
                        <p style="font-size: var(--font-size-9xl); font-weight: var(--font-weight-manrope-semibold);"><?=$row['Tingkat2']?></p>
                        <p style="font-weight: var(--font-weight-manrope-semibold); opacity: 80%;">Pelanggaran</p>
                    </div>
                </div>
                <div class="kategori-pelanggaran">
                    <p style="font-weight: var(--font-weight-manrope-semibold); opacity: 80%;">Pelanggaran Tingkat III</p>
                    <div class="jumlah-pelanggaran">
                        <p style="font-size: var(--font-size-9xl); font-weight: var(--font-weight-manrope-semibold);"><?=$row['Tingkat3']?></p>
                        <p style="font-weight: var(--font-weight-manrope-semibold); opacity: 80%;">Pelanggaran</p>
                    </div>
                </div>
                <div class="kategori-pelanggaran">
                    <p style="font-weight: var(--font-weight-manrope-semibold); opacity: 80%;">Pelanggaran Tingkat IV</p>
                    <div class="jumlah-pelanggaran">
                        <p style="font-size: var(--font-size-9xl); font-weight: var(--font-weight-manrope-semibold);"><?=$row['Tingkat4']?></p>
                        <p style="font-weight: var(--font-weight-manrope-semibold); opacity: 80%;">Pelanggaran</p>
                    </div>
                </div>
                <div class="kategori-pelanggaran">
                    <p style="font-weight: var(--font-weight-manrope-semibold); opacity: 80%;">Pelanggaran Tingkat V</p>
                    <div class="jumlah-pelanggaran">
                        <p style="font-size: var(--font-size-9xl); font-weight: var(--font-weight-manrope-semibold);"><?=$row['Tingkat5']?></p>
                        <p style="font-weight: var(--font-weight-manrope-semibold); opacity: 80%;">Pelanggaran</p>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>   
    </div>