<?php
  session_start();
  if (!isset($_SESSION['user']) || $_SESSION['status'] != 0) {
    header("Location: index.php");
    exit();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin Rapot Tunas Bangsa</title>
    <link rel="stylesheet" href="style/general.css">
    <script type="text/javascript" src="js/ajax.js"></script>
    <script type="text/javascript" src="js/admin.js"></script>
  </head>
  <body>
    <nav>
      <div onclick="dashboardKelas()">Kelas</div>
      <div>Murid</div>
    </nav>
    <main id="respon">

    </main>
  </body>
</html>
