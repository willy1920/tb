<?php
  include 'db.php';
  include "../PHPMailer-master/src/PHPMailer.php";
  include "../PHPMailer-master/src/Exception.php";

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
              echo '<select id="kelas">';
              while ($row = $query->fetch_array(MYSQLI_NUM)) {
                ?>
                <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                <?php
              }
              echo '</select>';
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
              echo "<select id='email'>";
              while ($row = $query->fetch_array(MYSQLI_NUM)) {
                ?>
                <option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
                <?php
              }
              echo "</select>";
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

    public function dashboardOrtu(){
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $sql = "SELECT email FROM ortu";
      if ($query = $mysqli->query($sql)) {
        echo "<img class='icon' src='../icon/add.png' onclick='tambahOrtuDashboard()'>";
        echo "<table>";
        while ($row = $query->fetch_array(MYSQLI_NUM)) {
          ?>
          <tr>
            <td><?php echo $row[0]; ?></td>
            <td><img class='icon' src='../icon/delete.png' onclick='hapusOrtu("<?php echo $row[0]; ?>")'></td>
          </tr>
          <?php
        }
        echo "</table>";
      }
    }

    public function tambahOrtuDashboard(){
      ?>
      <table>
        <tr>
          <td>Email</td>
          <td>:</td>
          <td><input type="email" id="email"></td>
        </tr>
        <tr>
          <td><button onclick="tambahOrtu()">Submit</button></td>
        </tr>
      </table>
      <?php
    }

    public function tambahOrtu($email){
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $pass = "0";
      $activated = 0;
      $sql = "INSERT INTO ortu (email, pass, activated) VALUES(?, ?, ?)";
      if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ssi", $email, $pass, $activated);
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

    public function hapusOrtu($email){
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $sql = "DELETE FROM ortu WHERE email='$email'";
      if ($query = $mysqli->query($sql)) {
        echo "1";
      }
      else{
        "Delete failed";
      }
    }

    public function dashboardGuru(){
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $sql = "SELECT 
              guru.email_guru,
              guru.nama_guru,
              guru.id_kelas,
              kelas.nama_kelas
              FROM guru
              INNER JOIN kelas
              ON guru.id_kelas = kelas.id_kelas";
      if ($query = $mysqli->query($sql)) {
        echo "<h1>Managemen Guru</h1>";
        echo "<img class='icon' src='../icon/add.png' onclick='tambahGuruDashboard()'>";
        echo "<table>";
        while ($row = $query->fetch_array(MYSQLI_NUM)) {
          ?>
          <tr>
          <td><?php echo $row[1]; ?></td>
          <td><?php echo $row[3]; ?></td>
          <td><img class='icon' src='../icon/edit.png' onclick='ubahGuruDashboard("<?php echo $row[0]; ?>","<?php echo $row[1]; ?>","<?php echo $row[2]; ?>")'></td>
          <td><img class='icon' src='../icon/delete.png' onclick='hapusGuru("<?php echo $row[0]; ?>")'></td>
          </tr>
          <?php
        }
        echo "</table>";
      }
    }

    public function tambahGuruDashboard(){
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $sql = "SELECT * FROM kelas";
      $query = $mysqli->query($sql);
      ?>
      <table>
        <tr>
          <td>Email</td>
          <td>:</td>
          <td><input type="text" id="email"></td>
        </tr>
        <tr>
          <td>Nama</td>
          <td>:</td>
          <td><input type="text" id="nama"></td>
        </tr>
        <tr>
          <td>Kelas</td>
          <td>:</td>
          <td>
            <select id="kelas">
              <?php
              while($row = $query->fetch_array(MYSQLI_NUM)){
                echo "<option value='". $row[0]."'>".$row[1]."</option>";
              }
              ?>              
            </select>
          </td>
        </tr>
        <tr>
          <td><button onclick="tambahGuru()">Submit</button></td>
        </tr>
      </table>
      <?php
    }

    public function tambahGuru($email, $nama, $kelas){
      $status = 1;
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $sql = "INSERT INTO guru (email_guru, nama_guru, id_kelas, status)
              VALUES(?, ?, ?, ?)";
      if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ssii", $email, $nama, $kelas, $status);
        $stmt->execute();
        if ($stmt->affected_rows == 1) {
          $stmt->close();
          $this->tambahUser($email, 1);
        }
        else{
          echo "Execute failed";
        }
      }
      else{
        echo "Prepare failed";
      }
      $mysqli->close();
      unset($status, $sql, $mysqli, $stmt, $email, $nama, $kelas);
    }

    public function ubahGuruDashboard($email, $nama, $kelas){
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $sql = "SELECT * FROM kelas";
      $query = $mysqli->query($sql);
      ?>
      <table>
        <tr>
          <td>Email</td>
          <td>:</td>
          <td><input type="email" id="email" value="<?php echo $email; ?>" disabled></td>
        </tr>
        <tr>
          <td>Nama</td>
          <td>:</td>
          <td><input type="text" id="nama" value="<?php echo $nama; ?>"></td>
        </tr>
        <tr>
          <td>Kelas</td>
          <td>:</td>
          <td>
            <select id="kelas">
              <?php
              while($row = $query->fetch_array(MYSQLI_NUM)){
                if ($row[0] == $kelas) {
                  echo '<option value="'.$row[0].'" selected>'.$row[1].'</selected>';
                }
                else{
                  echo '<option value="'.$row[0].'">'.$row[1].'</selected>';
                }
              }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td><button onclick="ubahGuru()">Submit</button></td>
        </tr>
      </table>
      <?php
    }

    public function ubahGuru($email, $nama, $kelas){
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $sql = "UPDATE guru SET 
              nama_guru=?,
              id_kelas=?
              WHERE email_guru=?";
      if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("sis", $nama, $kelas, $email);
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

    public function hapusGuru($email){
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $sql = "DELETE FROM guru WHERE email_guru='$email'";
      if ($query = $mysqli->query($sql)) {
        $this->deleteUser($email);
      }
      else{
        "Delete failed";
      }
      $mysqli->close();
      unset($mysqli, $sql, $query);
    }

    function randomPassword() {
      $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
      $pass = array(); //remember to declare $pass as an array
      $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
      for ($i = 0; $i < 8; $i++) {
          $n = rand(0, $alphaLength);
          $pass[] = $alphabet[$n];
      }
      return implode($pass); //turn the array into a string
    }

    function tambahUser($email, $status){

      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $sql = "INSERT INTO user(user, pass, status)
              VALUES(?, ?, ?)";
      $pass = $this->randomPassword();
      $newPass = sha1($pass);

      if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ssi", $email, $newPass, $status);
        $stmt->execute();
        if ($stmt->affected_rows == 1) {
          try{
            $message = 'User : '.$email.'\nPass : '.$pass.'\nPlease do not reply to this email\nTolong jangan balas email ini';

            $mail = new PHPMailer(true);
            $mail->SMTpDebug = 2;
            $mail->isSMTP();
            $mail->Host = "smtp.stromzivota.web.id";
            $mail->Username = "system@stromzivota.web.id";
            $mail->Password = "J21Afdn4!";
            $mail->SMTPSecure = 'tls';
            $mail->Port = '465';

            $mail->setFrom('system@stromzivota.web.id', 'Mailer');
            $mail->isHTML(true);
            $mail->Subject = 'Account Tunas Bangsa';
            $mail->Body = $message;
            $mail->AltBody = $message;

            $mail->send();
            echo "1";
          } catch (Exception $e){
            echo "Message failed";
          }
        }
        else{
          echo "Execute failed";
        }
      }
      else{
        echo "Prepare failed";
      }
      
    }

    function deleteUser($email){
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $sql = "DELETE FROM user WHERE user='$email'";
      $query = $mysqli->query($sql);
      if ($query) {
        echo "1";
      }
      else{
        echo "Delete user failed";
      }
      $mysqli->close();
      unset($sql, $query, $mysqli);
    }
  }

?>
