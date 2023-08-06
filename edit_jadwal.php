<?php 
//exit();
$id_perangkingan=$_GET['id_perangkingan'];
// echo $id_perangkinan;
//exit();

if(isset($_POST['update'])){

    // mengambil data dari masing-masing input
    $pj=$_POST['pj'];
    $teknisi=$_POST['teknisi'];
    $tgl_maintenance=$_POST['tgl_maintenance'];
    $status=$_POST['status'];


    // (other code remains the same)

    // proses update data status jadwal
    $sql = "UPDATE perangkingan 
            SET pj='".$pj."',teknisi='".$teknisi."',tgl_maintenance='".$tgl_maintenance."',status='".$status."'
            WHERE id_perangkingan='".$id_perangkingan."'";
    $result = $conn->query($sql);
    // $stmt = $conn->prepare($sql);
    // $stmt->bind_param("ssssi", $pj, $teknisi, $tgl_maintenance, $status, $id_perangkingan);

    if ($result) {
        header("Location:?page=edit");
    }
}

// memanggil data dan memasukkan ke masing-masing input
    $sql = "SELECT penjadwalan.id_aset, aset.nama_aset, penjadwalan.unit,
                perangkingan.id_perangkingan,perangkingan.id_jadwal,
                penjadwalan.tgl_jadwal,
                perangkingan.n_frekuensi,perangkingan.n_kondisi,
                perangkingan.n_usia,perangkingan.preferensi,
                perangkingan.pj,perangkingan.teknisi,perangkingan.tgl_maintenance,perangkingan.status
            FROM perangkingan INNER JOIN penjadwalan ON perangkingan.id_jadwal=penjadwalan.id_jadwal 
            INNER JOIN aset ON aset.id_aset=penjadwalan.id_aset  
            WHERE id_perangkingan='$id_perangkingan'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0)
        $row = $result->fetch_assoc();
    ?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                <div class="card-header bg-primary text-white border-dark"><strong>UPDATE STATUS MAINTENANCE</strong></div>
                    <div class="card-body">

                <!-- id di lock karena primary key -->
                <div class="form-group">
                    <label for="">ID Aset</label>
                    <input type="text" class="form-control" value="<?php echo $row["id_aset"]?>" name="id_aset" readonly>
                </div>

                <div class="form-group">
                    <label for="">Nama Aset</label>
                    <input type="text" class="form-control" value="<?php echo $row["nama_aset"]?>"name="nama_aset" readonly>
                </div>

                <div class="form-group">
                    <label for="">Unit</label>
                    <input type="text" class="form-control" value="<?php echo $row["unit"]?>" name="unit" readonly>
                </div>

                <div class="form-group">
                    <label for="">P. Jawab</label>
                    <input type="text" class="form-control" value="<?php echo $row["pj"]?>" name="pj" maxlength="50" required>
                </div>

                <div class="form-group">
                    <label for="">Teknisi</label>
                    <input type="text" class="form-control" value="<?php echo $row["teknisi"]?>" name="teknisi" maxlength="50" required>
                </div>

                <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" class="form-control" name="tgl_maintenance" required>
                    </div>

                    <div class="form-group">
                        <label for="">Status</label>
                        <select class="form-control chosen" data-placeholder="Pilih Status" name="status">
                            <option value="<?php echo $row["status"]?>"><?php echo $row["status"]?></option>;
                            <option value="SELESAI">SELESAI</option>;
                            <option value="BELUM SELESAI">BELUM SELESAI</option>;

                        </select>
                    </div>

                <input class="btn btn-primary" type="submit" name="update" value="Update">
                <a class="btn btn-danger" href="?page=edit">Batal</a>

                </div>
            </div>
        </form>
    </div>
</div>