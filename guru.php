<?php
  session_start();
  if (!isset($_SESSION['user']) || $_SESSION['status'] != 1) {
    header("Location: /");
    exit();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Guru Rapot Tunas Bangsa</title>
    <script type="text/javascript" src="js/ajax.js"></script>
    <script type="text/javascript" src="js/guru.js"></script>
  </head>
  <body onload="getSiswa()">
    <menu>
      <a href="control/logout.php">Logout</a>
    </menu>
    <main id="respon">

    </main>
  </body>
</html>
