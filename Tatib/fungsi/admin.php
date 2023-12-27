<?php
include 'config/koneksi.php';

class Admin extends Pelanggaran{
    private $nid;

    public function __construct() {
        
    }

    public function tampilNama() {
        global $koneksi;
        
        if (isset($_SESSION['username'])) {
            $this->nid = $_SESSION['username'];
          
            $query_nama = mysqli_query($koneksi, "SELECT nama FROM admin WHERE nid = '$this->nid'");
            $result_nama = mysqli_fetch_assoc($query_nama);

            echo isset($result_nama['nama']) ? $result_nama['nama'] : 'Nama Tidak Ditemukan';
        }
    }

    public function tampilNO() {
        global $koneksi;
        
        if (isset($_SESSION['username'])) {
            $this->nid = $_SESSION['username'];
          
            $query_no = mysqli_query($koneksi, "SELECT nid FROM admin WHERE nid = '$this->nid'");
            $result_no = mysqli_fetch_assoc($query_no);

            echo isset($result_no['nid']) ? $result_no['nid'] : 'NID Tidak Ditemukan';
        }
    }

    public function gantiPassword() {
        global $koneksi;
        
        $query_ganti_password = "SELECT u.username, a.nid, u.password, u.salt
                                FROM user u
                                INNER JOIN admin a ON u.username = a.nid 
                                WHERE u.username = '$id_admin'";
        $result_ganti_password = mysqli_query($koneksi, $query_ganti_password);
        $row = mysqli_fetch_assoc($result_ganti_password);

    }

    public function hitungSemuaLaporan() {
        global $koneksi;

        $query_hitung = "
        SELECT
            SUM(CASE WHEN status = 'Baru' THEN 1 ELSE 0 END) AS Baru,
            SUM(CASE WHEN status = 'Dikerjakan' THEN 1 ELSE 0 END) AS Dikerjakan,
            SUM(CASE WHEN status = 'Verifikasi' THEN 1 ELSE 0 END) AS Verifikasi,
            SUM(CASE WHEN status = 'Selesai' THEN 1 ELSE 0 END) AS Selesai
        FROM
            riwayat_pelanggaran
        ";

        $result_hitung = mysqli_query($koneksi, $query_hitung);
        return $result_hitung;
    }

