<?php
session_start();
if (!empty($_SESSION['username'])) {
    require '../config/koneksi.php';
    require '../fungsi/pesan_kilat.php';
    require '../fungsi/anti_injection.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_riwayat = antiinjection($koneksi, $_POST['id_riwayat']);
        $banding = antiinjection($koneksi, $_POST['alasan-banding']);
        $bukti_banding = $_FILES['file']['name'];
        $target_dir = "../assets/banding/";
        $target_file = $target_dir . $bukti_banding;
        move_uploaded_file($_FILES['file']['tmp_name'], $target_file);

        $query_update = "UPDATE riwayat_pelanggaran SET banding = '$banding', bukti_banding = '$bukti_banding', status='Verifikasi' 
                        WHERE id = '$id_riwayat'";

        if (mysqli_query($koneksi, $query_update)) {
            pesan('success', "Banding Ditambahkan.");
        } else {
            pesan('danger', "Gagal Menambahkan Banding Karena: " . mysqli_error($koneksi));
        }
        header("Location: ../index.php");
    }
} else {
    header("Location: ../index.php?page=login");
}
?>