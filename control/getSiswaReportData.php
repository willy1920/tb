<?php
  include '../config/guru.php';

  $id = $_POST['id'];

  $guru = new Guru;
  $guru->getSiswaReportData($id);
?>
