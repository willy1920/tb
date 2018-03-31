<?php
  include '../config/guru.php';

  $id = $_POST['id'];
  session_start();
  $guru = new Guru;
  $guru->getSiswaReportData($id);
?>
