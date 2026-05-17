<?php

include '../config/database.php';

$id = $_GET['id'];

$query = mysqli_query($conn, "
    UPDATE reservations
    SET 
        status='rejected',
        notification='Pengajuan ditolak admin'
    WHERE id='$id' AND status='pending'
");

if (mysqli_affected_rows($conn) > 0) {
    echo "
    <script>
        alert('Pengajuan berhasil ditolak!');
        window.location.href='../admin-dashboard.php';
    </script>
    ";
} else {
    echo "
    <script>
        alert('Pengajuan sudah diproses sebelumnya!');
        window.location.href='../admin-dashboard.php';
    </script>
    ";
}

?>