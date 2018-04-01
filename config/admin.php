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
          <td><img class='icon' src='../icon/delete.png' onclick='hapusKelas()'></td>
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
  }

?>
