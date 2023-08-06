<div class="card">
  <div class="card-header bg-primary text-white border-dark"><strong>Data Aset</strong></div>
    <div class="card-body">
        <a class="btn btn-primary mb-2" href="?page=aset&action=tambah">Tambah</a>
    <table class="table table-bordered" id="myTable">
        <thead>
        <tr>
            <th width="100px">ID Aset</th>
            <th width="250px">Nama Aset</th>
            <th width="80px">Unit</th>
            <th width="80px"></th>
      </tr>
    </thead>
    <tbody>

        <?php
        $sql = "SELECT*FROM aset ORDER BY id_aset ASC";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td><?php echo $row['id_aset']; ?></td>
            <td><?php echo $row['nama_aset']; ?></td>
            <td><?php echo $row['unit']; ?></td>
            <td align= "center">
            
                <a class="btn btn-warning" href="?page=aset&action=update&id_aset=<?php echo $row['id_aset']; ?>">
                    <span class="fas fa-edit "></span>
                </a>
                
                <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=aset&action=hapus&id_aset=<?php echo $row['id_aset']; ?>">
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