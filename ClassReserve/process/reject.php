<?php

include '../config/database.php';

$id = $_GET['id'];

/*
|--------------------------------------------------------------------------
| AMBIL DATA RESERVATION
|--------------------------------------------------------------------------
*/

$get = mysqli_query($conn,

"SELECT * FROM reservations
WHERE id='$id'");

$data = mysqli_fetch_assoc($get);

/*
|--------------------------------------------------------------------------
| HAPUS DARI ROOM SCHEDULE
|--------------------------------------------------------------------------
*/

mysqli_query($conn,

"DELETE FROM room_schedule

WHERE room_name='".$data['room_name']."'

AND reservation_date='".$data['reservation_date']."'

AND start_time='".$data['start_time']."'

AND end_time='".$data['end_time']."'
");

/*
|--------------------------------------------------------------------------
| HAPUS RESERVATION
|--------------------------------------------------------------------------
*/

mysqli_query($conn,

"DELETE FROM reservations
WHERE id='$id'");

/*
|--------------------------------------------------------------------------
| KEMBALI KE DASHBOARD
|--------------------------------------------------------------------------
*/

header("Location: ../admin-dashboard.php");

?>