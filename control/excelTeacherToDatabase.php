<?php
    include "../config/admin.php";

    $class = htmlspecialchars($_POST['class']);
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);

    $admin = new Admin;
    $admin->excelTeacherToDatabase($email, $name, $class);
?>