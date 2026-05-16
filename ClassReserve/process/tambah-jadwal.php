<?php

include '../config/database.php';

$room_name = $_POST['room_name'];

$day = $_POST['day'];

$time = $_POST['time'];

$activity_name = $_POST['activity_name'];

/*
|--------------------------------------------------------------------------
| CONVERT DAY TO DATE
|--------------------------------------------------------------------------
*/

$date = date('Y-m-d',
strtotime($day));

$end_time = date(
'H:i:s',
strtotime($time)+3600
);

mysqli_query($conn,

"INSERT INTO room_schedule

(room_name,reservation_date,
start_time,end_time,activity_name)

VALUES

(
'$room_name',
'$date',
'$time:00',
'$end_time',
'$activity_name'
)");

header("Location: ../admin-jadwal.php");

?>