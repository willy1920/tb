<?php
  include '../config/admin.php';

  $email = htmlspecialchars($_POST['email']);
  $nama = htmlspecialchars($_POST['nama']);
  $kelas = htmlspecialchars($_POST['kelas']);

  $admin = new Admin;
  $admin->tambahGuru($email, $nama, $kelas);
?>
