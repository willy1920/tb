<?php
  include 'db.php';

  class Guru extends Database{

    public function getSiswa(){
      $this->getIdKelas();
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $sql = "SELECT nik, nama FROM siswa WHERE id_kelas='".$_SESSION['kelas']."'";
      $query = $mysqli->query($sql);
      if ($query->num_rows > 0) {
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
          echo "<div onclick='dashboardSiswa(".$row['nik'].")'>".$row['nama']."</div>";
        }
      }
    }

    public function getIdKelas(){
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $sql = "SELECT * FROM guru WHERE email_guru='".$_SESSION['user']."'";
      $query = $mysqli->query($sql);
      if ($query->num_rows == 1) {
        $row = $query->fetch_array(MYSQLI_NUM);
        $_SESSION['nama'] = $row[1];
        $_SESSION['kelas'] = $row[2];
      }
      else {
        echo "Homebase teacher not found";
      }

      $mysqli->close();
      unset($mysqli, $sql, $query, $row);
    }

    public function getSiswaReportData($id){
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $kelas = $_SESSION['kelas'];
      $sql = "SELECT id_report, mid1, term1, mid2, term2 FROM report WHERE nik=? AND id_kelas=?";
      if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ii", $id, $kelas);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
          $stmt->bind_result($idReport, $mid1, $term1, $mid2, $term2);
          ?>
          <table>
            <tr>
              <th>Mid 1</th>
              <th>Semester 1</th>
              <th>Mid 2</th>
              <th>Semester 2</th>
            </tr>
          <?php
          while ($stmt->fetch()) {
            $this->rapotSiswa($idReport, $mid1, $term1, $mid2, $term2);
          }
          ?>
          </table>
          <?php
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
        <tr>
          <td>
            <?php
              if ($mid1 == null) {
                echo "<a href='formUpload.php?id=".$id."&rapot=mid1' target='_blank'>upload</a>";
              }
              else {
                echo "<a href='rapot/".$mid1."' target='_blank'>Hasil</a>";
              }
            ?>
          </td>
          <td>
            <?php
              if ($term1 == null) {
                echo "<a href='formUpload.php?id=".$id."&rapot=term1' target='_blank'>upload</a>";
              }
              else {
                echo "<a href='rapot/".$term1."' target='_blank'>Hasil</a>";
              }
            ?>
          </td>
          <td>
            <?php
              if ($mid2 == null) {
                echo "<a href='formUpload.php?id=".$id."&rapot=mid2' target='_blank'>upload</a>";
              }
              else {
                echo "<a href='rapot/".$mid2."' target='_blank'>Hasil</a>";
              }
            ?>
          </td>
          <td>
            <?php
              if ($term2 == null) {
                echo "<a href='formUpload.php?id=".$id."&rapot=term2' target='_blank'>upload</a>";
              }
              else {
                echo "<a href='rapot/".$term2."' target='_blank'>Hasil</a>";
              }
            ?>
          </td>
        </tr>
      <?php
    }

    public function uploadRapot($id, $rapot, $targetFolder){
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $targetFolder = $targetFolder.".pdf";

      $sql = "UPDATE report SET
              `$rapot`=?
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

    public function changePasswordDashboard(){
      ?>
      <table>
        <tr>
          <td>Email</td>
          <td>:</td>
          <td><input type="email" value="<?php echo $_SESSION['user']; ?>" id="email"></td>
        </tr>
        <tr>
          <td>Password</td>
          <td>:</td>
          <td><input type="password" onkeyup="return passwordChecker(1);" id='password1'></td>
          <td><span id="strength1">Type Password</span></td>
        </tr>
        <tr>
          <td>Password (Again)</td>
          <td>:</td>
          <td><input type="password" onkeyup="passwordValue()" id="password2"></td>
          <td><span id="check"></span></td>
        </tr>
        <tr>
          <td colspan="4"><button onclick='changePassword()'>Submit</button></td>
        </tr>
      </table>
      <?php
    }

    public function changePassword($email, $pass){
      $pass = sha1($pass);

      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $sql = "UPDATE user SET user=?, pass=? WHERE user=?";
      if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("sss", $email, $pass, $_SESSION['user']);;
        $stmt->execute();
        if ($stmt->affected_rows == 1) {
          echo "1";
        }
        else{
          echo "Execute failed";
        }
      }
      else{
        echo "Prepare failed";
      }
    }
  }
?>
