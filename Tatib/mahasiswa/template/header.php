<?php
include 'fungsi/pelanggaran.php';
include 'fungsi/mahasiswa.php';

$mahasiswa = new Mahasiswa();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa</title>
    <link rel="stylesheet" href="assets/css/Style.css">
</head>
<body>
    <!-- HEADER -->
    <div class="header">
        <div class="logo-section">
            <img class="logo-polinema-icon" alt="" src="assets/img/polinema.png" />
            <p style="font-size: var(--font-size-xl); font-weight: var(--font-weight-manrope-bold);">TATIB POLINEMA</p>
        </div>
    
        <div class="tab-section">
            <!-- <a href="" class="nav-menu-active tab-home"> -->
            <a aria-current="page" href="index.php" class="nav-menu tab-home">
                Home
            </a>
            <a href="index.php?page=riwayat" class="nav-menu tab-riwayat-pelanggaran">
                Riwayat Pelanggaran
            </a>
            <a href="index.php?page=tatib" class="nav-menu tab-panduan-tatib">
                Panduan Tata Tertib
            </a>
        </div>
        <div class="profil-section">
            <div class="profil-container">
                <img class="logo-polinema-icon" alt="" src="assets/img/circle.png" />
                <div class="data-mhs" style="font-weight: var(--font-weight-manrope-reguler); font-size: var(--font-size-sm);">
                    <?php
                    echo '<p>' . $mahasiswa->tampilNama() . '</p>';
                    echo '<p>' . $mahasiswa->tampilNO() . '</p>';
                    ?>
                </div>
            </div>
            <svg class= "arrow-icon" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none">
                <path fill="#F8F8F8"
                d="M12.5 17.3c-.7 0-1.4-.27-1.93-.8L4.05 9.98a.754.754 0 0 1 0-1.06c.29-.29.77-.29 1.06 0l6.52 6.52c.48.48 1.26.48 1.74 0l6.52-6.52c.29-.29.77-.29 1.06 0 .29.29.29.77 0 1.06l-6.52 6.52c-.53.53-1.23.8-1.93.8Z" />
            </svg>
            <div class="profil-toggle hidden" style="left: auto; right: 3%">
                <a href="index.php?page=ganti_password" class="profil-toggle-container" style="color:inherit; text-decoration: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none">
                        <path fill="#1B1B1B" d="M4.635 17.062c-.075 0-.158-.007-.225-.015l-1.628-.225c-.78-.105-1.485-.802-1.605-1.597l-.225-1.643c-.075-.525.15-1.207.525-1.59L4.77 8.7a6.212 6.212 0 0 1 1.65-5.933 6.254 6.254 0 0 1 8.82 0 6.194 6.194 0 0 1 1.822 4.41 6.194 6.194 0 0 1-1.822 4.41c-1.575 1.56-3.818 2.175-5.933 1.635l-3.3 3.293c-.315.33-.877.547-1.372.547ZM10.822 2.07a5.086 5.086 0 0 0-3.615 1.492A5.102 5.102 0 0 0 5.932 8.7a.56.56 0 0 1-.142.562l-3.525 3.525c-.128.128-.233.458-.21.63l.225 1.643c.045.285.352.607.637.645l1.635.225c.18.03.51-.075.638-.203l3.54-3.532a.56.56 0 0 1 .562-.135c1.808.57 3.78.082 5.13-1.268a5.089 5.089 0 0 0 1.493-3.615 5.076 5.076 0 0 0-1.493-3.615 5.045 5.045 0 0 0-3.6-1.492Z"/>
                        <path fill="#1B1B1B" d="M6.893 15.405a.556.556 0 0 1-.398-.165L4.77 13.515a.566.566 0 0 1 0-.795.566.566 0 0 1 .795 0l1.725 1.725a.566.566 0 0 1 0 .795.556.556 0 0 1-.397.165Zm3.982-6.593a1.69 1.69 0 0 1-1.688-1.687c0-.93.758-1.688 1.688-1.688.93 0 1.688.758 1.688 1.688a1.69 1.69 0 0 1-1.688 1.688Zm0-2.25a.567.567 0 0 0-.562.563c0 .308.255.562.562.562a.567.567 0 0 0 .562-.562.567.567 0 0 0-.562-.562Z"/>
                    </svg>                    
                    Change Password
                </a>
                <div style="background-color: #dedede; height: 1px;"></div>
                <a href="logout.php" class="profil-toggle-container" style="color: #E20; text-decoration: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none">
                        <path fill="#E20" d="M11.43 16.703h-.098c-3.33 0-4.935-1.313-5.212-4.253a.564.564 0 0 1 .51-.615.569.569 0 0 1 .615.51c.217 2.355 1.327 3.232 4.095 3.232h.097c3.053 0 4.133-1.08 4.133-4.132v-4.89c0-3.053-1.08-4.133-4.133-4.133h-.097c-2.783 0-3.893.893-4.095 3.293a.565.565 0 0 1-.615.51.563.563 0 0 1-.518-.608c.255-2.985 1.868-4.32 5.22-4.32h.098c3.682 0 5.257 1.575 5.257 5.258v4.89c0 3.682-1.575 5.258-5.257 5.258Z"/>
                        <path fill="#E20" d="M11.16 9.562H1.5A.567.567 0 0 1 .938 9c0-.307.254-.562.562-.562h9.66a.562.562 0 1 1 0 1.125Z"/>
                        <path fill="#E20" d="M9.487 12.075a.556.556 0 0 1-.397-.165.566.566 0 0 1 0-.795L11.205 9 9.09 6.885a.566.566 0 0 1 0-.795.566.566 0 0 1 .795 0l2.512 2.513a.566.566 0 0 1 0 .795L9.885 11.91a.556.556 0 0 1-.398.165Z"/>
                    </svg>                    
                    Log Out
                </a>
            </div>            
        </div>
    </div>
    <script>
        function tampilProfilToggle() {
            const arrowIcons = document.querySelectorAll(".arrow-icon");
            const profilToggles = document.querySelectorAll(".profil-toggle");

            arrowIcons.forEach((arrowIcon, index) => {
                arrowIcon.onclick = function() {
                    const isHidden = profilToggles[index].classList.contains("hidden");
                    if (isHidden) {
                        profilToggles[index].classList.remove("hidden");
                    } else {
                        profilToggles[index].classList.add("hidden");
                    }
                };
            });
        }

        tampilProfilToggle();
    </script>