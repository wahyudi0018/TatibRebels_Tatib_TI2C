<?php
session_start();
if (!empty($_SESSION['username'])) {
    require '../config/koneksi.php';
    require '../fungsi/pesan_kilat.php';
    require '../fungsi/anti_injection.php';

    if (!empty($_GET['dosen'])) {
        $id_dosen = $_POST['id_dosen'];
        $password_lama = $_POST['password_lama'];
        $password_baru = $_POST['password_baru'];
        
        $query_check_password = "SELECT username, level, password, salt FROM user WHERE username = '$id_dosen'";
        $result_check_password = mysqli_query($koneksi, $query_check_password);
        $row_check_password = mysqli_fetch_assoc($result_check_password);

        $salt = $row_check_password['salt'];
        $hashed_password = $row_check_password['password'];
        $combined_password = $password_lama . $salt;
        $hashed_input_password = '$2y$10$' . $salt . md5($combined_password);
        
        if ($hashed_input_password === $hashed_password) {
            $salt_baru = substr(md5(rand()), 1, 32);
            $combined_password_baru = $password_baru . $salt_baru;
            $hashed_password_baru = '$2y$10$' . $salt_baru . md5($combined_password_baru);
            
            $query_update_password = "UPDATE user SET password = '$hashed_password_baru', salt = '$salt_baru' WHERE username = '$id_dosen'";
            $result_update_password = mysqli_query($koneksi, $query_update_password);
            if ($result_update_password) {
                pesan('success', "Berhasil Mengubah Password.");
            } else {
                pesan('danger', "Gagal Mengubah Password Karena Password.");
            }
        } else {
            pesan('danger', "Gagal Mengubah Password Karena Password Lama Tidak Sesuai.");
        }
        header("Location: ../index.php");
    } elseif (!empty($_GET['mahasiswa'])) {
        $id_mhs = $_POST['id_mhs'];
        $password_lama = $_POST['password_lama'];
        $password_baru = $_POST['password_baru'];
        
        $query_check_password = "SELECT username, level, password, salt FROM user WHERE username = '$id_mhs'";
        $result_check_password = mysqli_query($koneksi, $query_check_password);
        $row_check_password = mysqli_fetch_assoc($result_check_password);

        $salt = $row_check_password['salt'];
        $hashed_password = $row_check_password['password'];
        $combined_password = $password_lama . $salt;
        $hashed_input_password = '$2y$10$' . $salt . md5($combined_password);
        
        if ($hashed_input_password === $hashed_password) {
            $salt_baru = substr(md5(rand()), 1, 32);
            $combined_password_baru = $password_baru . $salt_baru;
            $hashed_password_baru = '$2y$10$' . $salt_baru . md5($combined_password_baru);
            
            $query_update_password = "UPDATE user SET password = '$hashed_password_baru', salt = '$salt_baru' WHERE username = '$id_mhs'";
            $result_update_password = mysqli_query($koneksi, $query_update_password);
            if ($result_update_password) {
                pesan('success', "Berhasil Mengubah Password.");
            } else {
                pesan('danger', "Gagal Mengubah Password Karena Password.");
            }
        } else {
            pesan('danger', "Gagal Mengubah Password Karena Password Lama Tidak Sesuai.");
        }
        header("Location: ../index.php");
    } elseif (!empty($_GET['admin'])) {
        $id_admin = $_POST['id_admin'];
        $password_lama = $_POST['password_lama'];
        $password_baru = $_POST['password_baru'];
        
        $query_check_password = "SELECT username, level, password, salt FROM user WHERE username = '$id_admin'";
        $result_check_password = mysqli_query($koneksi, $query_check_password);
        $row_check_password = mysqli_fetch_assoc($result_check_password);

        $salt = $row_check_password['salt'];
        $hashed_password = $row_check_password['password'];
        $combined_password = $password_lama . $salt;
        $hashed_input_password = '$2y$10$' . $salt . md5($combined_password);
        
        if ($hashed_input_password === $hashed_password) {
            $salt_baru = substr(md5(rand()), 1, 32);
            $combined_password_baru = $password_baru . $salt_baru;
            $hashed_password_baru = '$2y$10$' . $salt_baru . md5($combined_password_baru);
            
            $query_update_password = "UPDATE user SET password = '$hashed_password_baru', salt = '$salt_baru' WHERE username = '$id_admin'";
            $result_update_password = mysqli_query($koneksi, $query_update_password);
            if ($result_update_password) {
                pesan('success', "Berhasil Mengubah Password.");
            } else {
                pesan('danger', "Gagal Mengubah Password Karena Password.");
            }
        } else {
            pesan('danger', "Gagal Mengubah Password Karena Password Lama Tidak Sesuai.");
        }
        header("Location: ../index.php");
    }
} else {
    header("Location: ../index.php?page=login");
}
?>