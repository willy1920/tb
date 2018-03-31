<?php
  session_start();
  if ($_SESSION['status'] != 1 && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
  }
  $id = htmlspecialchars($_GET['id']);
  $rapot = htmlspecialchars($_GET['rapot']);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Form Upload Rapot</title>
  </head>
  <body>
    <form action="control/uploadRapot.php" method="post" enctype="multipart/form-data">
      Pilih file : <input type="file" name="file" value="50"><br>
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="hidden" name="rapot" value="<?php echo $rapot; ?>">
      <input type="submit" value="Submit">
    </form>
  </body>
</html>
