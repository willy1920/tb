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
      $kelas = $_SESSION['kelas'];
      $sql = "SELECT mid1, term1, mid2, term2 FROM report WHERE nik=? AND id_kelas=?";
      if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ii", $id, $kelas);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
          $stmt->bind_result($mid1, $term1, $mid2, $term2);
          while ($stmt->fetch()) {
            $this->rapotSiswa($id, $mid1, $term1, $mid2, $term2);
          }
        }
        else {
          $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
          $sql = "INSERT INTO report (id_report, nik, id_kelas, mid1, term1, mid2, term2)
                  VALUES(null, '$id', '$kelas', null, null, null, null)";
          if ($query = $mysqli->query($sql)) {
            $this->getSiswaReportData($id);
          }
          else {
            echo "bullshit";
          }
        }

        $stmt->close();
      }
      else {
        echo "sql salah";
      }

      $mysqli->close();
      unset($sql, $stmt, $mysqli);
    }

    private function rapotSiswa($id, $mid1, $term1, $mid2, $term2){
      ?>
      <table>
        <tr>
          <th>Mid 1</th>
          <th>Semester 1</th>
          <th>Mid 2</th>
          <th>Semester 2</th>
        </tr>
        <tr>
          <td>
            <?php
              if ($mid1 == null) {
                echo "<a href='formUpload.php?id=".$id."&rapot=mid1'>upload</a>";
              }
              else {
                echo "<a href='rapot/".$mid1."' target='_blank'>Hasil</a>";
              }
            ?>
          </td>
          <td>
            <?php
              if ($term1 == null) {
                echo "<a href='formUpload.php?id=".$id."&rapot=term1'>upload</a>";
              }
              else {
                echo "<a href='rapot/".$term1."' target='_blank'>Hasil</a>";
              }
            ?>
          </td>
          <td>
            <?php
              if ($mid2 == null) {
                echo "<a href='formUpload.php?id=".$id."&rapot=mid2'>upload</a>";
              }
              else {
                echo "<a href='rapot/".$mid2."' target='_blank'>Hasil</a>";
              }
            ?>
          </td>
          <td>
            <?php
              if ($term2 == null) {
                echo "<a href='formUpload.php?id=".$id."&rapot=term2'>upload</a>";
              }
              else {
                echo "<a href='rapot/".$term2."' target='_blank'>Hasil</a>";
              }
            ?>
          </td>
        </tr>
      </table>
      <?php
    }

    public function uploadRapot($id, $rapot, $targetFolder){
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $targetFolder = $targetFolder.".pdf";

      $sql = "UPDATE report SET
              $rapot=?
              WHERE id_report=?";
      if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("si", $targetFolder, $id);
        $stmt->execute();
        if ($stmt->affected_rows == 1) {
          echo "berhasil";
        }
        else {
          echo "execute gagal";
        }
      }
      else {
        echo "prepare gagal";
      }
    }
  }
?>
