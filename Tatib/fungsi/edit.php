<?php
session_start();
if (!empty($_SESSION['username'])) {
    require '../config/koneksi.php';
    require '../fungsi/pesan_kilat.php';
    require '../fungsi/anti_injection.php';

    if (!empty($_GET['dosen'])) {
        $id_dosen = antiinjection($koneksi, $_POST['id_dosen']);
        $nama = antiinjection($koneksi, $_POST['nama']);
        $nip = antiinjection($koneksi, $_POST['nip']);
        $tanggal_lahir = antiinjection($koneksi, $_POST['tanggal_lahir']);
        $jenis_kelamin = antiinjection($koneksi, $_POST['jenis_kelamin']);
        $no_telp = antiinjection($koneksi, $_POST['no_telp']);
        $email = antiinjection($koneksi, $_POST['email']);
        
        $cek_duplikat_nip = "SELECT * FROM dosen WHERE nip = '$nip' AND id != '$id_dosen'";
        $result_cek_duplikat_nip = mysqli_query($koneksi, $cek_duplikat_nip);

        if (mysqli_num_rows($result_cek_duplikat_nip) > 0) {
            pesan('danger', "Gagal Mengubah Dosen Karena NIP Sudah Digunakan.");
        } else {
            $cek_duplikat_no_hp_email = "SELECT * FROM dosen WHERE (no_hp = '$no_telp' OR email = '$email') AND tanda = 'simpan' AND id != '$id_dosen'";
            $result_cek_duplikat_no_hp_email = mysqli_query($koneksi, $cek_duplikat_no_hp_email);
            if (mysqli_num_rows($result_cek_duplikat_no_hp_email) > 0) {
                pesan('danger', "Gagal Mengubah Dosen Karena Nomor Telepon atau Email Sudah Digunakan.");
            } else {
                $edit_dosen = "UPDATE dosen SET nama = '$nama', nip = '$nip', tgl_lahir = '$tanggal_lahir', jk = '$jenis_kelamin', no_hp = '$no_telp', email = '$email'
                WHERE id = '$id_dosen'";     
                if (mysqli_query($koneksi, $edit_dosen)) {
                    pesan('success', "Data Dosen Telah Diubah.");
                } else {
                    pesan('danger', "Gagal Mengubah Data Dosen Karena: " . mysqli_error($koneksi));
                }
            }
        }
        header("Location: ../index.php?page=admin_dosen");

    } elseif (!empty($_GET['mahasiswa'])) {
        $id_mhs = antiinjection($koneksi, $_POST['id_mhs']);
        $nama = antiinjection($koneksi, $_POST['nama']);
        $nim = antiinjection($koneksi, $_POST['nim']);
        $tanggal_lahir = antiinjection($koneksi, $_POST['tanggal_lahir']);
        $jenis_kelamin = antiinjection($koneksi, $_POST['jenis_kelamin']);
        $no_telp = antiinjection($koneksi, $_POST['no_telp']);
        $email = antiinjection($koneksi, $_POST['email']);
        
        $cek_duplikat_nim = "SELECT * FROM mhs WHERE nim = '$nim' AND id != '$id_mhs'";
        $result_cek_duplikat_nim = mysqli_query($koneksi, $cek_duplikat_nim);

        if (mysqli_num_rows($result_cek_duplikat_nim) > 0) {
            pesan('danger', "Gagal Mengubah Mahasiswa Karena NIM Sudah Digunakan.");
        } else {
            $cek_duplikat_no_hp_email = "SELECT * FROM mhs WHERE (no_hp = '$no_telp' OR email = '$email') AND tanda = 'simpan' AND id != '$id_mhs'";
            $result_cek_duplikat_no_hp_email = mysqli_query($koneksi, $cek_duplikat_no_hp_email);
            if (mysqli_num_rows($result_cek_duplikat_no_hp_email) > 0) {
                pesan('danger', "Gagal Mengubah Mahasiswa Karena Nomor Telepon atau Email Sudah Digunakan.");
            } else {
                $edit_mhs = "UPDATE mhs SET nama = '$nama', nim = '$nim', tgl_lahir = '$tanggal_lahir', jk = '$jenis_kelamin', no_hp = '$no_telp', email = '$email'
                WHERE id = '$id_mhs'";    
                if (mysqli_query($koneksi, $edit_mhs)) {
                    pesan('success', "Data Mahasiswa Telah Diubah.");
                } else {
                    pesan('danger', "Gagal Mengubah Data Mahasiswa Karena: " . mysqli_error($koneksi));
                }
            }
        }
        header("Location: ../index.php?page=admin_mahasiswa");     
    } elseif (!empty($_GET['pelanggaran'])) {
        $id_pelanggaran = antiinjection($koneksi, $_POST['id_pelanggaran']);
        $sanksi_id = antiinjection($koneksi, $_POST['tingkat']);
        $no_urut = antiinjection($koneksi, $_POST['no_urut']);
        $pelanggaran = antiinjection($koneksi, $_POST['jenis_pelanggaran']);
        $tingkat = antiinjection($koneksi, $_POST['tingkat']);
        $sanksi = antiinjection($koneksi, $_POST['sanksi']);

        $query_sanksi = "SELECT deskripsi FROM sanksi WHERE id = '$sanksi_id'";
        $result_sanksi = mysqli_query($koneksi, $query_sanksi);
        $row_sanksi = mysqli_fetch_assoc($result_sanksi);
        $sanksi_deskripsi = $row_sanksi['deskripsi'];
        
        $cek_duplikat = "SELECT * FROM pelanggaran WHERE tanda = 'simpan' AND (no_urut = '$no_urut' OR deskripsi = '$pelanggaran') AND id != '$id_pelanggaran'";
        $result_cek_duplikat = mysqli_query($koneksi, $cek_duplikat);

        if (mysqli_num_rows($result_cek_duplikat) > 0) {
            pesan('danger', "Gagal Mengedit Pelanggaran Karena No. Urut atau Pelanggaran Sudah Digunakan.");
        } else {            
            $edit_pelanggaran = "UPDATE pelanggaran SET id_tingkat = '$tingkat' , id_sanksi = '$sanksi_id', no_urut = '$no_urut', deskripsi = '$pelanggaran'
            WHERE id = '$id_pelanggaran'";      
                if (mysqli_query($koneksi, $edit_pelanggaran)) {
                    pesan('success', "Data Pelanggaran Telah Diubah.");
                } else {
                    pesan('danger', "Gagal Mengubah Pelanggaran Karena: " . mysqli_error($koneksi));
                }
            }
        header("Location: ../index.php?page=admin_tatib");
    } elseif (!empty($_GET['sanksi'])) {
        $id_sanksi = antiinjection($koneksi, $_POST['id_sanksi']);
        $sanksi = antiinjection($koneksi, $_POST['sanksi_pelanggaran']);
        
        $cek_duplikat_sanksi = "SELECT * FROM sanksi WHERE deskripsi = '$sanksi'";
        $result_cek_duplikat_sanksi = mysqli_query($koneksi, $cek_duplikat_sanksi);

        if (mysqli_num_rows($result_cek_duplikat_sanksi) > 0) {
            pesan('danger', "Gagal Mengedit Sanksi Karena Sudah Digunakan.");
        } else {            
            $edit_pelanggaran = "UPDATE sanksi SET deskripsi = '$sanksi'
            WHERE id = '$id_sanksi'";      
                if (mysqli_query($koneksi, $edit_pelanggaran)) {
                    pesan('success', "Data Sanksi Telah Diubah.");
                } else {
                    pesan('danger', "Gagal Mengubah Sanksi Karena: " . mysqli_error($koneksi));
                }
            }
        header("Location: ../index.php?page=admin_tatib");
    }

} else {
    header("Location: ../index.php?page=login");
}
?>