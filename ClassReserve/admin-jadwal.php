<?php

session_start();

include 'config/database.php';

/*
|--------------------------------------------------------------------------
| AMBIL DATA JADWAL + USER
|--------------------------------------------------------------------------
*/

$query = mysqli_query($conn,

"SELECT room_schedule.*,
users.name

FROM room_schedule

LEFT JOIN reservations
ON room_schedule.activity_name = reservations.activity_name

LEFT JOIN users
ON reservations.user_id = users.id");

$schedules = [];

while($row = mysqli_fetch_assoc($query)){

    $day = date(
        'l',
        strtotime($row['reservation_date'])
    );

    $time = substr(
        $row['start_time'],
        0,
        5
    );

    $room = $row['room_name'];

    $schedules[$room][$day][$time] = $row;
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

<title>Kelola Jadwal Ruangan</title>

<link rel="stylesheet" href="css/style.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

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
    margin-bottom:15px;
    border-radius:10px;
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

.card{
    background:white;
    padding:30px;
    border-radius:20px;
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

/* SLOT */

.slot{
    position:relative;
    transition:0.3s;
}

.available{
    background:#bbf7d0;
}

.used{
    background:#fecaca;
}

/* HOVER MENU */

.hover-menu{
    position:absolute;
    top:50%;
    left:50%;
    transform:translate(-50%, -50%);
    display:none;
    gap:5px;
    z-index:10;
}

.column{
    flex-direction:column;
}

.slot:hover .hover-menu{
    display:flex;
}

/* BUTTON */

.action-btn{
    border:none;
    padding:6px 12px;
    border-radius:5px;
    cursor:pointer;
    color:white;
    font-size:12px;
}

.edit{
    background:#3b82f6;
}

.delete{
    background:#ef4444;
}

.add{
    background:#22c55e;
}

/* DETAIL BOX */

.detail-box{
    background:white;
    padding:10px;
    border-radius:10px;
    font-size:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
    width:140px;
}

/* POPUP */

.popup{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.5);

    display:none;

    justify-content:center;
    align-items:center;

    z-index:999;
}

.popup-content{
    background:white;
    width:400px;
    padding:30px;
    border-radius:20px;
}

.popup-content h2{
    margin-bottom:20px;
}

.popup-content input{
    width:100%;
    padding:12px;
    margin-top:10px;
    margin-bottom:20px;
    border:1px solid #ccc;
    border-radius:10px;
}

.full-btn{
    width:100%;
    padding:15px;
    font-size:16px;
    margin-top:10px;
}

</style>

</head>
<body>

<!-- SIDEBAR -->

<div class="sidebar">

<h2>ClassReserve</h2>

<ul>

<li onclick="window.location.href='admin-dashboard.php'">
Dashboard Admin
</li>

<li class="active-menu">
Kelola Jadwal Ruangan
</li>

<li onclick="window.location.href='process/logout.php'">
Logout
</li>

</ul>

</div>

<!-- DASHBOARD -->

<div class="dashboard">

<h1>Kelola Jadwal Ruangan</h1>

<div class="card">

<!-- PILIH RUANGAN -->

<form method="GET">

<select name="room" onchange="this.form.submit()">

<option value="Ruang 101"
<?php if($selected_room == 'Ruang 101') echo 'selected'; ?>>
Ruang 101
</option>

<option value="Ruang 102"
<?php if($selected_room == 'Ruang 102') echo 'selected'; ?>>
Ruang 102
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
'15:00'
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

$content = "";

if(isset($schedules[$selected_room][$day][$time])){

$class = "used";

$data = $schedules[$selected_room][$day][$time];

$content = '

<div class="hover-menu column">

<div class="detail-box">

<b>Kegiatan:</b><br>
'.$data['activity_name'].'<br><br>

<b>Peminjam:</b><br>
'.$data['name'].'

</div>

<a href="edit-jadwal.php?id='.$data['id'].'">

<button class="action-btn edit">
Edit
</button>

</a>

<a href="process/delete-jadwal.php?id='.$data['id'].'">

<button class="action-btn delete">
Hapus
</button>

</a>

</div>
';

}else{

$content = '

<div class="hover-menu">

<button
class="action-btn add"

onclick="

openPopup(
\''.$selected_room.'\',
\''.$day.'\',
\''.$time.'\'
)

">

Tambah

</button>

</div>
';
}

echo "

<td class='slot $class'>

$content

</td>

";
}

echo "</tr>";
}
?>

</table>

</div>

</div>

<!-- POPUP -->

<div class="popup" id="popup">

<div class="popup-content">

<h2>Tambah Jadwal</h2>

<form action="process/tambah-jadwal.php" method="POST">

<input
type="hidden"
name="room_name"
id="room_name">

<input
type="hidden"
name="day"
id="day">

<input
type="hidden"
name="time"
id="time">

<label>Nama Kegiatan</label>

<input
type="text"
name="activity_name"
required>

<button
type="submit"
class="action-btn add full-btn">

Simpan

</button>

</form>

<button
onclick="closePopup()"
class="action-btn delete full-btn">

Tutup

</button>

</div>

</div>

<!-- JAVASCRIPT -->

<script>

function openPopup(room, day, time){

document.getElementById('popup').style.display='flex';

document.getElementById('room_name').value = room;

document.getElementById('day').value = day;

document.getElementById('time').value = time;
}

function closePopup(){

document.getElementById('popup').style.display='none';
}

</script>

</body>
</html>