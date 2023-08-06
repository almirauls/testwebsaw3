<!-- proses perangkingan -->
<?php
require "config.php";
// $tgl_jadwal='';
$ada=0;

if(isset($_GET['tgl_jadwal'])){

// mengambil data tanggal dari input
    $tgl_jadwal=$_GET["tgl_jadwal"];
    $sql = "SELECT*FROM penjadwalan WHERE tgl_jadwal='".$tgl_jadwal."'";
    $result = $conn->query($sql);
        
    if ($result->num_rows > 0) {
            $ada=1;
    }
}
?>

<div class="card">
    <div><strong><center><font size=12>Jadwal Maintenance</font></center></strong></div>
    <br></br>
        <div class="card-body">
             <table border="1" id="myTable" width="100%">
                <thead>
                    <tr>
                        <td width="3%"><b>No</b></td>
                        <td width="10%"><b>ID Aset</b></td>
                        <td width="30%"><b>Nama Aset</b></td>
                        <td width="10%"><b>Unit</b></td>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i=1;
                    if($ada == 1) {
                        echo "Date : "  . $tgl_jadwal;
                        $sql = "SELECT penjadwalan.id_aset, perangkingan.id_perangkingan, aset.nama_aset, penjadwalan.unit, perangkingan.pj,perangkingan.teknisi,perangkingan.tgl_maintenance,perangkingan.status
                            FROM perangkingan 
                            INNER JOIN penjadwalan 
                            ON perangkingan.id_jadwal=penjadwalan.id_jadwal 
                            INNER JOIN aset 
                            ON aset.id_aset=penjadwalan.id_aset 
                            WHERE perangkingan.tgl_jadwal='".$tgl_jadwal."'
                            ORDER BY preferensi DESC";
                        $result = $conn->query($sql);
                        while($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo "     " . $i++; ?></td>
                                <td><?php echo $row['id_aset']; ?></td>
                                <td><?php echo $row['nama_aset']; ?></td>
                                <td><?php echo $row['unit']; ?></td>
                            </tr>
                        <?php
                            }
                            $conn->close();
                    } else{
                        echo "Date : "  . $tgl_jadwal;
                    ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>