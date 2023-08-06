<div class="card">
    <div class="card-header bg-primary text-white border-dark"><strong>Jadwal Maintenance</strong></div>
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
                    if(isset($_SESSION['tgl_jadwal']) && !empty($_SESSION['tgl_jadwal'])){
                        $tgl_jadwal=$_SESSION["tgl_jadwal"];
                        $sql = "SELECT * FROM perangkingan 
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
                                    <a class="btn btn-primary mb-2" href="?page=perangkingan&action=update&id_perangkingan=<?php echo $row['id_perangkingan']; ?>">
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