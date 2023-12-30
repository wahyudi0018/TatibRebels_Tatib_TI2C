  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700&display=swap" />
  <script src="https://kit.fontawesome.com/822a6d911d.js" crossorigin="anonymous"></script>

  <!-- Main -->
  <main class="main-pelanggaran-container">

    <!-- Menu Tatib -->
    <section>
      <h1 class="judul-tatib">Tata Tertib Kehidupan Kampus</h1>
      <div class="menu-pelanggaran">
        <div class="menu-pelanggaran-item" data-target="tingkat-pelanggaran" onclick="tampilMenu(this)">
          <div class="pelanggaran-btn">Tingkat</div>
        </div>
        <div class="menu-pelanggaran-item" data-target="klasifikasi-pelanggaran" onclick="tampilMenu(this)">
          <div class="pelanggaran-btn">Klasifikasi</div>
        </div>
        <div class="menu-pelanggaran-item" data-target="akumulasi-pelanggaran" onclick="tampilMenu(this)">
          <div class="pelanggaran-btn">Akumulasi</div>
        </div>
        <div class="menu-pelanggaran-item" data-target="sanksi-pelanggaran" onclick="tampilMenu(this)">
          <div class="pelanggaran-btn">Sanksi</div>
        </div>
      </div>
    </section>
   
    <section class="main-pelanggaran">

      <!-- Konten Tingkat Pelanggaran -->
      <div class="pelanggaran-item" id="tingkat-pelanggaran">
        <div class="judul-tingkat">
          <i class="fa-solid fa-border-all menu-logo"></i>
          <h2>Tingkat Pelanggaran</h2>
        </div>
        <div class="tingkat-pelanggaran">

          <!-- Backend Tingkat Pelanggaran -->
          <?php
            $mahasiswa -> tampilTingkatPelanggaran();
          ?>
        </div>
      </div>
      
      <!-- Konten Klasifikasi Pelanggaran -->
      <div class="pelanggaran-item" id="klasifikasi-pelanggaran">
        <div class="judul-tingkat">
          <i class="fa-solid fa-border-all menu-logo"></i>
          <h2>Klasifikasi Pelanggaran Tata Tertib</h2>
        </div>
        <div class="klasifikasi-container">
          <div class="header-klasifikasi">
            <div class="kolom-no">No.</div>
            <div class="kolom-pelanggaran">Pelanggaran</div>
            <div class="kolom-tingkat">Tingkat</div>
          </div>
          <div class="konten-klasifikasi">

            <!-- Backend Klasifikasi Pelanggaran -->
            <?php
            $mahasiswa -> tampilDeskripsiPelanggaran();
            ?>
          </div>
        </div>
      </div>

      <!-- Konten Akumulasi Pelanggaran -->
      <div class="pelanggaran-item" id="akumulasi-pelanggaran">
        <div class="judul-tingkat">
          <i class="fa-solid fa-border-all menu-logo"></i>
          <h2>Akumulasi Sanksi Pelanggaran</h2>
        </div>
        <div class="deskripsi-akumulasi">
          Perbuatan / tindakan pelanggaran Tata Tertib Kehidupan Kampus akan
          diakumulasikan untuk setiap kategori pelanggaran dan berlaku
          sepanjang mahasiswa masih tercatat sebagai mahasiswa di Polinema.
        </div>
        <ol class="daftar-akumulasi" type="a">

          <!-- Backend Akumulasi Pelanggaran -->
          <?php
          $mahasiswa -> tampilAkumulasiPelanggaran();
          ?>
        </ol>
      </div>

      <!-- Konten Sanksi Pelanggaran -->
      <div class="pelanggaran-item" id="sanksi-pelanggaran">
        <div class="judul-tingkat">
          <i class="fa-solid fa-border-all menu-logo"></i>
          <h2>Sanksi Pelanggaran</h2>
        </div>
        <div class="sanksi-container">

          <!-- Backend Sanksi Pelanggaran -->
          <?php
          $mahasiswa -> tampilSanksiPelanggaran();
          ?>
        </div>
      </div>
    </section>
    <style>
    /* Body dan Root */
    body {
      margin: 0;
      font-family: var(--font-manrope);
      cursor: default;
    }

    /* Nonaktif Scrollbar */
    body::-webkit-scrollbar {
      width: 0px;
    }

    /* Non Aktif Elemen */
    .non-active {
      display: none;
    }
    :root {
        /* fonts */
        --font-manrope: Manrope;
        --font-inherit: inherit;

        /* font sizes */
        --font-size-xs: 12px;
        --font-size-sm: 14px;
        --font-size-base: 16px;
        --font-size-xl: 20px;
        --font-size-lg: 18px;
        
        /* Colors */
        --color-gray-100: #fcfcfc;
        --color-gray-200: #1b1b1b;
        --color-gray-300: rgba(27, 27, 27, 0.6);
        --color-gray-400: rgba(27, 27, 27, 0.8);
        --dark-blue: #2e3659;
        --white: #f8f8f8;
        --color-whitesmoke-100: #f1f1f1;
        --color-darkgray: #b0b0b0;
        --yellow: #febb3a;
        --color-white: #fff;
        --color-gainsboro: #dedede;
        --color-moccasin: rgba(255, 238, 187, 0.8);
        
        /* Gaps */
        --gap-5xs: 8px;
        --gap-3xs: 10px;
        --gap-9xs: 4px;
        --gap-21xl: 40px;
        --gap-lgi: 19px;
        --gap-mini: 15px;
        --gap-9xl: 28px;
        --gap-7xl: 26px;
        --gap-xs: 12px;
        
        /* Paddings */
        --padding-xs: 12px;
        --padding-3xs: 10px;
        --padding-5xl: 24px;
        --padding-lg: 18px;
        --padding-xl: 20px;
        --padding-21xl: 40px;
        
        /* Border radiuses */
        --br-mini: 15px;
        --br-5xs: 8px;
        --br-xs: 12px;
        --br-181xl: 200px;
    }

    /* Main */

    /* Menu Pelanggaran */
    .main-pelanggaran-container {
      margin-top: 113px;
      background-color: var(--color-gray-100);
      font-size: var(--font-size-xl);
      color: var(--color-gray-200);
      zoom: 88%;
    }

    .judul-tatib {
      display: flex;
      font-size: 32px;
      justify-content: center;
    }

    .menu-pelanggaran {
      display: flex;
      margin-top: 40px;
      justify-content: center;
      gap: var(--gap-xs);
      color: var(--color-gray-400);
    }

    .menu-pelanggaran-item {
      display: flex;
      border-radius: var(--br-181xl);
      background-color: var(--color-whitesmoke-100);
      height: 48px;
      align-items: center;
      padding: var(--padding-xl) var(--padding-21xl);
      box-sizing: border-box;
      cursor: pointer;
    }

    .menu-pelanggaran-item.active {
      background-color: var(--yellow);
    }

    .pelanggaran-btn {
      font-weight: 500;
    }

    /* Konten Tatib */
    .main-pelanggaran {
      margin-top: 23px;
    }

    .pelanggaran-item {
      margin-left: 51px;
      width: 94%;
      margin-bottom: 40px;
    }

    /* Judul Konten*/
    .judul-tingkat {
      display: flex;
      align-items: center;
      padding: 0 var(--padding-lg);
      gap: var(--gap-mini);
    }

    .menu-logo {
      width: 24px;
      height: 24px;
    }

    .judul-tingkat h2 {
      font-weight: 600;
      font-size: var(--font-size-xl);
    }

    /*Konten Tingkat Pelanggaran */
    .tingkat-pelanggaran {
      display: flex;
      margin-top: 13px;
      padding-left: 52px;
      gap: 16px;
      font-size: var(--font-size-lg);
      color: var(--color-gray-400);
    }

    .tingkat-pelanggaran-item {
      border-radius: var(--br-xs);
      border: 1px solid var(--color-gainsboro);
      box-sizing: border-box;
      height: 100px;
      width: 234vw;
      padding-left: var(--padding-xl);
    }

    .tingkat-pelanggaran-item h3 {
      font-size: var(--font-size-lg);
      font-weight: 600;
    }

    .tingkat-pelanggaran-item div {
      font-size: var(--font-size-base);
      font-weight: 500;
    }

    /*Konten Klasifikasi Pelanggaran */
    .klasifikasi-container {
      border-radius: var(--br-mini);
      background-color: var(--color-white);
      border: 1px solid var(--color-gainsboro);
      padding: var(--padding-xs);
      font-size: var(--font-size-lg);
      margin-top: 15px;
    }

    .header-klasifikasi {
      display: flex;
      border-bottom: 1px solid var(--color-gainsboro);
      height: 62px;
    }

    .header-klasifikasi div {
      display: flex;
      align-items: center;
      padding: var(--padding-3xs);
      font-weight: 600;
    }

    .kolom-no {
      width: 58vw;
      text-align: center;
    }

    .kolom-pelanggaran {
      width: 948vw;
      padding-left: 30px;
      padding-right: 30px;
    }

    .kolom-tingkat {
      width: 58vw;
      text-align: center;
    }

    .konten-klasifikasi {
      display: flex;
      flex-direction: column;
      font-size: var(--font-size-base);
      color: var(--color-gray-400);
    }

    .klasifikasi-item {
      display: flex;
      border-bottom: 1px solid var(--color-gainsboro);
      height: 15vh;
      justify-content: center;
      align-items: center;
    }

    /* Konten Akumulasi Pelanggaran */
    .deskripsi-akumulasi,
    .daftar-akumulasi {
      padding-left: 57px;
      padding-top: 10px;
      font-weight: 500;
      font-size: var(--font-size-lg);
    }

    .daftar-akumulasi {
      list-style-position: inside;
    }

    .poin-akumulasi {
      padding-bottom: 15px;
    }

    /* Konten Sanksi Pelanggaran */
    .sanksi-container {
      border-radius: var(--br-mini);
      background-color: var(--color-white);
      border: 1px solid var(--color-gainsboro);
      padding: var(--padding-xs);
      font-size: var(--font-size-lg);
      margin-top: 10px;
      margin-left: 15px;
      display: flex;
      flex-direction: column;
    }

    .sanksi-item {
      display: flex;
      border-bottom: 1px solid var(--color-gainsboro);
      flex-direction: column;
    }

    .sanksi-item:not(:first-child){
      margin-top: 10px;
    }

    .sanksi-tingkat {
      border-radius: var(--br-5xs);
      background-color: var(--color-moccasin);
      padding: var(--padding-3xs) var(--padding-xs);
      font-weight: 500;
      width: 25%;
    }

    .detail-sanksi {
      font-weight: 500;
      padding: var(--padding-3xs);
      color: var(--color-gray-400);
    }
  </style>
  <script>
  function tampilMenu(element){
    let targetMenu = element.getAttribute('data-target');
    let tampilKonten = document.getElementById(targetMenu);
    const menuPelanggaran = document.querySelectorAll(".menu-pelanggaran-item");
    const kontenPelanggaran = document.querySelectorAll(".pelanggaran-item");

    kontenPelanggaran.forEach(function (k){
        k.classList.add("non-active")
    })

    menuPelanggaran.forEach(function (m){
        m.classList.remove("active");
    });

    element.classList.add("active");
    tampilKonten.classList.remove("non-active");
   }
   </script>
  </main>