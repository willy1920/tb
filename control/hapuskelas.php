<?php
  include '../config/admin.php';

  $id = htmlspecialChars($_POST['id']);

  $admin = new Admin;
  $admin->hapusKelas($id);
?>
