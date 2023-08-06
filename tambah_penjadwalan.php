<?php

if(isset($_POST['simpan'])){

    // ambil data dari input
    $tgl_jadwal = $_POST["tgl_jadwal"];
	$nama_aset=$_POST['nama_aset'];
    $unit=$_POST['unit'];
    $frekuensi=$_POST['frekuensi'];
    $kondisi=$_POST['kondisi'];
    $usia=$_POST['usia'];
    
    // validasi data aset (mengecek data yang tidak boleh sama)
    $sql = "SELECT * FROM penjadwalan WHERE tgl_jadwal='$tgl_jadwal' AND id_aset='$nama_aset'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Data Aset sudah terdaftar</strong>
            </div>
        <?php
    }else{

	// proses simpan data aset
    $sql = "INSERT INTO penjadwalan (tgl_jadwal, id_aset, unit, frekuensi, kondisi, usia) VALUES ('$tgl_jadwal', '$nama_aset', '$unit', '$frekuensi', '$kondisi', '$usia')";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=penjadwalan");
        }
    }
}
?>


<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                <div class="card-header bg-primary text-white border-dark"><strong>INPUT DATA PENJADWALAN</strong></div>
                <div class="card-body">

                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" class="form-control" name="tgl_jadwal" required>
                    </div>

                    <div class="form-group">
                        <label for="">Nama Aset</label>
                        <select class="form-control chosen" data-placeholder="Pilih Aset" name="nama_aset">
                            <option value=""></option>;
                            <?php
                                $sql = "SELECT * FROM aset ORDER BY nama_aset ASC";
                                $result = $conn->query($sql);
                                while($row = $result->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $row['id_aset']; ?>"><?php echo $row['nama_aset']; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Unit</label>
                        <input type="text" class="form-control" name="unit" maxlength="50" required>
                    </div>

                    <div class="form-group">
                    <label for="frekuensi">Frekuensi</label>
                    <select class="form-control" name="frekuensi" id="frekuensi" required>
                    <option value="" disabled selected>Pilih Frekuensi...</option>
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
                                default:
                                    $label = "Pilih Nilai Kriteria";
                            }
                            $selected = ($i == $selectedValue) ? "selected" : "";
                            echo "<option value='$i' $selected>$label</option>";
                        }
                        ?>
                    </select>
                </div>

                    <div class="form-group">
                    <label for="kondisi">Kondisi</label>
                    <select class="form-control" name="kondisi" id="kondisi" required>
                    <option value="" disabled selected>Pilih Kondisi...</option>
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
                                default:
                                    $label = "Pilih Nilai Kriteria";
                            }
                            $selected = ($i == $selectedValue) ? "selected" : "";
                            echo "<option value='$i' $selected>$label</option>";
                        }
                        ?>
                    </select>
                </div>

                    <div class="form-group">
                    <label for="usia">Usia</label>
                    <select class="form-control" name="usia" id="usia" required>
                    <option value="" disabled selected>Pilih Usia...</option>
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
                                default:
                                    $label = "Pilih Nilai Kriteria";
                            }
                            $selected = ($i == $selectedValue) ? "selected" : "";
                            echo "<option value='$i' $selected>$label</option>";
                        }
                        ?>
                    </select>
                </div>
                    <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                    <a class="btn btn-danger" href="?page=penjadwalan">Batal</a>

                </div>
            </div>
        </form>
    </div>
</div>