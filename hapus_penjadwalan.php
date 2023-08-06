<?php

$id_jadwal=$_GET['id_jadwal'];

$sql = "DELETE FROM penjadwalan WHERE id_jadwal='$id_jadwal'";
if ($conn->query($sql) === TRUE) {
    header("Location:?page=penjadwalan");
}
$conn->close();
?>