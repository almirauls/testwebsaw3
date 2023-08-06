<?php

$id_user=$_GET['id_user'];

$sql = "DELETE FROM user WHERE id_user='$id_user'";
if ($conn->query($sql) === TRUE) {
    header("Location:?page=user");
}
$conn->close();
?>