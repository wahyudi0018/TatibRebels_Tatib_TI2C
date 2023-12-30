<?php
session_start();
if (!empty($_SESSION['username'])) {
    require '../config/koneksi.php';
    require '../fungsi/pesan_kilat.php';
    require '../fungsi/anti_injection.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_riwayat = antiinjection($koneksi, $_POST['id_riwayat']);
        $kumpul_sanksi = $_FILES['file']['name'];
        $target_dir = "../assets/sanksi/";
        $target_file = $target_dir . $kumpul_sanksi;
        move_uploaded_file($_FILES['file']['tmp_name'], $target_file);

        $query_update = "UPDATE riwayat_pelanggaran SET kumpul_sanksi = '$kumpul_sanksi', status='Selesai' 
                        WHERE id = '$id_riwayat'";

        if (mysqli_query($koneksi, $query_update)) {
            pesan('success', "Pengerjaan Sanksi Ditambahkan.");
        } else {
            pesan('danger', "Gagal Menambahkan Pengerjaan Sanksi Karena: " . mysqli_error($koneksi));
        }
        header("Location: ../index.php");
    }
} else {
    header("Location: ../index.php?page=login");
}
?>