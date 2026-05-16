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