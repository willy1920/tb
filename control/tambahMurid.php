<?php
  include '../config/admin.php';

  $nama = htmlspecialchars($_POST['nama']);
  $nik = htmlspecialchars($_POST['nik']);
  $email = htmlspecialchars($_POST['email']);
  $kelas = htmlspecialchars($_POST['kelas']);

  $admin = new Admin;
  $admin->tambahMurid($nik, $nama, $kelas, $email);
?>
