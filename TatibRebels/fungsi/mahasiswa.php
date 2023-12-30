<?php
include 'config/koneksi.php';

class Mahasiswa extends Pelanggaran{
    private $nim;

    public function __construct(){
    }

    public function tampilNama() {
        global $koneksi;
        
        if (isset($_SESSION['username'])) {
            $this->nim = $_SESSION['username'];
          
            $query = mysqli_query($koneksi, "SELECT nama FROM mhs WHERE nim = '$this->nim'");
            $result = mysqli_fetch_assoc($query);

            echo isset($result['nama']) ? $result['nama'] : 'Nama Tidak Ditemukan';
        }
    }

    public function tampilNO() {
        global $koneksi;
        
        if (isset($_SESSION['username'])) {
            $this->nim = $_SESSION['username'];
          
            $query = mysqli_query($koneksi, "SELECT nim FROM mhs WHERE nim = '$this->nim'");
            $result = mysqli_fetch_assoc($query);

            echo isset($result['nim']) ? $result['nim'] : 'NIM Tidak Ditemukan';
        }
    }

    public function gantiPassword() {
        global $koneksi;
        
        $query_ganti_password = "SELECT u.username, m.nim, u.password, u.salt
                                FROM user u
                                INNER JOIN mhs m ON u.username = m.nim 
                                WHERE u.username = '$id_mhs'";
        $result_ganti_password = mysqli_query($koneksi, $query_ganti_password);
        $row = mysqli_fetch_assoc($result_ganti_password);
    }

    public function tampilBiodata(){
        global $koneksi;

        $query_biodata = "SELECT * FROM mhs WHERE nim = $this->nim";
        $result_biodata = mysqli_query($koneksi, $query_biodata);
        return $result_biodata;
    }

    public function hitungSemuaPelanggaran(){
        global $koneksi;

        $this->nim = $_SESSION['username'];
        $query_hitung = "
        SELECT
            r.id_mhs,
            p.id_tingkat,
            m.nim,
            SUM(CASE WHEN p.id_tingkat = 1 THEN 1 ELSE 0 END) AS Tingkat5,
            SUM(CASE WHEN p.id_tingkat = 2 THEN 1 ELSE 0 END) AS Tingkat4,
            SUM(CASE WHEN p.id_tingkat = 3 THEN 1 ELSE 0 END) AS Tingkat3,
            SUM(CASE WHEN p.id_tingkat = 4 THEN 1 ELSE 0 END) AS Tingkat2,
            SUM(CASE WHEN p.id_tingkat = 5 THEN 1 ELSE 0 END) AS Tingkat1
        FROM
            riwayat_pelanggaran AS r INNER JOIN pelanggaran AS p ON r.id_pelanggaran = p.id
            INNER JOIN mhs AS m ON r.id_mhs = m.id
        WHERE
            m.nim = $this->nim";

        $result_hitung = mysqli_query($koneksi, $query_hitung);
        return $result_hitung;
    }

