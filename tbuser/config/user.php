<?php
    include "db.php";

    class User extends Database{
        public function login($email, $pass){
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
                        header("Location: /parent.php");
                    }
                    else {
                        header("Location: /index.php?error=1");
                    }
                }
                else{
                    header("Location: /index.php?error=1");
                }
            }
            else{
                header("Location: /index.php?error=1");
            }
        }
    }
    
?>