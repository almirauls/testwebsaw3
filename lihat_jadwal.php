<!-- proses perangkingan -->
<?php
$tgl_jadwal='';
$ada=0;

if(isset($_POST['proses'])){

// mengambil data tanggal dari input
    $tgl_jadwal=$_POST["tgl_jadwal"];
    $_SESSION['tgl_jadwal'] = $tgl_jadwal;
  
    
    if (!empty($tgl_jadwal)) {
        $_SESSION['tgl_jadwal'] = $tgl_jadwal;
        // mengambil data dari tabel penjadwalan atau pembobotan
        $sql = "SELECT*FROM penjadwalan WHERE tgl_jadwal='".$tgl_jadwal."'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $ada=1;
            
        } else{
          //  if(isset($_SESSION['tgl_jadwal']) && !empty($_SESSION['tgl_jadwal'])){
          //      session_unset(); // untuk logout
          //  }
            ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Data tidak ditemukan</strong>
                </div>
            <?php
        }
    } else {
       // if(isset($_SESSION['tgl_jadwal']) && !empty($_SESSION['tgl_jadwal'])){
       //     session_unset();
       // }
            ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Tanggal harus diisi</strong>
            </div>
            <?php
    }
}
?>

<div class="card">
    <div class="card-header bg-primary text-white border-dark"><strong>Update Jadwal</strong></div>
        <div class="card-body">
            <!-- form memilih tanggal dan tombol proses -->
            <form action="" method="POST">
                <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" class="form-control" name="tgl_jadwal">
                </div>
                <input class="btn btn-primary mb-2" type="submit" name="proses" value="Proses">
            </form> 
            
            <table class="table table-bordered" id="myTable">
                <thead>
                    <tr>
                        <th width="25px">No</th>
                        <th width="100px">ID Aset</th>
                        <th width="250px">Nama Aset</th>
                        <th width="80px">Unit</th>
                        <th width="80px">P. Jawab</th>
                        <th width="80px">Teknisi</th>
                        <th width="80px">Tanggal</th>
                        <th width="80px">Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i=1;
                    if(!empty($_SESSION['tgl_jadwal']) || $ada == 1) {
                        echo "Date : "  . $_SESSION['tgl_jadwal'];
                        $tgl_jadwal=$_SESSION["tgl_jadwal"];
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
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $row['id_aset']; ?></td>
                                <td><?php echo $row['nama_aset']; ?></td>
                                <td><?php echo $row['unit']; ?></td>
                                <td><?php echo $row['pj']; ?></td>
                                <td><?php echo $row['teknisi']; ?></td>
                                <td><?php echo $row['tgl_maintenance']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                                <td>
                                    <a class="btn btn-primary mb-2" href="?page=edit&action=update&id_perangkingan=<?php echo $row['id_perangkingan']; ?>">
                                        Update
                                    </a>
                                </td>
                            </tr>
                        <?php
                            }
                            $conn->close();
                    } else{
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