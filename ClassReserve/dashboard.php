<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: login-student.php");
}

include 'config/database.php';

/*
|--------------------------------------------------------------------------
| AMBIL DATA JADWAL DARI DATABASE
|--------------------------------------------------------------------------
*/

$schedule_query = mysqli_query($conn,
"SELECT * FROM room_schedule");

$schedules = [];

while($row = mysqli_fetch_assoc($schedule_query)){

    $day = date(
        'l',
        strtotime($row['reservation_date'])
    );

    $start = substr(
        $row['start_time'],
        0,
        5
    );

    $room = $row['room_name'];

    $schedules[$room][$day][$start] = true;
}

/*
|--------------------------------------------------------------------------
| PILIH RUANGAN
|--------------------------------------------------------------------------
*/

$selected_room = "Ruang 101";

if(isset($_GET['room'])){
    $selected_room = $_GET['room'];
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard Reservasi</title>

<link rel="stylesheet" href="css/style.css">

<style>

body{
    background:#f5f5f5;
}

/* SIDEBAR */

.sidebar{
    width:250px;
    height:100vh;
    background:#065f46;
    position:fixed;
    left:0;
    top:0;
    padding:30px 20px;
    color:white;
}

.sidebar h2{
    margin-bottom:40px;
}

.sidebar ul{
    list-style:none;
}

.sidebar ul li{
    padding:15px;
    border-radius:10px;
    margin-bottom:15px;
    cursor:pointer;
    transition:0.3s;
}

.sidebar ul li:hover{
    background:#047857;
}

.active-menu{
    background:#047857;
}

/* DASHBOARD */

.dashboard{
    margin-left:270px;
    padding:40px;
}

.dashboard h1{
    margin-bottom:30px;
}

/* CARD */

.schedule-card{
    background:white;
    border-radius:20px;
    padding:30px;
    box-shadow:0 5px 20px rgba(0,0,0,0.08);
}

/* SELECT */

select{
    width:100%;
    padding:15px;
    border-radius:10px;
    border:1px solid #ccc;
    margin-bottom:30px;
    font-size:16px;
}

/* TABLE */

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#065f46;
    color:white;
}

th, td{
    border:1px solid #ddd;
    padding:20px;
    text-align:center;
}

/* STATUS */

.available{
    background:#bbf7d0;
}

.used{
    background:#fecaca;
}

/* LEGEND */

.legend{
    display:flex;
    gap:20px;
    margin-top:25px;
}

.legend-item{
    display:flex;
    align-items:center;
    gap:10px;
}

.legend-box{
    width:20px;
    height:20px;
    border-radius:5px;
}

.green{
    background:#bbf7d0;
}

.red{
    background:#fecaca;
}

</style>

</head>
<body>

<!-- SIDEBAR -->

<div class="sidebar">

<h2>ClassReserve</h2>

<ul>

<li class="active-menu">
Dashboard
</li>

<li onclick="window.location.href='pengajuan.php'">
Pengajuan Peminjaman
</li>

<li onclick="window.location.href='process/logout.php'">
Logout
</li>

</ul>

</div>

<!-- DASHBOARD -->

<div class="dashboard">

<h1>
Dashboard Reservasi Ruangan
</h1>

<div class="schedule-card">

<!-- PILIH RUANGAN -->

<form method="GET">

<label>
Pilih Ruangan
</label>

<br><br>

<select name="room" onchange="this.form.submit()">

<option value="Ruang 101"
<?php if($selected_room == 'Ruang 101') echo 'selected'; ?>>
Ruang 101 - Kelas
</option>

<option value="Ruang 102"
<?php if($selected_room == 'Ruang 102') echo 'selected'; ?>>
Ruang 102 - Kelas
</option>

<option value="Laboratorium 201"
<?php if($selected_room == 'Laboratorium 201') echo 'selected'; ?>>
Laboratorium 201
</option>

</select>

</form>

<!-- TABLE -->

<table>

<tr>

<th>Waktu</th>
<th>Senin</th>
<th>Selasa</th>
<th>Rabu</th>
<th>Kamis</th>
<th>Jumat</th>

</tr>

<?php

$times = [
'07:00',
'08:00',
'09:00',
'10:00',
'11:00',
'12:00',
'13:00',
'14:00',
'15:00',
'16:00'
];

$days = [
'Monday',
'Tuesday',
'Wednesday',
'Thursday',
'Friday'
];

foreach($times as $time){

echo "<tr>";

echo "<td>$time - ".date('H:i',
strtotime($time)+3600)."</td>";

foreach($days as $day){

$class = "available";

if(isset($schedules[$selected_room][$day][$time])){
    $class = "used";
}

echo "<td class='$class'></td>";
}

echo "</tr>";
}
?>

</table>

<!-- LEGEND -->

<div class="legend">

<div class="legend-item">

<div class="legend-box green"></div>

<span>Tersedia</span>

</div>

<div class="legend-item">

<div class="legend-box red"></div>

<span>Terpakai</span>

</div>

</div>

</div>

</div>

</body>
</html>