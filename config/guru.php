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

    public function getSiswaReportData($id){
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $sql = "SELECT mid1, term1, mid2, term2 FROM report WHERE nik=? AND id_kelas=?";
      if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ii", $id, $_SESSION['kelas']);
        $stmt->execute();
        if ($stmt->num_rows == 1) {
          echo "1";
        }
        else {
          $sql = "INSERT INTO report (id_report, nik, id_kelas, mid1, term1, mid2, term2) VALUES(?, ?, ?, ?, ?, ?, ?)";
          if ($stmtt = $mysqli->prepare($sql)) {
            $stmtt->bind_param("ii", $id, $_SESSION['kelas']);
            $stmtt->execute();
            getSiswaReportData($id);
            $stmtt->close();
          }
          else {
            echo "sql 2 salah";
          }
        }
      }
      else {
        echo "sql salah";
      }

      $stmt->close();
      $mysqli->close();
      unset($sql, $stmt, $mysqli);
    }






























  }

?>
