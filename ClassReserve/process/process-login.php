<?php
session_start();

include '../config/database.php';

$email = $_POST['email'];
$password = $_POST['password'];

$query = mysqli_query($conn,
"SELECT * FROM users
WHERE email='$email'
AND password='$password'");

$data = mysqli_fetch_assoc($query);

if($data){

    $_SESSION['id'] = $data['id'];
    $_SESSION['name'] = $data['name'];
    $_SESSION['role'] = $data['role'];

    header("Location: ../dashboard.php");

} else {

    echo "
    <script>
        alert('Email atau password salah!');
        window.location.href='../login-student.php';
    </script>
    ";

}
if(str_contains($email, '@admin.com')){

    echo "
    <script>
        alert('Email admin tidak boleh digunakan untuk register mahasiswa!');
        window.location.href='../register.php';
    </script>
    ";

    exit;
}
?>