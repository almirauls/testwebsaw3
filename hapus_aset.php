<?php

$id_aset=$_GET['id_aset'];

$sql = "DELETE FROM aset WHERE id_aset='$id_aset'";
if ($conn->query($sql) === TRUE) {
    header("Location:?page=aset");
}
$conn->close();
?>