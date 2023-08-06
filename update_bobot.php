<?php 

if(isset($_POST['update'])){
        // mengambil data dari masing-masing input
        $frekuensi = $_POST['frekuensi'];
		$kondisi   = $_POST['kondisi'];
		$usia      = $_POST['usia'];
		
        if ($frekuensi + $kondisi + $usia > 100) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Total bobot melebihi 100.</strong>
            </div>
        <?php
        } elseif ($frekuensi > 100 || $frekuensi < 0 || $kondisi > 100 || $kondisi < 0 | $usia > 100 || $usia < 0) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Ada data bobot melebihi 100 atau kurang dari 0 .</strong>
            </div>
        <?php
        } else {
        // proses update data
            $sql = "UPDATE bobot set frekuensi = '$frekuensi', kondisi='$kondisi', usia='$usia'";
            if ($conn->query($sql) === TRUE) {
            ?>
                <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Data sudah di update.</strong>
                </div>
            <?php
            }
        }
    }
?>

<!-- modal update -->
<?php 
    $sql = "SELECT * FROM bobot";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    ?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                <div class="card-header bg-primary text-white border-dark"><strong>Pengaturan Bobot</strong></div>
                    <div class="card-body">

                <!-- ID Kriteria di lock karena primary key -->
                <div class="form-group">
                    <label for="">Frekuensi</label>
                    <input type="text" class="form-control" value="<?php echo $row["frekuensi"]?>" name="frekuensi" >
                </div>

                <div class="form-group">
                    <label for="">Kondisi</label>
                    <input type="text" class="form-control" value="<?php echo $row["kondisi"]?>" name="kondisi">
                </div>

                <div class="form-group">
                    <label for="">Usia</label>
                    <input type="text" class="form-control" value="<?php echo $row["usia"]?>" name="usia">
                </div>

                <input class="btn btn-primary" type="submit" name="update" value="Update">
                <a class="btn btn-danger" href="?page=pembobotan">Batal</a>

                </div>
            </div>
        </form>
    </div>
</div>