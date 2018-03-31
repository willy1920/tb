<?php
  include '../config/guru.php';

  $id = htmlspecialchars($_POST['id']);
  $rapot = htmlspecialchars($_POST['rapot']);

  $hash = md5($id."-".$rapot);

  $targetFolder = "../rapot/";
  $targetFolder = $targetFolder.$id.$hash;
  $ok = 1;
  $fileType = $_FILES['file']['type'];

  if ($fileType == "application/pdf") {
    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFolder.".pdf")) {
      echo 'The file '.basename($_FILES['file']['name'])." is uploaded";
      $guru = new Guru;
      $guru->uploadRapot($id, $rapot, $targetFolder);
    }
    else {
      echo "Profile uploading file";
    }
  }
  else {
    echo "Only pdf";
  }
?>
