<?php
    include "db.php";

    class Parentt extends Database{
        public function dashboard(){
            session_start();

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
    }
    
?>