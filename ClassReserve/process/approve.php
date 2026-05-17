<?php

include '../config/database.php';

$id = $_GET['id'];

$get = mysqli_query($conn,

"SELECT * FROM reservations
WHERE id='$id'");

$data = mysqli_fetch_assoc($get);

/*
|--------------------------------------------------------------------------
| CEK DOUBLE BOOKING SEBELUM APPROVE
|--------------------------------------------------------------------------
*/

$cek_bentrok = mysqli_query($conn, "
    SELECT * FROM room_schedule
    WHERE room_name = '".$data['room_name']."'
    AND reservation_date = '".$data['reservation_date']."'
    AND start_time < '".$data['end_time']."'
    AND end_time > '".$data['start_time']."'
");

if (mysqli_num_rows($cek_bentrok) > 0) {
    echo "
    <script>
        alert('Pengajuan tidak bisa disetujui karena jadwal bentrok!');
        window.location.href='../admin-dashboard.php';
    </script>
    ";
    exit;
}

$get = mysqli_query($conn, "SELECT * FROM reservations WHERE id='$id' AND status='pending'");

if (mysqli_num_rows($get) == 0) {
    echo "
    <script>
        alert('Pengajuan sudah diproses sebelumnya!');
        window.location.href='../admin-dashboard.php';
    </script>
    ";
    exit;
}

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