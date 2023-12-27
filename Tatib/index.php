<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function path($module) {
    $headerPath = "$module/template/header.php";
    include $headerPath;
    if (!empty($_GET['page'])) {
        include "$module/module/" . $_GET['page'] . "/index.php";
    } else {
        include "$module/template/home.php";
    }
    $footerPath = "$module/template/footer.php";
    include $footerPath;
}

function redirectToLogin() {
    header("Location: login.php");
    exit();
}

if (!empty($_SESSION['level'])) {
    require 'config/koneksi.php';

    $level = $_SESSION['level'];

    switch ($level) {
        case 'admin':
            path('admin');
            break;
        case 'dosen':
            path('dosen');
            break;
        case 'mahasiswa':
            path('mahasiswa');
            break;
        default:
            redirectToLogin();
            break;
    }
} else {
    redirectToLogin();
}
?>
