<?php
if(session_status() === PHP_SESSION_NONE)
    session_start();

include 'config/koneksi.php';
include 'fungsi/pesan_kilat.php';
include 'fungsi/anti_injection.php';

$username = antiinjection($koneksi, $_POST['username']);
$password = antiinjection($koneksi, $_POST['password']);

$query = "SELECT username, level, salt, password FROM user WHERE username = '$username' AND tanda = 'simpan'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);
mysqli_close($koneksi);

$salt = $row['salt'];
$hashed_password = $row['password'];

if ($salt !== null && $hashed_password !== null) {
    $combined_password = $password . $salt;
    $hashed_input_password = '$2y$10$' . $salt . md5($combined_password);

    if ($hashed_input_password === $hashed_password) {
        $_SESSION['username'] = $row['username'];
        $_SESSION['level'] = $row['level'];
        
        header("Location: index.php");
    } else {
        pesan('password', "Login gagal. Password Anda Salah.");
        header("Location: login.php");
    }
} else {
    pesan('username', "Username tidak ditemukan.");
    header("Location: login.php");
}

?>