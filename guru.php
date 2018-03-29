<?php
  session_start();
  if ($_SESSION['status'] != 1 && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Guru Rapot Tunas Bangsa</title>
    <script type="text/javascript" src="js/guru.js"></script>
  </head>
  <body>
    <main id="respon">

    </main>
    <?php
      include 'config/guru.php';

      $guru = new Guru;
      $guru->getIdKelas();
    ?>
  </body>
</html>
