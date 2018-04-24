<?php
  include '../config/admin.php';

  $email = htmlspecialchars($_POST['email']);
  $nama = htmlspecialchars($_POST['nama']);
  $kelas = $_POST['kelas'];

  $admin = new Admin;
  $admin->ubahGuru($email, $nama, $kelas);
?>