    public function tampilRiwayatPelanggaran() {
        global $koneksi;

        $query_tampil = "SELECT rp.id AS id_riwayat, 
                        DATE_FORMAT(rp.tanggal, '%d/%m/%Y') AS tanggal, 
                        d.nama AS nama_pelapor, 
                        p.deskripsi AS pelanggaran, 
                        CONCAT('Tingkat ', tp.tingkat) AS tingkat, 
                        rp.status AS status
                        FROM riwayat_pelanggaran rp
                        INNER JOIN mhs m ON rp.id_mhs = m.id
                        INNER JOIN dosen d ON rp.id_dosen = d.id
                        INNER JOIN pelanggaran p ON rp.id_pelanggaran = p.id
                        INNER JOIN tingkat_pelanggaran tp ON p.id_tingkat = tp.id
                        WHERE m.nim = $this->nim
                        ORDER BY rp.status ASC";

        $result_tampil = mysqli_query($koneksi, $query_tampil);

        function getStatusColor($status) {
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

        function getbuttonColor($status) {
            switch ($status) {
                case 'Baru':
                    return '#1D6FEA';
                case 'Verifikasi':
                    return '#1D6FEA';
                case 'Dikerjakan':
                    return '#FEBB3A';
                case 'Selesai':
                    return '#1D6FEA';
                default:
                    return '#000000';
            }
        }

        function getButtonText($status) {
            switch ($status) {
                case 'Dikerjakan':
                    return 'Kumpulkan';
                default:
                    return 'Detail';
            }
        }

        function getButtonLink($status, $id_riwayat) {
            switch ($status) {
                case 'Dikerjakan':
                    return 'index.php?page=riwayat/detail/kumpulkan&id_riwayat=' . $id_riwayat;
                default:
                    return 'index.php?page=riwayat/detail&id_riwayat=' . $id_riwayat;
            }
        }
        
        while ($row = mysqli_fetch_assoc($result_tampil)) {
            echo 
            '<tr>'.
                '<td class="tgl-column">' . $row['tanggal'] . '</td>' .
                '<td class="nama-pelapor-column">' . $row['nama_pelapor'] . '</td>' .
                '<td class="pelanggaran-column">' . $row['pelanggaran'] . '</td>' .
                '<td class="tingkat-column">' . $row['tingkat'] . '</td>' .
                '<td class="container-status">' .
                '<span class="dot" style="background-color: ' . getStatusColor($row['status']) . ';"></span>' .
                $row['status'] .
                '</td>' .
                '<td>' .
                '<div style="display: flex; flex-direction: row;">' .
                '<a href="' . getButtonLink($row['status'], $row['id_riwayat']) . '" class="btn-table-riwayat" style="background-color: ' . getButtonColor($row['status']) . '; display: flex; flex-direction: row; align-items: center;">' . getButtonText($row['status']) . '</a>' .
                '</div>' .
                '</td>' .
            '</tr>';
        }
    }

    public function tampilDetailPelanggaran() {
        global $koneksi;

        $nim = $_SESSION['username'];
        $id_riwayat = $_GET['id_riwayat'];
        $query_laporan = "SELECT rp.id AS id_riwayat, 
                        rp.status AS status,
                        rp.bukti_pelanggaran AS bukti,
                        rp.banding AS alasan_banding, 
                        rp.bukti_banding AS bukti_banding, 
                        rp.kumpul_sanksi AS kumpul_sanksi, 
                        d.nama AS nama_pelapor, 
                        CONCAT(DATE_FORMAT(rp.tanggal, '%d/%m/%Y'), ' ', rp.jam) AS waktu, 
                        CONCAT('Tingkat ', tp.tingkat) AS tingkat, 
                        p.deskripsi AS pelanggaran, 
                        s.deskripsi AS sanksi
                        FROM riwayat_pelanggaran rp
                        INNER JOIN mhs m ON rp.id_mhs = m.id
                        INNER JOIN dosen d ON rp.id_dosen = d.id
                        INNER JOIN pelanggaran p ON rp.id_pelanggaran = p.id
                        INNER JOIN tingkat_pelanggaran tp ON p.id_tingkat = tp.id
                        INNER JOIN sanksi s ON p.id_sanksi = s.id
                        WHERE m.nim = '$nim' AND rp.id = '$id_riwayat'";
        
        $result_laporan = mysqli_query($koneksi, $query_laporan);
        $row = mysqli_fetch_assoc($result_laporan);
        return $row;
    }

    //Akses fungsi tampiltingkatPelanggaran kelas Pelanggaran
    public function tampilTingkatPelanggaran() {
        parent::tampilTingkatPelanggaran();
    }

    //Akses fungsi tampilDeskripsiPelanggaran kelas Pelanggaran
    public function tampilDeskripsiPelanggaran() {
        parent::tampilDeskripsiPelanggaran();
    }

    //Akses fungsi tampilAkumulasiPelanggaran kelas Pelanggaran
    public function tampilAkumulasiPelanggaran() {
        parent::tampilAkumulasiPelanggaran();
    }

    //Akses fungsi tampilSanksiPelanggaran kelas Pelanggaran
    public function tampilSanksiPelanggaran() {
        parent::tampilSanksiPelanggaran();
    }
}
?>