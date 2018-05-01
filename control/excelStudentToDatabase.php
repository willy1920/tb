<?php
    include '../config/admin.php';

    $nik = htmlspecialchars($_POST['nik']);
    $name = htmlspecialchars($_POST['name']);
    $class = htmlspecialchars($_POST['class']);
    $parent = htmlspecialchars($_POST['parent']);
    $paid = htmlspecialchars($_POST['paid']);

    $admin = new Admin;
    $admin->excelStudentToDatabase($nik, $name, $class, $parent, $paid);
?>