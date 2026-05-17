<?php
session_start();

include '../config/database.php';

$user_id = $_SESSION['id'];

$room_name = $_POST['room_name'];
$activity_name = $_POST['activity_name'];
$reservation_date = $_POST['reservation_date'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$description = $_POST['description'];

/*
|--------------------------------------------------------------------------
| VALIDASI JAM
|--------------------------------------------------------------------------
*/

if (strtotime($end_time) <= strtotime($start_time)) {
    echo "
    <script>
        alert('Jam selesai harus lebih besar dari jam mulai!');
        window.location.href='../pengajuan.php';
    </script>
    ";
    exit;
}

/*
|--------------------------------------------------------------------------
| CEK DOUBLE BOOKING DARI JADWAL YANG SUDAH APPROVED
|--------------------------------------------------------------------------
*/

$cek_bentrok = mysqli_query($conn, "
    SELECT * FROM room_schedule
    WHERE room_name = '$room_name'
    AND reservation_date = '$reservation_date'
    AND start_time < '$end_time'
    AND end_time > '$start_time'
");

if (mysqli_num_rows($cek_bentrok) > 0) {
    echo "
    <script>
        alert('Ruangan sudah dipakai pada tanggal dan jam tersebut!');
        window.location.href='../pengajuan.php';
    </script>
    ";
    exit;
}

$query = "INSERT INTO reservations
(user_id, room_name, activity_name,
reservation_date, start_time, end_time,
description)

VALUES

('$user_id','$room_name','$activity_name',
'$reservation_date','$start_time','$end_time',
'$description')";

mysqli_query($conn, $query);

echo "
<script>
    alert('Pengajuan berhasil dikirim!');
    window.location.href='../dashboard.php';
</script>
";
?>