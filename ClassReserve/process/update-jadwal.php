<?php

include '../config/database.php';

$id = $_POST['id'];

$activity_name = $_POST['activity_name'];

mysqli_query($conn,

"UPDATE room_schedule

SET activity_name='$activity_name'

WHERE id='$id'");

header("Location: ../admin-jadwal.php");

?>