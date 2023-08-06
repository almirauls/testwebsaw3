<?php

// $tgl_jadwal='';
// $ada=0;
if(isset($_GET['page'])){
    $xsort = $_GET['sort'];
    if ($xsort == 'bulan' || $xsort == 'bulan1' || $xsort == "tahun" || $xsort == "tahun1") {
        $sql = "SELECT * FROM penjadwalan";
        $result = $conn->query($sql);
         if ($result->num_rows > 0) {
        // periksa apakah sudah ada di tabel perangkingan.
        // bila belum ada, lanjut ke proses SAW
        // bila sudah ada, ditanya apakah mau diproses dan data lama akan hilang
        // baca bobot
            $bfreq=0; $bkond=0; $busia=0;
            $sql = "select * from bobot";
            $r = $conn->query($sql);
            $row = $r->fetch_assoc();
            $bfrek = $row["frekuensi"] /100;
            $bkond = $row["kondisi"] /100;
            $busia = $row["usia"] /100;

                // mencari nilai max dan min dengan single query
            $sql = "SELECT MAX(frekuensi) AS max_frekuensi, MAX(kondisi) AS max_kondisi, MIN(usia) AS min_usia 
                   FROM penjadwalan";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            
            // mengambil nilai max dan min
            $mfrekuensi = $row["max_frekuensi"];
            $mkondisi = $row["max_kondisi"];
            $musia = $row["min_usia"];
            
            // menghapus data perangkingan yang lama
            $sql2 = "DELETE FROM perangkingan";
            $conn->query($sql2);

            // proses normalisasi
            $sql = "SELECT * FROM penjadwalan";
            $result = $conn->query($sql);
            //echo 'abc'; exit();
            while($row = $result->fetch_assoc()){
               // mengambil data penjadwalan
                $id_jadwal=$row["id_jadwal"];
                $frekuensi=$row["frekuensi"];
                $kondisi=$row["kondisi"];
                $usia=$row["usia"];
                $tanggal = $row["tgl_jadwal"];

                // hitung normalisasi
                $n_frekuensi = $frekuensi / $mfrekuensi;
                $n_kondisi = $kondisi / $mkondisi;
                $n_usia = $musia / $usia;

                // hitung nilai preferensi
                $preferensi = ($n_frekuensi*$bfrek)+($n_kondisi*$bkond)+($n_usia*$busia);
            
            // simpan data perangkingan
                $sql3 = "INSERT INTO perangkingan (id_jadwal,tgl_jadwal,n_frekuensi,n_kondisi,n_usia,preferensi)
                        VALUES ('$id_jadwal','$tanggal','$n_frekuensi','$n_kondisi','$n_usia','$preferensi')";
                $result1 = $conn->query($sql3);
            }
        } else {
            ?>
            <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Data tidak ada</strong>
            </div>
            <?php
        }
    } elseif ($xsort == "tahun" || $xsort == "tahun1") {

    }
}
?>
<!--
<div class="card">
    <div class="card-header bg-primary text-white border-dark"><strong>Akses Jadwal (Perangkingan)</strong></div>
        <div class="card-body">
<div class="card-body">
?>
-->
<!-- form memilih tanggal dan tombol proses -->
<form action="?page=perangkingan&tgl_jadwal=" method="POST">
    <div class="form-group">
    <label for="">Tanggal.</label>
    <input type="date" class="form-control" name="tgl_jadwal">
    </div>
    <input class="btn btn-primary mb-2" type="submit" name="proses" value="Proses">
