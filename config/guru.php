<?php
  include 'db.php';

  class Guru extends Database{

    public function getSiswa(){
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $sql = "SELECT nik, nama FROM siswa WHERE id_kelas='".$_SESSION['kelas']."'";
      $query = $mysqli->query($sql);
      if ($query->num_rows > 0) {
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
          echo "<div onclick='dashSiswa(".$row['nik'].")'>".$row['nama']."</div>";
        }
      }
    }

    public function getIdKelas(){
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $sql = "SELECT * FROM guru WHERE id_guru='".$_SESSION['user']."'";
      $query = $mysqli->query($sql);
      if ($query->num_rows == 1) {
        $row = $query->fetch_array(MYSQLI_NUM);
        $_SESSION['nama'] = $row[1];
        $_SESSION['kelas'] = $row[2];
        $this->getSiswa();
      }
      else {
        echo "cacat";
      }
    }
  }

?>
