<?php
  include '../config/admin.php';

  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $user = $_POST['user'];
  $kelas = $_POST['kelas'];

  $admin = new Admin;
  $admin->ubahMuridDashboard($id, $nama, $user, $kelas);
?>
