<?php
  include 'db.php';

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
            echo "0";
            //header("Location: ../admin.php");
            exit();
          }
          elseif ($_SESSION['status'] == 1) {
            echo "1";
            //header("Location: ../guru.php");
            exit();
          }
          else{
            session_destroy();
            //header("Location: ../");
            //exit();
          }
        }
      }
      else {
        echo "Username or password incorrect";
        //header("Location: /index.php?error=1");
      }
    }
    else {
      echo "sql wrong";
    }
  }

  public function logout(){
    session_destroy();
    header("Location: /");
    exit();
  }

  public function loginExternal($email, $pass){
    $pass = sha1($pass);
    $data;

    $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
    $sql = "SELECT email FROM ortu WHERE email=? and pass=?";
    if ($stmt = $mysqli->prepare($sql)) {
      $stmt->bind_param("ss", $email, $pass);
      if ($stmt->execute()) {
        $stmt->bind_result($data);
        $stmt->store_result();
        if ($stmt->num_rows == 1) {
          if ($stmt->fetch()) {
            $_SESSION['email'] = $data;
          }
          echo "1";
          exit();
          //header("Location: /parent.php");
          }
          else {
            echo "Username or password incorrect";
            exit();
            //header("Location: /index.php?error=1");
          }
        }
        else{
          echo "Execute failed";
          exit();
          //header("Location: /index.php?error=1");
        }
    }
    else{
      echo "Prepare failed";
      exit();
      //header("Location: /index.php?error=1");
    }
  }
}

?>
