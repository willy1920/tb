<?php
  include '../config/admin.php';

  $email = $_POST['email'];
  $nama = $_POST['nama'];
  $kelas = $_POST['kelas'];

  $admin = new Admin;
  $admin->ubahGuruDashboard($email, $nama, $kelas);
?>
