<?php

require_once 'Koneksi.php';

class User extends Koneksi
{
  public function validasiUser()
  {
    $valid = true;

    // cek setiap data apakah kosong ataukah tidak
    foreach ($_POST as $key => $value) {
      if (empty($_POST[$key])) {
        $valid = false;
      }
    }

    if ($valid == true) {
      // jika password dan confirm password tidak sama
      if ($_POST['password'] != $_POST['confirm_password']) {
        $errorMessage[] = 'Password harus sama';
        $valid = false;
      }

      if (!isset($errorMessage)) {
        // jika email tidak valid
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
          $errorMessage[] = "E-mail tidak valid";
          $valid = false;
        }
      }

      if (! isset($errorMessage)) {
        // jika checkbox terms tidak terceklis
        if (! isset($_POST["terms"])) {
          $errorMessage[] = "Terima terms and conditions untuk melanjutkan";
          $valid = false;
        }
      }
    } else {
      // jika semua form pendaftaran belum diisi
      $errorMessage[] = "Form pendaftaran harus diisi";
    }

    if ($valid == false) {
      return $errorMessage;
    }

    return;
  }

  // cek apakah username atau email sudah terdaftar ataukah belum
  public function cekMember($username, $email)
  {
    $sql = "SELECT username, email FROM users WHERE username = '$username' OR email = '$email'";
    $q = $this->conn->query($sql);
    
    if ($q->num_rows == 0) {
      $this->aksiDaftar();
      return true;
    }

    return;
  }

  // proses pendaftaran
  public function aksiDaftar()
  {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $nama = filter_var($_POST['nama_lengkap'], FILTER_SANITIZE_STRING);

    $sql = "INSERT INTO users VALUES ('', '$username', '$password', '$email', '$nama')";
    $q = $this->conn->query($sql);

    return $q;
  }
}

$user = new User;