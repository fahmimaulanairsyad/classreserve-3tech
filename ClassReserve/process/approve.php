<?php

include '../config/database.php';

$id = $_GET['id'];

$get = mysqli_query($conn,

"SELECT * FROM reservations
WHERE id='$id'");

$data = mysqli_fetch_assoc($get);

/*
|--------------------------------------------------------------------------
| APPROVE
|--------------------------------------------------------------------------
*/

mysqli_query($conn,

"UPDATE reservations

SET
status='approved',
notification='Pengajuan diterima admin'

WHERE id='$id'");

/*
|--------------------------------------------------------------------------
| MASUKKAN KE JADWAL
|--------------------------------------------------------------------------
*/

mysqli_query($conn,

"INSERT INTO room_schedule

(room_name,reservation_date,
start_time,end_time,activity_name)

VALUES

(
'".$data['room_name']."',
'".$data['reservation_date']."',
'".$data['start_time']."',
'".$data['end_time']."',
'".$data['activity_name']."'
)");

header("Location: ../admin-dashboard.php");

?>