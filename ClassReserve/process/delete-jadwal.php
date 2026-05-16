<?php

include '../config/database.php';

$id = $_GET['id'];

mysqli_query($conn,

"DELETE FROM room_schedule
WHERE id='$id'");

header("Location: ../admin-jadwal.php");

?>