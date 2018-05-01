<?php
    include "../config/admin.php";

    $email = htmlspecialchars($_POST['email']);

    $admin = new Admin;
    $admin->excelParentToDatabase($email);
?>