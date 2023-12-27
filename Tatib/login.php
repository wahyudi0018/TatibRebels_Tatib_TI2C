<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

include 'fungsi/pesan_kilat.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600&display=swap"/>
  </head>
  <style>
   .logo-polinema-icon {
    position: relative;
    width: 154px;
    height: 154px;
    object-fit: cover;
  }
  .label {
    position: relative;
    font-weight: 600;
    display: inline-block;
    width: 464px;
  }
  .logo-polinema-parent {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    gap: 32px;
  }
  .username {
    align-self: stretch;
    border-radius: var(--br-45xl);
    background-color: var(--color-white);
    border: 1px solid var(--color-whitesmoke-100);
    box-sizing: border-box;
    height: 60px;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    padding: var(--padding-base) var(--padding-xl);
    font-size: var(--font-size-base);
    color: var(--color-gray-200);
    color: black;
  }
  .top-parent {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: flex-start;
    gap: var(--gap-3xs);
  }
  .password {
    border-radius: var(--br-45xl);
    background-color: var(--color-white);
    border: 1px solid var(--color-whitesmoke-100);
    box-sizing: border-box;
    width: 464px;
    height: 60px;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    padding: var(--padding-base) var(--padding-xl);
    font-size: var(--font-size-base);
    color: var(--color-gray-200);
    color: black;
  }
  .password-icon {
    position: relative;
    width: 24px;
    height: 24px;
  }
  .penunjuk-password {
    cursor: pointer;
  }
  .tampilkan-password {
    position: relative;
  }
  .password-parent {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: flex-start;
    gap: var(--gap-xs);
  }
  .lupa-password {
    position: relative;
    color: var(--red);
    text-align: right;
  }
  .frame-parent1 {
    width: 462px;
    display: flex;
    flex-direction: row;
    align-items: flex-start;
    justify-content: space-between;
    font-size: var(--font-size-base);
  }
  .frame-container,
  .frame-div {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: flex-start;
  }
  .frame-div {
    gap: var(--gap-xs);
  }
  .frame-container {
    gap: 25px;
  }
  .masuk {
    flex: 1;
    position: relative;
    font-weight: 600;
  }
  .masuk-wrapper {
    border-radius: var(--br-45xl);
    background-color: var(--yellow);
    width: 464px;
    height: 60px;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    padding: var(--padding-base) var(--padding-xl);
    box-sizing: border-box;
    text-align: center;
    color: var(--white);
  }
  .frame-group,
  .frame-parent {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: flex-start;
    gap: var(--gap-11xl);
  }
  .frame-group {
    text-align: left;
    font-size: var(--font-size-xl);
  }
  .frame-parent {
    position: absolute;
    top: calc(50% - 359px);
    left: calc(50% - 292px);
    border-radius: 20px;
    background-color: var(--color-white);
    padding: 60px;
  }
  .login {
    position: relative;
    background-color: var(--dark-blue);
    width: 100%;
    height: 1024px;
    overflow: hidden;
    text-align: center;
    font-size: 28px;
    color: var(--color-gray-100);
    font-family: var(--font-manrope);
    zoom: 63.6%;
  }
  .password-pesan {
    display: flex;
    flex-direction: column;
    text-align: left;
    background-color: rgba(252, 91, 41, 0.12);
    padding: 22px 22px;
    gap: 10px;
    border-radius: 8px;
    gap: 10px;
    font-size: 20px;
    font-weight: 400px;
  }
  .username-pesan {
    display: flex;
    flex-direction: column;
    text-align: left;
    background-color: rgba(255, 221, 51, 0.2);
    padding: 22px 22px;
    gap: 10px;
    border-radius: 8px;
    gap: 10px;
    font-size: 20px;
    font-weight: 400px;
  }
  body {
    margin: 0;
    line-height: normal;
  }
  
  :root {
    /* fonts */
    --font-manrope: Manrope;
  
    /* font sizes */
    --font-size-xl: 20px;
    --font-size-base: 16px;
  
    /* Colors */
    --dark-blue: #2e3659;
    --color-white: #fff;
    --yellow: #febb3a;
    --white: #f8f8f8;
    --color-whitesmoke-100: #ededed;
    --red: #ee2200;
    --color-gray-100: #1b1b1b;
    --color-gray-200: rgba(27, 27, 27, 0.4);
  
    /* Gaps */
    --gap-11xl: 30px;
    --gap-xs: 12px;
    --gap-3xs: 10px;
  
    /* Paddings */
    --padding-base: 16px;
    --padding-xl: 20px;
  
    /* Border radiuses */
    --br-45xl: 64px;
  }   
  </style>
  <body>
    <form action="cek_login.php" method="post">
    <div class="login">
      <div class="frame-parent">
        <div class="logo-polinema-parent">
          <img class="logo-polinema-icon" src="assets/img/polinema.png"/>
          <div class="label">Selamat Datang!</div>
          <?php
            if (isset($_SESSION['_flashdata'])) {
                foreach ($_SESSION['_flashdata'] as $key => $val) {
                    echo get_flashdata($key);
                }
            }
            ?>
        </div>
        <div class="frame-group">
          <div class="frame-container">
            <div class="top-parent">
              <div class="label">Username</div>
              <input class="username" type="text" id="inputUsername" name="username" placeholder="Masukkan username Anda"/>
            </div>
            <div class="frame-div">
              <div class="top-parent">
                <div class="label">Password</div>
                <input class="password" type="password" id="inputPassword" name="password" placeholder="Masukkan password Anda"/>
              </div>
              <div class="frame-parent1">
                <div class="password-parent">
                  <img class="password-icon password-pointer" src="assets/img/kotak.png"/>
                  <div class="tampilkan-password">Tampilkan password</div>
                </div>
                <!-- <div class="lupa-password">Lupa password?</div> -->
              </div>
            </div>
          </div>
          <button class="masuk-wrapper" type="submit">
            <div class="masuk" style="font-size: 19px;">Masuk</div>
        </button>
        </div>
      </div>
    </div>
    <script>
      function login() {
        const inputUsername = document.querySelector('.username[type="text"]');
        const inputPassword = document.querySelector('.password[type="password"]');
        const passwordPointer = document.querySelector('.password-pointer');
        const passwordIcon = document.querySelector('.password-icon');
        // const forgotPasswordLink = document.querySelector('.lupa-password');

        passwordPointer.onclick = function () {
          const isPasswordVisible = inputPassword.type === 'text';
          inputPassword.type = isPasswordVisible ? 'password' : 'text';
          passwordIcon.src = isPasswordVisible ? 'assets/img/kotak.png' : 'assets/img/kotak-cek.png';
        };
        
        // forgotPasswordLink.onclick = function () {
        //   window.location.href = 'https://wa.me/xxxxxx';
        // };
      }

      login();
    </script>
  </body>
</html>