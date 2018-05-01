<?php
    include '../config/admin.php';

    $id = $_POST['id'];

    $admin = new Admin;
    $admin->resetPassTeacher($id);
?>