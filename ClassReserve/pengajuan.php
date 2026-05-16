<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: login-student.php");
}

include 'config/database.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pengajuan Peminjaman</title>

    <link rel="stylesheet" href="css/style.css">

    <style>

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
        }

        .sidebar ul li:hover{
            background:#047857;
        }

        .active-menu{
            background:#047857;
        }

        .dashboard{
            margin-left:270px;
            padding:40px;
        }

        .form-card{
            background:white;
            padding:35px;
            border-radius:20px;
            box-shadow:0 5px 20px rgba(0,0,0,0.08);
            max-width:700px;
        }

        .form-card h1{
            margin-bottom:30px;
        }

        textarea{
            width:100%;
            height:120px;
            padding:15px;
            border-radius:10px;
            border:1px solid #ccc;
            resize:none;
        }

        select{
            width:100%;
            padding:15px;
            border-radius:10px;
            border:1px solid #ccc;
        }

    </style>

</head>
<body>

<div class="sidebar">

    <h2>ClassReserve</h2>

    <ul>

        <li onclick="window.location.href='dashboard.php'">
            Dashboard
        </li>

        <li class="active-menu">
            Pengajuan Peminjaman
        </li>

        <li onclick="window.location.href='process/logout.php'">
            Logout
        </li>

    </ul>

</div>

<div class="dashboard">

<div class="form-card">

<h1>Form Pengajuan Peminjaman</h1>

<form action="process/process-pengajuan.php" method="POST">

<div class="input-group">
<label>Nama Kegiatan</label>

<input
type="text"
name="activity_name"
placeholder="Masukkan nama kegiatan"
required>
</div>

<div class="input-group">
<label>Pilih Ruangan</label>

<select name="room_name" required>

<option value="">
-- Pilih Ruangan --
</option>

<option value="Ruang 101">
Ruang 101
</option>

<option value="Ruang 102">
Ruang 102
</option>

<option value="Laboratorium 201">
Laboratorium 201
</option>

<option value="Ruang Seminar 301">
Ruang Seminar 301
</option>

</select>
</div>

<div class="input-group">
<label>Tanggal</label>

<input
type="date"
name="reservation_date"
required>
</div>

<div style="display:flex; gap:20px;">

<div class="input-group" style="width:50%;">
<label>Waktu Mulai</label>

<input
type="time"
name="start_time"
required>
</div>

<div class="input-group" style="width:50%;">
<label>Waktu Berakhir</label>

<input
type="time"
name="end_time"
required>
</div>

</div>

<div class="input-group">
<label>Keterangan</label>

<textarea
name="description"
placeholder="Masukkan keterangan kegiatan..."
required></textarea>
</div>

<button class="btn" type="submit">
Ajukan Peminjaman
</button>

</form>

</div>

</div>

</body>
</html>