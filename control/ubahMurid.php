<?php
  include '../config/admin.php';

  $id = $_POST['id'];
  $nama = htmlspecialchars($_POST['nama']);
  $kelas = $_POST['kelas'];
  $user = $_POST['user'];

  $admin = new Admin;
  $admin->ubahMurid($id, $nama, $kelas, $user);
?>
