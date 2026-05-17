<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login-admin.php");
    exit;
}

session_start();

include 'config/database.php';

$query = mysqli_query($conn,

"SELECT reservations.*,
users.name

FROM reservations

JOIN users
ON reservations.user_id = users.id

ORDER BY reservations.id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>

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

        .table-card{
            background:white;
            padding:30px;
            border-radius:20px;
            box-shadow:0 5px 20px rgba(0,0,0,0.08);
            overflow:auto;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th{
            background:#065f46;
            color:white;
        }

        th, td{
            padding:15px;
            border:1px solid #ddd;
            text-align:center;
        }

        .approve-btn{
            background:#22c55e;
            color:white;
            border:none;
            padding:10px 15px;
            border-radius:8px;
            cursor:pointer;
        }

        .reject-btn{
            background:#ef4444;
            color:white;
            border:none;
            padding:10px 15px;
            border-radius:8px;
            cursor:pointer;
        }

        .pending{
            color:orange;
            font-weight:bold;
        }

        .approved{
            color:green;
            font-weight:bold;
        }

        .rejected{
            color:red;
            font-weight:bold;
        }

    </style>

</head>
<body>

<div class="sidebar">

    <h2>ClassReserve</h2>

    <ul>

        <li class="active-menu">
            Dashboard Admin
        </li>

        <li onclick="window.location.href='admin-jadwal.php'">
            Kelola Jadwal
        </li>

        <li onclick="window.location.href='process/logout.php'">
            Logout
        </li>

    </ul>

</div>

<div class="dashboard">

<h1 style="margin-bottom:30px;">
Daftar Pengajuan Peminjaman
</h1>

<div class="table-card">

<table>

<tr>
<th>Mahasiswa</th>
<th>Kegiatan</th>
<th>Ruangan</th>
<th>Tanggal</th>
<th>Status</th>
<th>Aksi</th>
</tr>

<?php while($data = mysqli_fetch_assoc($query)){ ?>

<tr>

<td>
<?php echo $data['name']; ?>
</td>

<td>
<?php echo $data['activity_name']; ?>
</td>

<td>
<?php echo $data['room_name']; ?>
</td>

<td>
<?php echo $data['reservation_date']; ?>
</td>

<td>

<?php
if($data['status'] == 'pending'){
echo "Pending";
}

if($data['status'] == 'approved'){
echo "Approved";
}
?>

</td>

<td>
    <?php if ($row['status'] == 'pending') : ?>
        <a href="process/approve.php?id=<?= $row['id']; ?>" class="btn-approve">
            Approve
        </a>

        <a href="process/reject.php?id=<?= $row['id']; ?>" class="btn-reject"
           onclick="return confirm('Yakin ingin menolak pengajuan ini?')">
            Reject
        </a>
    <?php else : ?>
        <span class="text-muted">Tidak ada aksi</span>
    <?php endif; ?>
</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</body>
</html>