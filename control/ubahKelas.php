<?php
  include '../config/admin.php';

  $id = $_POST['id'];
  $nama = htmlspecialchars($_POST['nama']);

  $admin = new Admin;
  $admin->ubahKelas($id, $nama);
?>
