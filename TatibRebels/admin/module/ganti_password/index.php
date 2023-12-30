<?php
// Fungsi Ganti Password
$id_admin = $_SESSION['username'];
$admin -> gantiPassword();
?>
<link rel="stylesheet" href="assets/css/Style.css">    
    <!-- INI FORM Ganti Password -->
    <div class="form-container">
        <div class="title-row">
            <div onclick="history.back()" style="display: flex;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" fill="none">
                    <path fill="#292D32" d="M9.57 19.32c-.19 0-.38-.07-.53-.22l-6.07-6.07a.754.754 0 0 1 0-1.06L9.04 5.9c.29-.29.77-.29 1.06 0 .29.29.29.77 0 1.06L4.56 12.5l5.54 5.54c.29.29.29.77 0 1.06-.14.15-.34.22-.53.22Z"/>
                    <path fill="#292D32" d="M20.5 13.25H3.67c-.41 0-.75-.34-.75-.75s.34-.75.75-.75H20.5c.41 0 .75.34.75.75s-.34.75-.75.75Z"/>
                </svg>            
            </div>
            Ganti Password
        </div>
    
        <form action="fungsi/ganti_password.php?admin=gantipassword" method="post" id="reportForm" style="display: flex; gap: 16px;">
            <div class="input-field-laporan">
                <label for="password_lama">Password Lama</label>
                <input type="text" id="password_lama" name="password_lama" placeholder="Masukkan password lama" required>
            </div>
            <div class="input-field-laporan">
                <label for="password_baru">Password Baru</label>
                <input type="text" id="password_baru" name="password_baru" placeholder="Masukkan password baru" required>
            </div>
            <input type="hidden" name="id_admin" value="<?= $id_admin ?>">
            <button type="submit" style="background-color: var(--yellow);">Ganti Password</button>
        </form>
    </div>