<div class="card">
  <div class="card-header bg-primary text-white border-dark"><strong> Data User</strong></div>
    <div class="card-body">
        <a class="btn btn-primary mb-2" href="?page=user&action=tambah">Tambah</a>
    <table class="table table-bordered" id="myTable">
        <thead>
        <tr>
            <th width="25px">No</th>
            <th width="150px">Username</th>
            <th width="80px">Password</th>
            <th width="200px">Alamat</th>
            <th width="100px">Telepon</th>
            <th width="80px">Level</th>
            <th width="100px"></th>
      </tr>
    </thead>
    <tbody>

        <?php
        $i=1;
        $sql = "SELECT*FROM user ORDER BY username ASC";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['password']; ?></td>
            <td><?php echo $row['alamat']; ?></td>
            <td><?php echo $row['telepon']; ?></td>
            <td><?php echo $row['level']; ?></td>
            <td align= "center">
            
                <a class="btn btn-warning" href="?page=user&action=update&id_user=<?php echo $row['id_user']; ?>">
                    <span class="fas fa-edit "></span>
                </a>
                
                <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=user&action=hapus&id_user=<?php echo $row['id_user']; ?>">
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