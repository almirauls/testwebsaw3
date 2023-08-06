<div class="card">
  <div class="card-header bg-primary text-white border-dark"><strong>Pengaturan Bobot</strong></div>
    <div class="card-body">
        <!-- <a class="btn btn-primary mb-2" href="?page=penjadwalan&action=tambah">Tambah</a> -->
    <table class="table table-bordered" id="myTable">
        <thead>
        <tr>
            <th width="25px">No</th>
            <th width="100px">Kriteria Penilaian</th>
            <th width="100px">Bobot (%)</th>
            <th width="80px"></th>
      </tr>
    </thead>
    <tbody>

        <?php
        $i=1;
        $sql = "SELECT * FROM bobot ORDER BY id_kriteria ASC";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
        ?>
            <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row['kriteria']; ?></td>
            <td><?php echo $row['bobot']; ?></td>
            <td align= "center">
            
                <a class="btn btn-warning" href="?page=pembobotan&action=update&id_kriteria=<?php echo $row['id_kriteria']; ?>">
                    <span class="fas fa-edit "></span>
                </a>
                
            </td>
        </tr>
        <?php
            }
            $conn->close();
        ?>

   </tbody>
</table>