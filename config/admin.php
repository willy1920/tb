<?php
  include 'db.php';

  class Admin extends Database{
    public function dashboardKelas(){
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $sql = "SELECT id_kelas, nama_kelas FROM kelas";
      if ($query = $mysqli->query($sql)) {
        echo "<img class='icon' src='../icon/add.png' onclick='tambahKelasDashboard()'>";
        echo "<table>";
        while ($row = $query->fetch_array(MYSQLI_NUM)) {
          ?>
          <tr>
          <td><?php echo $row[1]; ?></td>
          <td><img class='icon' src='../icon/edit.png' onclick='ubahKelasDashboard(<?php echo $row[0]; ?>,"<?php echo $row[1]; ?>")'></td>
          <td><img class='icon' src='../icon/delete.png' onclick='hapusKelas(<?php echo $row[0]; ?>)'></td>
          </tr>
          <?php
        }
        echo "</table>";
      }
    }

    public function tambahKelasDashboard(){
      ?>
      <table>
        <tr>
          <td>Nama</td>
          <td>:</td>
          <td><input type="text" id="nama"></td>
        </tr>
        <tr>
          <td><button onclick="tambahKelas()">Submit</button></td>
        </tr>
      </table>
      <?php
    }

    public function tambahKelas($nama){
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $sql = "INSERT INTO kelas (nama_kelas) VALUES(?)";
      if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("s", $nama);
        $stmt->execute();
        if ($stmt->affected_rows == 1) {
          echo "1";
        }
        else {
          echo "gagal execute";
        }
      }
      else {
        echo "prepare failed";
      }
    }

    public function hapusKelas($id){
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $sql = "DELETE FROM kelas WHERE id_kelas=?";
      if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        if ($stmt->affected_rows == 1) {
          echo "1";
        }
        else {
          echo "Execute failed";
        }
      }
      else {
        echo "Prepare failed";
      }
    }

    public function ubahKelasDashboard($id, $nama){
      ?>
      <input type="hidden" value="<?php echo $id; ?>" id="id">
      <table>
        <tr>
          <td>Nama</td>
          <td>:</td>
          <td><input type="text" id="nama" value="<?php echo $nama; ?>"></td>
        </tr>
        <tr>
          <td><button onclick="ubahKelas()">Submit</button></td>
        </tr>
      </table>
      <?php
    }

    public function ubahKelas($id, $nama){
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $sql = "UPDATE kelas SET nama_kelas=? WHERE id_kelas=?";
      if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("si", $nama, $id);
        $stmt->execute();
        if ($stmt->affected_rows == 1) {
          echo "1";
        }
        else {
          echo "Execute failed";
        }
      }
      else {
        echo "Prepare failed";
      }
    }

    public function dashboardMurid(){
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $sql = "SELECT 
                siswa.nik,
                siswa.nama,
                siswa.user,
                kelas.nama_kelas
                FROM siswa
                INNER JOIN kelas
                ON siswa.id_kelas = kelas.id_kelas";
      if ($query = $mysqli->query($sql)) {
        echo "<img class='icon' src='../icon/add.png' onclick='tambahMuridDashboard()'>";
        echo "<table>";
        while ($row = $query->fetch_array(MYSQLI_NUM)) {
          ?>
          <tr>
          <td><?php echo $row[1]; ?></td>
          <td><?php echo $row[2]; ?></td>
          <td><?php echo $row[3]; ?></td>
          <td><img class='icon' src='../icon/edit.png' onclick='ubahMuridDashboard(<?php echo $row[0]; ?>,"<?php echo $row[1]; ?>","<?php echo $row[2]; ?>","<?php echo $row[3]; ?>")'></td>
          <td><img class='icon' src='../icon/delete.png' onclick='hapusMurid(<?php echo $row[0]; ?>)'></td>
          </tr>
          <?php
        }
        echo "</table>";
      }
      else {
        echo "query gagal";
      }
    }

    public function tambahMuridDashboard(){
      ?>
      <table>
        <tr>
          <td>NIK</td>
          <td>:</td>
          <td><input type="text" id="nik" require></td>
        </tr>
        <tr>
          <td>Nama</td>
          <td>:</td>
          <td><input type="text" id="nama" require></td>
        </tr>
        <tr>
          <td>Kelas</td>
          <td>:</td>
          <td>
          <?php
            $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
            $sql = "SELECT * FROM kelas";
            $query = $mysqli->query($sql);
            if($query){
              while ($row = $query->fetch_array(MYSQLI_NUM)) {
                ?>
                <select id="kelas">
                  <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                </select>
                <?php
              }
              $mysqli->close();
              unset($mysqli, $sql, $query, $row);
            }
            else {
              echo "gagal";
            }
          ?>
        </tr>
        <tr>
          <td>Email orang tua</td>
          <td>:</td>
          <td>
          <?php
            $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
            $sql = "SELECT email FROM ortu";
            $query = $mysqli->query($sql);
            if($query){
              while ($row = $query->fetch_array(MYSQLI_NUM)) {
                ?>
                <select id="email">
                  <option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
                </select>
                <?php
              }
              $mysqli->close();
              unset($mysqli, $sql, $query, $row);
            }
            else {
              echo "gagal";
            }
          ?>
          </td>
        </tr>
        <tr>
          <td><button onclick="tambahMurid()">Submit</button></td>
        </tr>
      </table>
      <?php
    }

    public function tambahMurid($nik, $nama, $kelas, $email){
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $sql = "INSERT INTO siswa (nik, nama, id_kelas, user)
              VALUES(?, ?, ?, ?)";
      if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("isis", $nik, $nama, $kelas, $email);
        $stmt->execute();
        if ($stmt->affected_rows == 1) {
          echo "berhasil";
        }
        else {
          echo "execute gagal";
        }
      }
      else{
        echo "prepare gagal";
      }
    }

    public function ubahMuridDashboard($id, $nama, $user, $kelas){
      ?>
      <table>
        <tr>
          <td>NIK</td>
          <td>:</td>
          <td><label id='nik'><?php echo $id; ?></label></td>
        </tr>
        <tr>
          <td>Nama</td>
          <td>:</td>
          <td><input type="text" id="nama" value='<?php echo $nama ?>' require></td>
        </tr>
        <tr>
          <td>Kelas</td>
          <td>:</td>
          <td>
          <?php
            $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
            $sql = "SELECT * FROM kelas";
            $query = $mysqli->query($sql);
            if($query){
              while ($row = $query->fetch_array(MYSQLI_NUM)) {
                if ($row[0] == $kelas) {
                  ?>
                  <select id="kelas">
                    <option value="<?php echo $row[0]; ?>" selected><?php echo $row[1]; ?></option>
                  </select>
                  <?php
                }
                else {
                  ?>
                  <select id="kelas">
                    <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                  </select>
                  <?php
                }
              }
              $mysqli->close();
              unset($mysqli, $sql, $query, $row);
            }
            else {
              echo "gagal";
            }
          ?>
        </tr>
        <tr>
          <td>Email orang tua</td>
          <td>:</td>
          <td>
          <?php
            $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
            $sql = "SELECT email FROM ortu";
            $query = $mysqli->query($sql);
            if($query){
              while ($row = $query->fetch_array(MYSQLI_NUM)) {
                if ($row[0] == $user) {
                  ?>
                <select id="email">
                  <option value="<?php echo $row[0]; ?>" selected><?php echo $row[0]; ?></option>
                </select>
                <?php
                }
                else {
                  ?>
                  <select id="email">
                    <option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
                  </select>
                  <?php
                }
              }
              $mysqli->close();
              unset($mysqli, $sql, $query, $row);
            }
            else {
              echo "gagal";
            }
          ?>
          </td>
        </tr>
        <tr>
          <td><button onclick="ubahMurid()">Submit</button></td>
        </tr>
      </table>
      <?php
    }

    public function ubahMurid($id, $nama, $kelas, $user){
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $sql = "UPDATE siswa SET nama=?, id_kelas=?, user=? WHERE nik=?";
      if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("sisi", $nama, $kelas, $user, $id);
        $stmt->execute();
        if ($stmt->affected_rows == 1) {
          echo "1";
        }
        else {
          echo "Execute failed";
        }
      }
      else {
        echo "Prepare failed";
      }
    }

    public function hapusMurid($id){
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $sql = "DELETE FROM siswa WHERE nik='$id'";
      if ($query = $mysqli->query($sql)) {
        echo "1";
      }
      else{
        echo "Failed";
      }
    }
  }

?>
