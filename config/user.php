<?php
  include 'db.php';
  session_start();

  class User extends Database{
    public function login($user, $pass){
      $pass = sha1($pass);
      $json = "{";
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $sql = "SELECT user, status FROM user WHERE user=? AND pass=?";
      $stmt = $mysqli->prepare($sql);
      $stmt->bind_param('ss', $user, $pass);

      if ($stmt->execute()) {
        $stmt->bind_result($name, $status);
        $stmt->store_result();
        if ($stmt->num_rows == 1) {
          if ($stmt->fetch()) {
            $_SESSION['user'] = $name;
            $_SESSION['status'] = $status;
            if ($_SESSION['status'] == 0) {
              header("Location: ../admin.php");
            }
            elseif ($_SESSION['status'] == 1) {
              header("Location: ../guru.php");
            }
            else{
              session_destroy();
              header("Location: ../");
            }
          }
        }
        else {
          echo "Username or password is incorrect";
        }
      }
      else {
        echo "sql wrong";
      }
    }

    public function logout(){
      session_destroy();
      header("Location: /");
    }
  }

?>
