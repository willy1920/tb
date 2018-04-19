<?php
  include '../config/admin.php';

  $email = htmlspecialChars($_POST['email']);

  $admin = new Admin;
  $admin->hapusOrtu($email);
?>
