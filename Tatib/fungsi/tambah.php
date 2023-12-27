<?php
session_start();
if (!empty($_SESSION['username'])) {
    require '../config/koneksi.php';
    require '../fungsi/pesan_kilat.php';
    require '../fungsi/anti_injection.php';

    if (!empty($_GET['dosen'])) {
        $nama = antiinjection($koneksi, $_POST['nama']);
        $nip = antiinjection($koneksi, $_POST['nip']);
        $tanggal_lahir = antiinjection($koneksi, $_POST['tanggal_lahir']);
        $jenis_kelamin = antiinjection($koneksi, $_POST['jenis_kelamin']);
        $no_telp = antiinjection($koneksi, $_POST['no_telp']);
        $email = antiinjection($koneksi, $_POST['email']);
        
        $cek_duplikat_nip = "SELECT * FROM dosen WHERE nip = '$nip'";
        $result_cek_duplikat_nip = mysqli_query($koneksi, $cek_duplikat_nip);

        if (mysqli_num_rows($result_cek_duplikat_nip) > 0) {
            pesan('danger', "Gagal Menambahkan Dosen Karena NIP Sudah Digunakan.");
        } else {
            $cek_duplikat_no_hp_email = "SELECT * FROM dosen WHERE (no_hp = '$no_telp' OR email = '$email') AND tanda = 'simpan'";
            $result_cek_duplikat_no_hp_email = mysqli_query($koneksi, $cek_duplikat_no_hp_email);
            if (mysqli_num_rows($result_cek_duplikat_no_hp_email) > 0) {
                pesan('danger', "Gagal Menambahkan Dosen Karena Nomor Telepon atau Email Sudah Digunakan.");
            } else {
                $tambah_dosen = "INSERT INTO dosen (nama, nip, tgl_lahir, jk, no_hp, email) 
                VALUES ('$nama', '$nip', '$tanggal_lahir', '$jenis_kelamin', '$no_telp', '$email')";      
                if (mysqli_query($koneksi, $tambah_dosen)) {
                    pesan('success', "Dosen Baru Ditambahkan.");
                } else {
                    pesan('danger', "Gagal Menambahkan Dosen Karena: " . mysqli_error($koneksi));
                }
            }
        }
        header("Location: ../index.php?page=admin_dosen");

    } elseif (!empty($_GET['mahasiswa'])) {
        $nama = antiinjection($koneksi, $_POST['nama']);
        $nim = antiinjection($koneksi, $_POST['nim']);
        $tanggal_lahir = antiinjection($koneksi, $_POST['tanggal_lahir']);
        $jenis_kelamin = antiinjection($koneksi, $_POST['jenis_kelamin']);
        $no_telp = antiinjection($koneksi, $_POST['no_telp']);
        $email = antiinjection($koneksi, $_POST['email']);
        
        $cek_duplikat_nim = "SELECT * FROM mhs WHERE nim = '$nim'";
        $result_cek_duplikat_nim = mysqli_query($koneksi, $cek_duplikat_nim);

        if (mysqli_num_rows($result_cek_duplikat_nim) > 0) {
            pesan('danger', "Gagal Menambahkan Mahasiswa Karena NIM Sudah Digunakan.");
        } else {
            $cek_duplikat_no_hp_email = "SELECT * FROM mhs WHERE (no_hp = '$no_telp' OR email = '$email') AND tanda = 'simpan'";
            $result_cek_duplikat_no_hp_email = mysqli_query($koneksi, $cek_duplikat_no_hp_email);
            if (mysqli_num_rows($result_cek_duplikat_no_hp_email) > 0) {
                pesan('danger', "Gagal Menambahkan Mahasiswa Karena Nomor Telepon atau Email Sudah Digunakan.");
            } else {
                $tambah_mhs = "INSERT INTO mhs (nama, nim, tgl_lahir, jk, no_hp, email) 
                VALUES ('$nama', '$nim', '$tanggal_lahir', '$jenis_kelamin', '$no_telp', '$email')";      
                if (mysqli_query($koneksi, $tambah_mhs)) {
                    pesan('success', "Mahasiswa Baru Ditambahkan.");
                } else {
                    pesan('danger', "Gagal Menambahkan Mahasiswa Karena: " . mysqli_error($koneksi));
                }
            }
        }
        header("Location: ../index.php?page=admin_mahasiswa");
    } elseif (!empty($_GET['pelanggaran'])) {
        $sanksi_id = antiinjection($koneksi, $_POST['tingkat']);
        $no_urut = antiinjection($koneksi, $_POST['no_urut']);
        $pelanggaran = antiinjection($koneksi, $_POST['jenis_pelanggaran']);
        $tingkat = antiinjection($koneksi, $_POST['tingkat']);
        $sanksi = antiinjection($koneksi, $_POST['sanksi']);

        $query_sanksi = "SELECT deskripsi FROM sanksi WHERE id = '$sanksi_id'";
        $result_sanksi = mysqli_query($koneksi, $query_sanksi);
        $row_sanksi = mysqli_fetch_assoc($result_sanksi);
        $sanksi_deskripsi = $row_sanksi['deskripsi'];
        
        $cek_duplikat = "SELECT * FROM pelanggaran WHERE (no_urut = '$no_urut' OR deskripsi = '$pelanggaran') AND tanda = 'simpan'";
        $result_cek_duplikat = mysqli_query($koneksi, $cek_duplikat);

        if (mysqli_num_rows($result_cek_duplikat) > 0) {
            pesan('danger', "Gagal Menambahkan Pelanggaran Karena No. Urut atau Pelanggaran Sudah Digunakan.");
        } else {            
            $tambah_pelanggaran = "INSERT INTO pelanggaran (id_tingkat, id_sanksi, no_urut, deskripsi) 
                    VALUES ('$tingkat', '$sanksi_id', '$no_urut', '$pelanggaran')";      
                if (mysqli_query($koneksi, $tambah_pelanggaran)) {
                    pesan('success', "Pelanggaran Baru Ditambahkan.");
                } else {
                    pesan('danger', "Gagal Menambah Pelanggaran Karena: " . mysqli_error($koneksi));
                }
            }
        header("Location: ../index.php?page=admin_tatib");
        }
} else {
    header("Location: ../index.php?page=login");
}
?>