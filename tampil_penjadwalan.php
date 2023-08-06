<div class="card">
  <div class="card-header bg-primary text-white border-dark"><strong>Pengaturan Kriteria</strong></div>
    <div class="card-body">
        <a class="btn btn-primary mb-2" href="?page=penjadwalan&action=tambah">Tambah</a>
    <table class="table table-bordered" id="myTable">
        <thead>
        <tr>
            <th width="25px">No</th>
            <th width="80px">Tanggal</th>
            <th width="80px">ID Aset</th>
            <th width="280px">Nama Aset</th>
            <th width="60px">Unit</th>
            <th width="50px">Frekuensi</th>
            <th width="50px">Kondisi</th>
            <th width="50px">Usia</th>
            <th width="80px"></th>
      </tr>
    </thead>
    <tbody>

        <?php
        $i=1;
        $sql = "SELECT penjadwalan.id_jadwal,penjadwalan.tgl_jadwal,penjadwalan.id_aset,aset.nama_aset,penjadwalan.unit,penjadwalan.frekuensi,penjadwalan.kondisi,penjadwalan.usia 
        FROM aset INNER JOIN penjadwalan ON aset.id_aset=penjadwalan.id_aset ORDER BY id_jadwal ASC";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
        ?>
            <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row['tgl_jadwal']; ?></td>
            <td><?php echo $row['id_aset']; ?></td>
            <td><?php echo $row['nama_aset']; ?></td>
            <td><?php echo $row['unit']; ?></td>
            <td><?php echo $row['frekuensi']; ?></td>
            <td><?php echo $row['kondisi']; ?></td>
            <td><?php echo $row['usia']; ?></td>
            <td align= "center">
            
                <a class="btn btn-warning" href="?page=penjadwalan&action=update&id_jadwal=<?php echo $row['id_jadwal']; ?>">
                    <span class="fas fa-edit "></span>
                </a>
                
                <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=penjadwalan&action=hapus&id_jadwal=<?php echo $row['id_jadwal']; ?>">
                <span class="fas fa-times"></span>
                </a>
            </td>
        </tr>
        <?php
            }
            $conn->close();
        ?>

   </tbody>
</table>