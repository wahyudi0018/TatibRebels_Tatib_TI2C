<?php
session_start();
if (!empty($_SESSION['username'])) {
    require '../config/koneksi.php';
    require '../fungsi/pesan_kilat.php';
    require '../fungsi/anti_injection.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $tanggal = antiinjection($koneksi, $_POST['tanggal']);
        $jam = antiinjection($koneksi, $_POST['jam']);
        $id_mhs = antiinjection($koneksi, $_POST['nim']);
        
        $username_dosen = $_SESSION['username'];
        $query_dosen = "SELECT d.id AS id_dosen FROM user u
                        JOIN dosen d ON u.username = d.nip
                        WHERE u.username = '$username_dosen'";
        $result_dosen = mysqli_query($koneksi, $query_dosen);
        $row_dosen = mysqli_fetch_assoc($result_dosen);
        $id_dosen = $row_dosen['id_dosen'];
        $id_pelanggaran = antiinjection($koneksi, $_POST['pelanggaran']);
        $bukti_pelanggaran = $_FILES['file']['name'];
        $target_dir = "../assets/bukti/";
        $target_file = $target_dir . $bukti_pelanggaran;
        move_uploaded_file($_FILES['file']['tmp_name'], $target_file);
        
        $query = "INSERT INTO riwayat_pelanggaran (id_mhs, id_dosen, id_pelanggaran, tanggal, jam, bukti_pelanggaran) 
                  VALUES ('$id_mhs', '$id_dosen', '$id_pelanggaran', '$tanggal', '$jam', '$bukti_pelanggaran')";
        
        if (mysqli_query($koneksi, $query)) {
            pesan('success', "Pelaporan Baru Ditambahkan.");
        } else {
            pesan('danger', "Gagal Menambahkan Pelaporan Karena: " . mysqli_error($koneksi));
        }
        header("Location: ../index.php");
    }
} else {
    header("Location: ../index.php?page=login");
}
?>
