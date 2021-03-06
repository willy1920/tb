<?php
  include 'db.php';
  include "../PHPMailer-master/src/PHPMailer.php";
  include "../PHPMailer-master/src/Exception.php";
  include "../PHPMailer-master/src/SMTP.php";


  class Admin extends Database{
    public function dashboardKelas(){
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $sql = "SELECT id_kelas, nama_kelas FROM kelas";
      if ($query = $mysqli->query($sql)) {
        echo "<img class='icon' src='../icon/add.png' onclick='tambahKelasDashboard()'>";
        echo "<img class='icon' src='../icon/excel.svg' onclick='showDashboardUploadExcelClass()'>";
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
                kelas.nama_kelas,
                siswa.paid
                FROM siswa
                INNER JOIN kelas
                ON siswa.id_kelas = kelas.id_kelas";
      if ($query = $mysqli->query($sql)) {
        echo "<img class='icon' src='../icon/add.png' onclick='tambahMuridDashboard()'>";
        echo "<img class='icon' src='../icon/excel.svg' onclick='showDashboardUploadExcelStudent()'>";
        echo "<table>";
        echo "<tr>";
        echo "<th>Nama</th>";
        echo "<th>Orang Tua</th>";
        echo "<th>Kelas</th>";
        echo "<th>SPP</th>";
        echo "</tr>";
        while ($row = $query->fetch_array(MYSQLI_NUM)) {
          ?>
          <tr>
          <td><?php echo $row[1]; ?></td>
          <td><?php echo $row[2]; ?></td>
          <td><?php echo $row[3]; ?></td>
          <td><?php echo $row[4] == 1 ? "Lunas": "Tidak Lunas" ?></td>
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
            <select id="kelas">
            <?php
              $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
              $sql = "SELECT * FROM kelas";
              $query = $mysqli->query($sql);
              if($query){
                while ($row = $query->fetch_array(MYSQLI_NUM)) {
                  if ($row[1] == $kelas) {
                    ?>
                      <option value="<?php echo $row[0]; ?>" selected><?php echo $row[1]; ?></option>
                    <?php
                  }
                  else {
                    ?>
                      <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
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
            </select>
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
              echo '<select id="email">';
              while ($row = $query->fetch_array(MYSQLI_NUM)) {
                if ($row[0] == $user) {
                  ?>
                  <option value="<?php echo $row[0]; ?>" selected><?php echo $row[0]; ?></option>
                  <?php
                }
                else {
                  ?>
                  <option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
                  <?php
                }
              }
              echo '</select>';
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
        echo "<img class='icon' src='../icon/excel.svg' onclick='showDashboardUploadExcelParent()'>";
        echo "<table>";
        while ($row = $query->fetch_array(MYSQLI_NUM)) {
          ?>
          <tr>
            <td><?php echo $row[0]; ?></td>
            <td><img class='icon' src='../icon/resetPass.png' onclick='resetPassParent("<?php echo $row[0]; ?>")'></td>
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
      $pass = $this->randomPassword();
      $newPass = sha1($pass);
      $sql = "INSERT INTO ortu (email, pass) VALUES(?, ?)";
      if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ss", $email, $newPass);
        $stmt->execute();
        if ($stmt->affected_rows == 1) {
          try{
            $messageHTML = 'User : '.$email.'<br>Pass : '.$pass.'<br>Please do not reply to this email<br>Tolong jangan balas email ini';
            $message = "User : ".$email."\nPass : ".$pass."\nPlease do not reply to this email\nTolong jangan balas email ini";

            $mail = new PHPMailer\PHPMailer\PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPDebug = 0;
            $mail->SMTPAuth = true;
            $mail->Host = $this->hostEmail;
            $mail->Username = $this->emailUser;
            $mail->Password = $this->emailPass;
            $mail->SMTPSecure = $this->SMTPSecure;
            $mail->Port = $this->Port;

            $mail->setFrom('system@stromzivota.web.id', 'System Tunas Bangsa');
            $mail->addAddress($email, "");
            $mail->isHTML(true);
            $mail->Subject = 'Account Tunas Bangsa';
            $mail->Body = $messageHTML;
            $mail->AltBody = $message;

            if ($mail->send()) {
              echo "1";
            }
            else{
              echo "Email not send : ".$mail->ErrorInfo;
            }
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
        echo "<img class='icon' src='../icon/excel.svg' onclick='showDashboardUploadExcelTeacher()'>";
        echo "<table>";
        while ($row = $query->fetch_array(MYSQLI_NUM)) {
          ?>
          <tr>
          <td><?php echo $row[1]; ?></td>
          <td><?php echo $row[3]; ?></td>
            <td><img class='icon' src='../icon/resetPass.png' onclick='resetPassTeacher("<?php echo $row[0]; ?>")'></td>
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

    public function excelTeacherToDatabase($email, $name, $class){
      $id;
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $sql = "SELECT id_kelas FROM kelas WHERE nama_kelas=?";
      if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("s", $class);
        $stmt->execute();
        $stmt->bind_result($id_kelas);

        while($stmt->fetch()){
          $id = $id_kelas;
        }
        $stmt->close();
        $mysqli->close();

        $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
        $sql = "INSERT INTO guru (email_guru, nama_guru, id_kelas, status) VALUES(?, ?, ?, ?)";
        if ($stmt = $mysqli->prepare($sql)) {
          $status = 1;
          $stmt->bind_param("ssii", $email, $name, $id, $status);
          $stmt->execute();
          if ($stmt->affected_rows == 1) {
            $this->tambahUser($email, 1);
          }
          else{
            echo "Execute insert teacher failed";
          }
        }
        else{
          echo "Prepare insert teacher failed";
        }
      }
      else{
        echo "Prepare select class failed";
      }

      $stmt->close();
      $mysqli->close();
    }

    public function excelParentToDatabase($email){
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $pass = $this->randomPassword();
      $newPass = sha1($pass);
      $sql = "INSERT INTO ortu (email, pass) VALUES(?, ?)";
      if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ss", $email, $newPass);
        $stmt->execute();
        if ($stmt->affected_rows == 1) {
          try{
            $messageHTML = 'User : '.$email.'<br>Pass : '.$pass.'<br>Please do not reply to this email<br>Tolong jangan balas email ini';
            $message = "User : ".$email."\nPass : ".$pass."\nPlease do not reply to this email\nTolong jangan balas email ini";

            $mail = new PHPMailer\PHPMailer\PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPDebug = 0;
            $mail->SMTPAuth = true;
            $mail->Host = $this->hostEmail;
            $mail->Username = $this->emailUser;
            $mail->Password = $this->emailPass;
            $mail->SMTPSecure = $this->SMTPSecure;
            $mail->Port = $this->Port;

            $mail->setFrom($this->emailUser, 'System Tunas Bangsa');
            $mail->addAddress($email, "");
            $mail->isHTML(true);
            $mail->Subject = 'Parent Account Tunas Bangsa';
            $mail->Body = $messageHTML;
            $mail->AltBody = $message;

            if ($mail->send()) {
              echo "1";
            }
            else{
              echo "Email not send : ".$mail->ErrorInfo;
            }
          } catch (Exception $e){
            echo "Message add user failed";
          }
        }
      }
    }

    public function showDashboardUploadExcel(){
      ?>
      <input type="file" id='excel'>
      <div id='output'></div>
      <?php
    }

    public function getParentAndClass(){
      $json = '{"Class":[';
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $sql = "SELECT id_kelas, nama_kelas FROM kelas";
      if ($stmt = $mysqli->prepare($sql)) {
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($idKelas, $namaKelas);
        $rows = $stmt->num_rows;
        $count = 1;

        while($stmt->fetch()){
          if ($count != $rows) {
            $json .= '{"id":"'.$idKelas.'","name":"'.$namaKelas.'"},';
          }
          else{
            $json .= '{"id":"'.$idKelas.'","name":"'.$namaKelas.'"}';
          }
          $count++;
        }
        $json .= ']';

        $stmt->free_result();
        $stmt->close();
        
        $sql = "SELECT email FROM ortu";
        if ($stmt = $mysqli->prepare($sql)) {
          $stmt->execute();
          $stmt->store_result();
          $stmt->bind_result($emailParent);
          $rows = $stmt->num_rows;
          $count = 1;

          $json .= ',"Email":[';

          while ($stmt->fetch()) {
            if ($count != $rows) {
              $json .= '{"Parent":"'.$emailParent.'"},';
            }
            else{
              $json .= '{"Parent":"'.$emailParent.'"}';
            }
            $count++;
          }
          $json .= ']';

          $json .= '}';
          echo $json;
        }

      }
    }

    public function excelStudentToDatabase($nik, $name, $class, $parent, $paid){
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
      $sql = "INSERT INTO siswa (nik, nama, id_kelas, user, paid)
              VALUES(?, ?, ?, ?, ?)";
      if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ssisi", $nik, $name, $class, $parent, $paid);
        $stmt->execute();
        if ($stmt->affected_rows == 1) {
          $stmt->close();
          
          $sql = "INSERT INTO report (nik, id_kelas)
                  VALUES(?, ?)";
          
          if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("si", $nik, $class);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
              echo "1";
            }
            else{
              echo "Execute report failed";
            }
          }
          else{
            echo "Prepare report failed";
          }
        }
        else{
          echo "Execute student failed";
        }
      }
      else{
        echo "Prepare student failed";
      }
      $mysqli->close();
    }

    public function resetPassParent($id){
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);

      $pass = $this->randomPassword();
      $newPass = sha1($pass);

      $sql = "UPDATE ortu SET pass=? WHERE email=?";
      if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ss", $newPass, $id);
        $stmt->execute();
        if ($stmt->affected_rows == 1) {
          try{
            $messageHTML = '<h1>Reset Password</h1><br>User : '.$id.'<br>Pass : '.$pass.'<br>Please do not reply to this email<br>Tolong jangan balas email ini';
            $message = "Reset Password\nUser : ".$id."\nPass : ".$pass."\nPlease do not reply to this email\nTolong jangan balas email ini";

            $mail = new PHPMailer\PHPMailer\PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPDebug = 0;
            $mail->SMTPAuth = true;
            $mail->Host = $this->hostEmail;
            $mail->Username = $this->emailUser;
            $mail->Password = $this->emailPass;
            $mail->SMTPSecure = $this->SMTPSecure;
            $mail->Port = $this->Port;

            $mail->setFrom($this->emailUser, 'System Tunas Bangsa');
            $mail->addAddress($id, "");
            $mail->isHTML(true);
            $mail->Subject = 'Parent Account Tunas Bangsa';
            $mail->Body = $messageHTML;
            $mail->AltBody = $message;

            if ($mail->send()) {
              echo "1";
            }
            else{
              echo "Email not send : ".$mail->ErrorInfo;
            }
          } catch (Exception $e){
            echo "Message add user failed";
          }
        }
        else{
          echo "Execute update failed";
        }
      }
      else{
        echo "Prepare update failed";
      }
    }

    public function resetPassTeacher($id){
      $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);

      $pass = $this->randomPassword();
      $newPass = sha1($pass);

      $sql = "UPDATE user SET pass=? WHERE user=?";
      if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ss", $newPass, $id);
        $stmt->execute();
        if ($stmt->affected_rows == 1) {
          try{
            $messageHTML = '<h1>Reset Password</h1><br>User : '.$id.'<br>Pass : '.$pass.'<br>Please do not reply to this email<br>Tolong jangan balas email ini';
            $message = "Reset Password\nUser : ".$id."\nPass : ".$pass."\nPlease do not reply to this email\nTolong jangan balas email ini";

            $mail = new PHPMailer\PHPMailer\PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPDebug = 0;
            $mail->SMTPAuth = true;
            $mail->Host = $this->hostEmail;
            $mail->Username = $this->emailUser;
            $mail->Password = $this->emailPass;
            $mail->SMTPSecure = $this->SMTPSecure;
            $mail->Port = $this->Port;

            $mail->setFrom($this->emailUser, 'System Tunas Bangsa');
            $mail->addAddress($id, "");
            $mail->isHTML(true);
            $mail->Subject = 'Teacher Account Tunas Bangsa';
            $mail->Body = $messageHTML;
            $mail->AltBody = $message;

            if ($mail->send()) {
              echo "1";
            }
            else{
              echo "Email not send : ".$mail->ErrorInfo;
            }
          } catch (Exception $e){
            echo "Message add user failed";
          }
        }
        else{
          echo "Execute update failed";
        }
      }
      else{
        echo "Prepare update failed";
      }
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
            $messageHTML = 'User : '.$email.'<br>Pass : '.$pass.'<br>Please do not reply to this email<br>Tolong jangan balas email ini';
            $message = "User : ".$email."\nPass : ".$pass."\nPlease do not reply to this email\nTolong jangan balas email ini";

            $mail = new PHPMailer\PHPMailer\PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPDebug = 0;
            $mail->SMTPAuth = true;
            $mail->Host = $this->hostEmail;
            $mail->Username = $this->emailUser;
            $mail->Password = $this->emailPass;
            $mail->SMTPSecure = $this->SMTPSecure;
            $mail->Port = $this->Port;

            $mail->setFrom($this->emailUser, 'System Tunas Bangsa');
            $mail->addAddress($email, "");
            $mail->isHTML(true);
            $mail->Subject = 'Account Tunas Bangsa';
            $mail->Body = $messageHTML;
            $mail->AltBody = $message;

            if ($mail->send()) {
              echo "1";
            }
            else{
              echo "Email not send : ".$mail->ErrorInfo;
            }
          } catch (Exception $e){
            echo "Message add user failed";
          }
        }
        else{
          echo "Execute add user failed";
        }
      }
      else{
        echo "Prepare add user failed";
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
