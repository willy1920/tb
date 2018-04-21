<?php
  include '../config/user.php';

  $user = htmlspecialchars($_POST['user']);
  $pass = htmlspecialchars($_POST['pass']);

  $class = new User;
  $class->login($user, $pass);
?>
