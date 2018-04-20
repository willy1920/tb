<?php
  include '../config/user.php';



  $email = htmlspecialchars($_POST['email']);
  $pass = htmlspecialchars($_POST['pass']);

  $class = new User;
  $class->login($email, $pass);
?>
