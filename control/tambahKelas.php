<?php
  include '../config/admin.php';

  $nama = htmlspecialchars($_POST['nama']);

  $admin = new Admin;
  $admin->tambahKelas($nama);
?>
