<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login-admin.php");
    exit;
}

include 'config/database.php';

$id = $_GET['id'];

$query = mysqli_query($conn,

"SELECT * FROM room_schedule
WHERE id='$id'");

$data = mysqli_fetch_assoc($query);

?>

<form action="process/update-jadwal.php" method="POST">

<input type="hidden" name="id"
value="<?php echo $data['id']; ?>">

<input type="text"
name="activity_name"
value="<?php echo $data['activity_name']; ?>">

<button type="submit">
Update
</button>

</form>