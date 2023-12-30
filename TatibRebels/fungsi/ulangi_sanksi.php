<?php
session_start();
if (!empty($_SESSION['username'])) {
    require '../config/koneksi.php';
    require '../fungsi/anti_injection.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_riwayat = antiinjection($koneksi, $_POST['id_riwayat']);

        $query_update = "UPDATE riwayat_pelanggaran SET status='Dikerjakan' 
                        WHERE id = '$id_riwayat'";

        mysqli_query($koneksi, $query_update);
        header("Location: ../index.php");
    }
} else {
    header("Location: ../index.php?page=login");
}
?>