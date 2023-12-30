<?php
session_start();
if (!empty($_SESSION['username'])) {
    require '../config/koneksi.php';
    require '../fungsi/pesan_kilat.php';
    require '../fungsi/anti_injection.php';

    if (!empty($_GET['dosen'])) {
        $id_dosen = antiinjection($koneksi, $_GET['id_dosen']);
        $query = "UPDATE dosen SET tanda = 'hapus'
        WHERE id = '$id_dosen'";
        
        if (mysqli_query($koneksi, $query)) {
            pesan('success', "Data Dosen Telah Dihapus.");
        } else {
            pesan('danger', "Gagal Menghapus Data Dosen Karena: " . mysqli_error($koneksi));
        }
        header("Location: ../index.php?page=admin_dosen");
    } elseif (!empty($_GET['mahasiswa'])) {
        $id_mhs = antiinjection($koneksi, $_GET['id_mhs']);
        
        $query = "UPDATE mhs SET tanda = 'hapus'
        WHERE id = '$id_mhs'";
        
        if (mysqli_query($koneksi, $query)) {
            pesan('success', "Data Mahasiswa Telah Dihapus.");
        } else {
            pesan('danger', "Gagal Menghapus Data Mahasiswa Karena: " . mysqli_error($koneksi));
        }
        header("Location: ../index.php?page=admin_mahasiswa");
    } elseif (!empty($_GET['pelanggaran'])) {
        $id_pelanggaran = antiinjection($koneksi, $_GET['id_pelanggaran']);
        
        $query = "UPDATE pelanggaran SET tanda = 'hapus'
        WHERE id = '$id_pelanggaran'";
        
        if (mysqli_query($koneksi, $query)) {
            pesan('success', "Data Pelanggaran Telah Dihapus.");
        } else {
            pesan('danger', "Gagal Menghapus Data Pelanggaran Karena: " . mysqli_error($koneksi));
        }
        header("Location: ../index.php?page=admin_tatib");
    }
} else {
    header("Location: ../index.php?page=login");
}
?>