<?php
include 'config/koneksi.php';

class Dosen extends Pelanggaran{
    private $nip;

    public function __construct(){
    }

    public function tampilNama() {
        global $koneksi;
        
        if (isset($_SESSION['username'])) {
            $this->nip = $_SESSION['username'];
          
            $query = mysqli_query($koneksi, "SELECT nama FROM dosen WHERE nip = '$this->nip'");
            $result = mysqli_fetch_assoc($query);

            echo isset($result['nama']) ? $result['nama'] : 'Nama Tidak Ditemukan';
        }
    }

    public function tampilNO() {
        global $koneksi;
        
        if (isset($_SESSION['username'])) {
            $this->nip = $_SESSION['username'];
          
            $query = mysqli_query($koneksi, "SELECT nip FROM dosen WHERE nip = '$this->nip'");
            $result = mysqli_fetch_assoc($query);

            echo isset($result['nip']) ? $result['nip'] : 'NIP Tidak Ditemukan';
        }
    }

    public function gantiPassword() {
        global $koneksi;
        
        $query_ganti_password = "SELECT u.username, d.nip, u.password, u.salt
                                FROM user u
                                INNER JOIN dosen d ON u.username = d.nip 
                                WHERE u.username = '$id_dosen'";
        $result_ganti_password = mysqli_query($koneksi, $query_ganti_password);
        $row = mysqli_fetch_assoc($result_ganti_password);
    }

    public function hitungSemuaLaporan() {
        global $koneksi;

        $query_hitung = "
        SELECT
            r.id_dosen,
            d.nip,
            SUM(CASE WHEN r.status = 'Baru' THEN 1 ELSE 0 END) AS Baru,
            SUM(CASE WHEN r.status = 'Dikerjakan' THEN 1 ELSE 0 END) AS Dikerjakan,
            SUM(CASE WHEN r.status = 'Verifikasi' THEN 1 ELSE 0 END) AS Verifikasi,
            SUM(CASE WHEN r.status = 'Selesai' THEN 1 ELSE 0 END) AS Selesai
        FROM
            riwayat_pelanggaran AS r INNER JOIN dosen AS d ON r.id_dosen = d.id
        WHERE
            d.nip = $this->nip";

        $result_hitung = mysqli_query($koneksi, $query_hitung);
        return $result_hitung;
    }

    public function tampilBiodata(){
        global $koneksi;

        $query_biodata = "SELECT * FROM dosen WHERE nip = $this->nip";
        $result_biodata = mysqli_query($koneksi, $query_biodata);
        return $result_biodata;
    }

    public function tampilRiwayatLaporan() {
        global $koneksi;

        $query_tampil = " SELECT rp.id AS id_riwayat, 
                        DATE_FORMAT(rp.tanggal, '%d/%m/%Y') AS tanggal,
                        m.nim AS id_pelanggar, 
                        m.nama AS nama_pelanggar, 
                        p.deskripsi AS pelanggaran, 
                        CONCAT('Tingkat ', tp.tingkat) AS tingkat, 
                        rp.status AS status
                        FROM riwayat_pelanggaran rp
                        INNER JOIN mhs m ON rp.id_mhs = m.id
                        INNER JOIN dosen d ON rp.id_dosen = d.id
                        INNER JOIN pelanggaran p ON rp.id_pelanggaran = p.id
                        INNER JOIN tingkat_pelanggaran tp ON p.id_tingkat = tp.id
                        WHERE d.nip = '$this->nip'
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
        
        while ($row = mysqli_fetch_assoc($result_tampil)) {
            $id_riwayat = $row['id_riwayat'];
            echo 
            '<tr>' .
                 '<td class="tgl-column">' . $row['tanggal'] . '</td>' .
                 '<td class="nim-terlapor-column">' . $row['id_pelanggar'] . '</td>' .
                 '<td class="nama-pelapor-column">' . $row['nama_pelanggar'] . '</td>' .
                 '<td class="pelanggaran-column">' . $row['pelanggaran'] . '</td>' .
                 '<td class="tingkat-column">' . $row['tingkat'] . '</td>' .
                 '<td class="container-status">' .
                    '<span class="dot" style="background-color: ' . getStatusColor($row['status']) . ';"></span>' .
                 $row['status'] .
                 '</td>' .
                 '<td>' .
                    '<div style="display: flex; flex-direction: row;">' .
                        '<a href="index.php?page=riwayat/detail&id_riwayat=' . $row['id_riwayat'] . '" class="btn-table-riwayat" style="background-color: #1D6FEA; display: flex; flex-direction: row; align-items: center;">Detail</a>' .
                 '  </div>' .
                 '</td>' .
            '</tr>'; 
        }
    }

    public function tampilDetailPelaporan() {
        global $koneksi;

        $nip = $_SESSION['username'];
        $id_riwayat = $_GET['id_riwayat'];
        $query_laporan = "SELECT rp.id AS id_riwayat, 
                        rp.status AS status,
                        rp.bukti_pelanggaran AS bukti,
                        rp.banding AS alasan_banding, 
                        rp.bukti_banding AS bukti_banding, 
                        m.nama AS nama_pelanggar, 
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
                        WHERE d.nip = '$nip' AND rp.id = '$id_riwayat'";
        
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