<?php
    include "../config/parent.php";

    $nik = $_POST['nik'];

    $parent = new Parentt;
    $parent->dashboardReport($nik);
?>