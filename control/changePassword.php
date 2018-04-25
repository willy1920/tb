<?php
    include '../config/guru.php';

    $email = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['pass']);

    $guru = new Guru;
    $guru->changePassword($email, $pass);
?>