    public function tampilRiwayatLaporan() {
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
            echo '
            <tr>
                <td class="tgl-column">' . $row['tanggal'] . '</td>
                <td class="nama-pelapor-column">' . $row['nama_pelapor'] . '</td>
                <td class="pelanggaran-column">' . $row['pelanggaran'] . '</td>
                <td class="tingkat-column">' . $row['tingkat'] . '</td>
                <td class="container-status">
                    <span class="dot" style="background-color: ' . getStatusColor($row['status']) . ';"></span>
                    ' . $row['status'] . '
                </td>
                <td>
                    <div style="display: flex; flex-direction: row;">
                        <a href="index.php?page=detail&id_riwayat=' . $id_riwayat . '" class="btn-table-riwayat" style="background-color: #1D6FEA; display: flex; flex-direction: row; align-items: center;">Detail</a>
                    </div>
                </td>
            </tr>';        
        }
    }

    public function tampilDetailLaporan() {
        global $koneksi;

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
                        INNER JOIN dosen d ON rp.id_dosen = d.id
                        INNER JOIN pelanggaran p ON rp.id_pelanggaran = p.id
                        INNER JOIN tingkat_pelanggaran tp ON p.id_tingkat = tp.id
                        INNER JOIN sanksi s ON p.id_sanksi = s.id
                        WHERE rp.id = '$id_riwayat'";
        
        $result_laporan = mysqli_query($koneksi, $query_laporan);
        $row = mysqli_fetch_assoc($result_laporan);
        return $row;
    }

    public function tampilDataDosen() {
        global $koneksi;

        $query_dosen = "SELECT id AS id_dosen, 
                        nip AS nip, 
                        nama AS nama_dosen, 
                        DATE_FORMAT(tgl_lahir, '%d/%m/%Y') AS tanggal_lahir, 
                        jk AS jenis_kelamin, 
                        no_hp AS no_hp, 
                        email AS email
                        FROM dosen 
                        WHERE tanda = 'simpan'";
        
        $result_dosen = mysqli_query($koneksi, $query_dosen);

        while ($row = mysqli_fetch_assoc($result_dosen)) {
            echo '<tr>
                    <td class="nama-dosen-column">' . $row['nama_dosen'] . '</td>
                    <td class="nip-column">' . $row['nip'] . '</td>
                    <td class="tgl-lahir-column">' . $row['tanggal_lahir'] . '</td>
                    <td class="jenis-kelamin-column">' . $row['jenis_kelamin'] . '</td>
                    <td class="telp-column">' . $row['no_hp'] . '</td>
                    <td class="email-column">' . $row['email'] . '</td>
                    <td class="button-edit-hapus">
                        <div class="center-btn edit-button">
                            <a href="index.php?page=admin_dosen/edit&id_dosen=' . $row['id_dosen'] . '">Edit</a>
                        </div>
                        <div class="center-btn hapus-button">
                            <a href="fungsi/hapus.php?dosen=hapus&id_dosen=' . $row['id_dosen'] . '" onclick="javascript:return confirm(\'Hapus Data Dosen ?\');">Hapus</a>
                        </div>
                    </td>
                  </tr>';
        }
    }

    public function editDataDosen() {
        global $koneksi;
        
        $id_dosen = $_GET['id_dosen'];
        $query_edit_dosen = "SELECT id AS id_dosen, nip, nama, tgl_lahir, jk, no_hp, email
                            FROM dosen
                            WHERE id = '$id_dosen'";
                            
        $result_edit_dosen = mysqli_query($koneksi, $query_edit_dosen);
        $row = mysqli_fetch_assoc($result_edit_dosen);
        return $row;
    }

    public function tampilDataMahasiswa() {
        global $koneksi;

        $query_mhs = "SELECT id AS id_mhs, 
                    nim AS nim, 
                    nama AS nama_mhs, 
                    DATE_FORMAT(tgl_lahir, '%d/%m/%Y') AS tanggal_lahir, 
                    jk AS jenis_kelamin, 
                    no_hp AS no_hp, 
                    email AS email
                    FROM mhs WHERE tanda ='simpan'";
        
        $result_mhs = mysqli_query($koneksi, $query_mhs);

        while ($row = mysqli_fetch_assoc($result_mhs)) {
            echo '<tr>' .
                    '<td class="nama-mhs-column">' . $row['nama_mhs'] . '</td>' .
                    '<td class="nim-column">' . $row['nim'] . '</td>' .
                    '<td class="tgl-lahir-column">' . $row['tanggal_lahir'] . '</td>' .
                    '<td class="jenis-kelamin-column">' . $row['jenis_kelamin'] . '</td>' .
                    '<td class="telp-column">' . $row['no_hp'] . '</td>' .
                    '<td class="email-column">' . $row['email'] . '</td>' .
                    '<td class="button-edit-hapus">' .
                        '<div class="center-btn edit-button">' .
                            '<a href="index.php?page=admin_mahasiswa/edit&id_mhs=' . $row['id_mhs'] . '">Edit</a>'                        .
                        '</div>' .
                    '<div class="center-btn hapus-button">' .
                        '<a href="fungsi/hapus.php?mahasiswa=hapus&id_mhs=' . $row['id_mhs'] . '" onclick="javascript:return confirm(\'Hapus Data Mahasiswa ?\');">Hapus</a>' .
                    '</div>' .
                    '</td>' .
                '</tr>';
        }
    }

    public function editDataMahasiswa() {
        global $koneksi;
        
        $id_mhs = $_GET['id_mhs'];
        $query_edit_mhs = "SELECT id AS id_mhs, nim, nama, tgl_lahir, jk, no_hp, email
                            FROM mhs
                            WHERE id = '$id_mhs'";
                            
        $result_edit_mhs = mysqli_query($koneksi, $query_edit_mhs);
        $row = mysqli_fetch_assoc($result_edit_mhs);
        return $row;
    }

    //Akses fungsi tampiltingkatPelanggaran kelas Pelanggaran
    public function tampilTingkatPelanggaran() {
        parent::tampilTingkatPelanggaran();
    }

    //Overriding fungsi tampilDeskripsiPelanggaran kelas Pelanggaran
    public function tampilDeskripsiPelanggaran() {
        global $koneksi;

        $query_deskripsi_pelanggaran = "SELECT p.id AS id_pelanggaran, p.deskripsi, t.tingkat 
                                        FROM pelanggaran AS p LEFT JOIN 
                                        tingkat_pelanggaran AS t 
                                        ON p.id_tingkat = t.id WHERE tanda = 'simpan'";
        
        $result_deskripsi_pelanggaran = $koneksi -> query($query_deskripsi_pelanggaran);

        if ($result_deskripsi_pelanggaran->num_rows > 0) {
            $counter = 1;
            while ($row = $result_deskripsi_pelanggaran->fetch_assoc()) {
                $row["no_urut"] = $counter;
                $counter++;

                echo 
                '<div class="klasifikasi-item">' .
                    '<div class="kolom-no">' . $row["no_urut"] . '</div>' . 
                    '<div class="kolom-pelanggaran">' . $row["deskripsi"] . '</div>' . 
                    '<div class="kolom-tingkat">' . $row["tingkat"] . '</div>' .
                    '<div class="button-aksi">' .
                    '<div class="center-btn edit-button">' .
                        '<a href="index.php?page=admin_tatib/edit_pelanggaran&id_pelanggaran=' . $row['id_pelanggaran'] .'" style="text-decoration: none;"">Edit</a>' .
                    '</div>' . 
                    '<div class="center-btn hapus-button">' .
                        '<a href="fungsi/hapus.php?pelanggaran=hapus&id_pelanggaran=' . $row['id_pelanggaran'] . '" onclick="javascript:return confirm(\'Hapus Data Pelanggaran ?\');">Hapus</a>' .
                    '</div>' .
                    '</div>' .
                '</div>';
            }
        }
    }

    //Akses fungsi tampilAkumulasiPelanggaran kelas Pelanggaran
    public function tampilAkumulasiPelanggaran() {
        parent::tampilAkumulasiPelanggaran();
    }

    //Overriding fungsi tampilDeskripsiPelanggaran kelas Pelanggaran
    public function tampilSanksiPelanggaran() {
        global $koneksi;

        $query_sanksi_pelanggaran = "SELECT s.id AS id_sanksi, t.tingkat, s.deskripsi
                                    FROM tingkat_pelanggaran AS t
                                    INNER JOIN sanksi AS s ON t.id = s.id";

        $result_sanksi_pelanggaran = $koneksi -> query($query_sanksi_pelanggaran);

        if ($result_sanksi_pelanggaran -> num_rows > 0){
            while ($row = $result_sanksi_pelanggaran -> fetch_assoc()){              
                echo
                '<div class="sanksi-item">' .
                    '<div class="sanksi-tingkat">Sanksi atas pelanggaran Tingkat ' . $row['tingkat'] . '</div>' .
                    '<div style="display: flex;">' .
                        '<div class="detail-sanksi" style="width: 1168px;">' . $row["deskripsi"] . "</div>" .
                        '<div class="center-btn edit-button" style="height: 44px;">' .
                            '<a href="index.php?page=admin_tatib/edit_sanksi&id_sanksi=' . $row['id_sanksi'] .'" style="text-decoration: none;"">Edit</a>' .
                        '</div>' .
                    '</div>' .
                '</div>';
            }
        }
    }

    public function editDataPelanggaran() {
        global $koneksi;

        $id_pelanggaran = $_GET['id_pelanggaran'];
        $query_pelanggaran = "SELECT p.id AS id_pelanggaran, 
                            no_urut, 
                            t.id AS id_tingkat, 
                            s.id AS id_sanksi, 
                            p.deskripsi AS pelanggaran, 
                            t.deskripsi AS tingkat, 
                            s.deskripsi AS sanksi 
                            FROM pelanggaran p
                            INNER JOIN tingkat_pelanggaran t ON p.id_tingkat = t.id
                            INNER JOIN sanksi s ON p.id_sanksi = s.id WHERE p.id = '$id_pelanggaran'";
        
        $result_pelanggaran = mysqli_query($koneksi, $query_pelanggaran);
        $row = mysqli_fetch_assoc($result_pelanggaran);
        return $row;
    }

    public function editDataSanksi() {
        global $koneksi;
        
        $id_sanksi = $_GET['id_sanksi'];
        $query_sanksi = "SELECT t.id AS id_tingkat, 
                        s.id AS id_sanksi, 
                        t.tingkat AS tingkat, 
                        s.deskripsi AS sanksi 
                        FROM pelanggaran p
                        INNER JOIN tingkat_pelanggaran t ON p.id_tingkat = t.id
                        INNER JOIN sanksi s ON p.id_sanksi = s.id
                        WHERE p.id_sanksi = '$id_sanksi'";

        $result_sanksi = mysqli_query($koneksi, $query_sanksi);
        $row = mysqli_fetch_assoc($result_sanksi);
        return $row;
    }
}
?>