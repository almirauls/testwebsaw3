<?php 

$id_jadwal=$_GET['id_jadwal'];

if(isset($_POST['update'])){

    // mengambil data dari masing-masing input
    $tgl_jadwal=$_POST['tgl_jadwal'];
    $unit=$_POST['unit'];
    $frekuensi=$_POST['frekuensi'];
    $kondisi=$_POST['kondisi'];
    $usia=$_POST['usia'];

    // proses update data
    $sql = "UPDATE penjadwalan SET tgl_jadwal='$tgl_jadwal',unit='$unit',frekuensi='$frekuensi',kondisi='$kondisi',usia='$usia' WHERE id_jadwal='$id_jadwal'";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=penjadwalan");
    }
}

// memanggil data dan memasukkan ke masing-masing input

$sql = "SELECT penjadwalan.id_jadwal,penjadwalan.tgl_jadwal,penjadwalan.id_aset,aset.nama_aset,penjadwalan.unit,penjadwalan.frekuensi,penjadwalan.kondisi,penjadwalan.usia 
        FROM aset INNER JOIN penjadwalan ON aset.id_aset=penjadwalan.id_aset WHERE id_jadwal='$id_jadwal'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                <div class="card-header bg-primary text-white border-dark"><strong>Update Kriteria Penjadwalan</strong></div>
                    <div class="card-body">

                <!-- ID Aset di lock karena primary key -->
                <div class="form-group">
                    <label for="">Tanggal</label>
                    <input type="date" class="form-control" value="<?php echo $row["tgl_jadwal"]?>" name="tgl_jadwal" required>
                </div>

                <div class="form-group">
                    <label for="">ID Aset</label>
                    <input type="text" class="form-control" value="<?php echo $row["id_aset"]?>" name="id_aset" readonly>
                </div>

                <div class="form-group">
                    <label for="">Nama Aset</label>
                    <input type="text" class="form-control" value="<?php echo $row["nama_aset"]?>" name="nama_aset" readonly>
                </div>

                <div class="form-group">
                        <label for="">Unit</label>
                        <input type="text" class="form-control" value="<?php echo $row["unit"]?>" name="unit" required>
                    </div>

                <!-- <div class="form-group">
                        <label for="">Frekuensi</label>
                        <input type="number" class="form-control" value="<?php echo $row["frekuensi"]?>" name="frekuensi" min="1" max="4" required>
                    </div> -->
                 <div class="form-group">
                    <label for="frekuensi">Frekuensi</label>
                    <select class="form-control" name="frekuensi" id="frekuensi" required>
                        <?php
                        $selectedValue = $row["frekuensi"];
                        for ($i = 1; $i <= 4; $i++) {
                            $label = ""; // Add your custom label here based on the value $i.
                            switch ($i) {
                                case 1:
                                    $label = "1 - Tidak Pernah (Hampir Setiap Tahun >1 Kali)";
                                    break;
                                case 2:
                                    $label = "2 - Jarang (Hampir Setiap Bulan >1 Kali)";
                                    break;
                                case 3:
                                    $label = "3 - Kadang (Hampir Setiap Minggu >1 Kali)";
                                    break;
                                case 4:
                                    $label = "4 - Sering (Hampir Setiap Hari)";
                                    break;
                                // default:
                                //     $label = "Pilih Nilai Kriteria";
                            }
                            $selected = ($i == $selectedValue) ? "selected" : "";
                            echo "<option value='$i' $selected>$label</option>";
                        }
                        ?>
                    </select>
                </div>

                    <!-- <div class="form-group">
                        <label for="">Kondisi</label>
                        <input type="number" class="form-control" value="<?php echo $row["kondisi"]?>" name="kondisi" min="1" max="4" required>
                    </div> -->
                    <div class="form-group">
                    <label for="kondisi">Kondisi</label>
                    <select class="form-control" name="kondisi" id="kondisi" required>
                        <?php
                        $selectedValue = $row["kondisi"]; 
                        for ($i = 1; $i <= 4; $i++) {
                            $label = ""; 
                            switch ($i) {
                                case 1:
                                    $label = "1 - Sangat Baik (Kondisi Prima)";
                                    break;
                                case 2:
                                    $label = "2 - Baik (Kondisi Fungsional)";
                                    break;
                                case 3:
                                    $label = "3 - Perlu Perbaikan (Kondisi Fungsional dengan Kerusakan Minim)";
                                    break;
                                case 4:
                                    $label = "4 - Rusak Parah (Kondisi Hampir Tidak Fungsional)";
                                    break;
                                // default:
                                //     $label = "Pilih Nilai Kriteria";
                            }
                            $selected = ($i == $selectedValue) ? "selected" : "";
                            echo "<option value='$i' $selected>$label</option>";
                        }
                        ?>
                    </select>
                </div>

                    <!-- <div class="form-group">
                        <label for="">Usia</label>
                        <input type="number" class="form-control" value="<?php echo $row["usia"]?>" name="usia" min="1" max="4" required>
                    </div> -->
                    <div class="form-group">
                    <label for="usia">Usia</label>
                    <select class="form-control" name="usia" id="usia" required>
                        <?php
                        $selectedValue = $row["usia"]; 
                        for ($i = 1; $i <= 4; $i++) {
                            $label = ""; 
                            switch ($i) {
                                case 1:
                                    $label = "1 - >7 Tahun (Perlu Perhatian Khusus)";
                                    break;
                                case 2:
                                    $label = "2 - 5-6 Tahun (Layak Pakai)";
                                    break;
                                case 3:
                                    $label = "3 - 3-4 Tahun (Standar)";
                                    break;
                                case 4:
                                    $label = "4 - 1-2 Tahun (Seperti Baru)";
                                    break;
                                // default:
                                //     $label = "Pilih Nilai Kriteria";
                            }
                            $selected = ($i == $selectedValue) ? "selected" : "";
                            echo "<option value='$i' $selected>$label</option>";
                        }
                        ?>
                    </select>
                </div>

                <input class="btn btn-primary" type="submit" name="update" value="Update">
                <a class="btn btn-danger" href="?page=penjadwalan">Batal</a>

                </div>
            </div>
        </form>
    </div>
</div>