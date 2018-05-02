<?php
    include '../config/parent.php';

    $pass = htmlspecialchars($_POST['pass']);

    $parent = new Parentt;
    $parent->changePassword($pass);
?>