<?php

include '../config/database.php';

$id = $_GET['id'];

/*
|--------------------------------------------------------------------------
| VALIDASI ID
|--------------------------------------------------------------------------
*/

if (!isset($id) || $id == '') {
    echo "
    <script>
        alert('ID pengajuan tidak ditemukan!');
        window.location.href='../admin-dashboard.php';
    </script>
    ";
    exit;
}

/*
|--------------------------------------------------------------------------
| UPDATE STATUS RESERVATION MENJADI REJECTED
|--------------------------------------------------------------------------
*/

$query = mysqli_query($conn, "
    UPDATE reservations
    SET 
        status='rejected',
        notification='Pengajuan ditolak admin'
    WHERE id='$id'
");

/*
|--------------------------------------------------------------------------
| CEK HASIL
|--------------------------------------------------------------------------
*/

if ($query) {
    echo "
    <script>
        alert('Pengajuan berhasil ditolak!');
        window.location.href='../admin-dashboard.php';
    </script>
    ";
} else {
    echo "
    <script>
        alert('Gagal menolak pengajuan!');
        window.location.href='../admin-dashboard.php';
    </script>
    ";
}

?>