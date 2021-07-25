<?php

require_once 'User.php';


if (isset($_POST['submit'])) {
  
  $errorMessage = [];
  
  if (empty($user->validasiUser())) {
    if($user->cekMember($_POST['username'], $_POST['email'])) {
      session_start();
      $_SESSION['nama'] = $_POST['nama_lengkap'];
      header('Location: welcome.php');
    } else {
      $errorMessage[] = "Username atau E-mail sudah terdaftar";
    }
  } else {
    $errorMessage = $user->validasiUser();
  }

  foreach ($errorMessage as $errors) {
    $error = $errors;
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>BERGABUNG METAL ONLINE</title>
  <link rel="stylesheet" href="CSS.css">
</head>
<body>
<nav class="navi">
     <ul>
        <li><a href="syarat.php">Syarat Ketentuan</a></li>
        <li><a href="apaitumetal.php">SEJARAH Musik METAL</a></li>
        <li class="dropdown">
        <a href="#" class="dropbtn">Akun Somed ADMIN</a>
        <div class="dropdown-content">
        <a href="https://www.facebook.com/root425p">Facebook</a>
        <a href="https://www.instagram.com/ahmad_jar22/?hl=id">Instagram</a>
        <a href="https://github.com/Ahmadjarr">GitHub</a>
        </div>
        </li>
     </ul>
    </nav>
  <h1>Pendaftaran Akun Musisi Metal</h1>
  <form action="" method="post" name="form_pendaftaran" autocomplete="off">
      <div class="polmulir">
    <h4>Form Pendaftaran</h4>
    
    <!-- Pesan error disini -->
    <?php
    if (isset($_POST['submit'])) {
  
        $errorMessage = [];
        
        if (empty($user->validasiUser())) {
          if($user->cekMember($_POST['username'], $_POST['email'])) {
            header('Location: welcome.php');
          } else {
            $errorMessage[] = "Username atau E-mail sudah terdaftar";
          }
        } else {
          $errorMessage = $user->validasiUser();
        }
      
        foreach ($errorMessage as $errors) {
          $error = $errors;
        }
      }
    ?>

    <label>Username</label><br/>
    <input type="text" name="username" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>"><br/>
    <label>Password</label><br/>
    <input type="password" name="password" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>"><br/>
    <label>Confirm Password</label><br/>
    <input type="password" name="confirm_password" value="<?php if (isset($_POST['confirm_password'])) echo $_POST['confirm_password']; ?>"><br/>
    <label>Nama Lengkap</label><br/>
    <input type="text" name="nama_lengkap" value="<?php if (isset($_POST['nama_lengkap'])) echo $_POST['nama_lengkap']; ?>"><br/>
    <label>E-mail</label><br/>
    <input type="text" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"><br/>
    <input type="checkbox" name="terms">SIAP BERGABUNG<br/>
    <button name="submit" type="submit" value="daftar">Daftar</button>
  </form>
    </div>
    <div class="footer">
			<p class="copy">Copy right AHMAD FAJAR 2000018225</p>
		</div>
</body>
</html>