</form>
    
    <!-- Add Sort by Month and Sort by Year buttons -->
    <div class="btn-group mb-3">
    <div class="btn btn-primary">Sort by Month</div> <a href="?page=sort&sort=bulan" class="btn btn-primary">ASC</a> <div class="btn btn-primary">/</div> <a href="?page=sort&sort=bulan1" class="btn btn-primary">DESC</a>
    </div>
    <br>
    <div class="btn-group mb-3">
    <div class="btn btn-primary">Sort by Year</div> <a href="?page=sort&sort=tahun" class="btn btn-primary">ASC</a> <div class="btn btn-primary">/</div> <a href="?page=sort&sort=year1" class="btn btn-primary">DESC</a>
    </div>
            
    <table class="table table-bordered" id="myTable">
    <thead>
    <tr>
        <th width="25px">No</th>
        <th width="100px">ID Aset</th>
        <th width="250px">Nama Aset</th>
        <th width="800px">Tanggal</th>
        <th width="80px">Unit</th>
        <th width="80px">n_frekuensi</th>
        <th width="80px">n_kondisi</th>
        <th width="80px">n_usia</th>
        <th width="80px">Preferensi</th>
                        
    </tr>
    </thead>
    <tbody>
    <?php
        $i=1;
        if ($xsort == 'bulan') {
           $sql = "SELECT penjadwalan.id_aset, perangkingan.id_perangkingan, aset.nama_aset, penjadwalan.unit, penjadwalan.tgl_jadwal, perangkingan.n_frekuensi,perangkingan.n_kondisi,perangkingan.n_usia,perangkingan.preferensi
            FROM perangkingan 
            INNER JOIN penjadwalan 
            ON perangkingan.id_jadwal=penjadwalan.id_jadwal 
            INNER JOIN aset 
            ON aset.id_aset=penjadwalan.id_aset 
            ORDER BY month(penjadwalan.tgl_jadwal) ASC, penjadwalan.tgl_jadwal ASC";
        } elseif ($xsort == 'bulan1') {
            $sql = "SELECT penjadwalan.id_aset, perangkingan.id_perangkingan, aset.nama_aset, penjadwalan.unit, penjadwalan.tgl_jadwal, perangkingan.n_frekuensi,perangkingan.n_kondisi,perangkingan.n_usia,perangkingan.preferensi
            FROM perangkingan 
            INNER JOIN penjadwalan 
            ON perangkingan.id_jadwal=penjadwalan.id_jadwal 
            INNER JOIN aset 
            ON aset.id_aset=penjadwalan.id_aset 
            ORDER BY month(penjadwalan.tgl_jadwal) DESC, penjadwalan.tgl_jadwal DESC";
        } elseif ($xsort == 'year') {
            $sql = "SELECT penjadwalan.id_aset, perangkingan.id_perangkingan, aset.nama_aset, penjadwalan.unit, penjadwalan.tgl_jadwal, perangkingan.n_frekuensi,perangkingan.n_kondisi,perangkingan.n_usia,perangkingan.preferensi
            FROM perangkingan 
            INNER JOIN penjadwalan 
            ON perangkingan.id_jadwal=penjadwalan.id_jadwal 
            INNER JOIN aset 
            ON aset.id_aset=penjadwalan.id_aset 
            ORDER BY year(penjadwalan.tgl_jadwal) ASC, penjadwalan.tgl_jadwal ASC";
        } elseif($xsort == 'year1') {
            $sql = "SELECT penjadwalan.id_aset, perangkingan.id_perangkingan, aset.nama_aset, penjadwalan.unit, penjadwalan.tgl_jadwal, perangkingan.n_frekuensi,perangkingan.n_kondisi,perangkingan.n_usia,perangkingan.preferensi
            FROM perangkingan 
            INNER JOIN penjadwalan 
            ON perangkingan.id_jadwal=penjadwalan.id_jadwal 
            INNER JOIN aset 
            ON aset.id_aset=penjadwalan.id_aset 
            ORDER BY month(penjadwalan.tgl_jadwal) DESC, penjadwalan.tgl_jadwal DESC";
        } else {
            $sql = "SELECT penjadwalan.id_aset, perangkingan.id_perangkingan, aset.nama_aset, penjadwalan.unit, penjadwalan.tgl_jadwal, perangkingan.n_frekuensi,perangkingan.n_kondisi,perangkingan.n_usia,perangkingan.preferensi
            FROM perangkingan 
            INNER JOIN penjadwalan 
            ON perangkingan.id_jadwal=penjadwalan.id_jadwal 
            INNER JOIN aset 
            ON aset.id_aset=penjadwalan.id_aset ";
        }
    
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row['id_aset']; ?></td>
                <td><?php echo $row['nama_aset']; ?></td>
                <td><?php echo $row['tgl_jadwal']; ?></td>
                <td><?php echo $row['unit']; ?></td>
                <td><?php echo $row['n_frekuensi']; ?></td>
                <td><?php echo $row['n_kondisi']; ?></td>
                <td><?php echo $row['n_usia']; ?></td>
                <td><?php echo $row['preferensi']; ?></td>
                <td></td>
            </tr>
        <?php
            }
        } else {
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
                <!-- <td>-</td> -->
            </tr>
        <?php
        }
        ?>
    </tbody>
    </table>
<!--    </div>
</div>