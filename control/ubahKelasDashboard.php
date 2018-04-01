<?php
  include '../config/admin.php';

  $id = $_POST['id'];
  $nama = $_POST['nama'];

  $admin = new Admin;
  $admin->ubahKelasDashboard($id, $nama);
?>
