<?php
    include "db.php";

    class Parentt extends Database{
        public function dashboard(){
            $email = $_SESSION['email'];
            $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
            $sql = "SELECT 
                    siswa.nik,
                    siswa.nama,
                    kelas.nama_kelas
                    FROM siswa
                    INNER JOIN ortu
                    ON siswa.user = ortu.email
                    INNER JOIN kelas
                    ON siswa.id_kelas = kelas.id_kelas
                    WHERE siswa.user = '$email'";
            if($query = $mysqli->query($sql)){
                ?>
                <table>
                    <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                    </tr>
                <?php
                while ($row = $query->fetch_array(MYSQLI_NUM)) {
                    ?>
                    <tr onclick='dashboardReport(<?php echo $row[0]; ?>)'>
                        <td onclick='dashboardReport(<?php echo $row[0]; ?>)'><?php echo $row[0]; ?></td>
                        <td onclick='dashboardReport(<?php echo $row[0]; ?>)'><?php echo $row[1]; ?></td>
                        <td onclick='dashboardReport(<?php echo $row[0]; ?>)'><?php echo $row[2]; ?></td>
                    </tr>
                    <?php
                }
                ?>
                </table>
                <?php
            }
            else {
                echo "Query failed";
            }

        }

        public function dashboardReport($nik){
            $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
            $sql = "SELECT 
                        report.mid1,
                        report.term1,
                        report.mid2,
                        report.term2,
                        kelas.nama_kelas
                        FROM report
                        INNER JOIN kelas
                        ON report.id_kelas = kelas.id_kelas
                        WHERE report.nik='$nik'";
            $query = $mysqli->query($sql);
            if ($query) {
                ?>
                <table>
                    <tr>
                        <th>Kelas</th>
                        <th>First Mid Semester</th>
                        <th>First Semester</th>
                        <th>Second Mid Semester</th>
                        <th>Second Semester</th>
                    </tr>
                <?php
                while($row = $query->fetch_array(MYSQLI_NUM)){
                    echo "<tr>";
                    echo "<td>".$row[4]."</td>";
                    for ($i=0; $i < 4; $i++) { 
                        if ($row[$i] != NULL) {
                            echo "<td><a href='rapot/".$row[$i]."' target='_blank'>Hasil</a></td>";
                        }
                        else{
                            echo "<td>Not yet</td>";
                        }
                    }
                    echo "</tr>";
                }
                ?>
                </table>
                <?php
            }
            else{
                echo "Query failed";
            }
        }

        public function changePasswordDashboard(){
            ?>
            <table>
                <tr>
                <td>Email</td>
                <td>:</td>
                <td><input type="email" value="<?php echo $_SESSION['email']; ?>" id="email" disabled></td>
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
        
        public function changePassword($pass){
            $pass = sha1($pass);

            $mysqli = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
            $sql = "UPDATE ortu SET pass=? WHERE email=?";
            if ($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param("ss", $pass, $_SESSION['email']);;
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