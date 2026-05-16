<?php
session_start();

include '../config/database.php';

$email = $_POST['email'];
$password = $_POST['password'];

/*
|--------------------------------------------------------------------------
| VALIDASI DOMAIN ADMIN
|--------------------------------------------------------------------------
*/

if(!str_contains($email, '@admin.com')){

    echo "
    <script>
        alert('Hanya akun admin yang bisa login!');
        window.location.href='../login-admin.php';
    </script>
    ";

    exit;
}

/*
|--------------------------------------------------------------------------
| CEK DATABASE
|--------------------------------------------------------------------------
*/

$query = mysqli_query($conn,
"SELECT * FROM users
WHERE email='$email'
AND password='$password'
AND role='admin'");

$data = mysqli_fetch_assoc($query);

/*
|--------------------------------------------------------------------------
| LOGIN BERHASIL
|--------------------------------------------------------------------------
*/

if($data){

    $_SESSION['admin'] = true;
    $_SESSION['admin_name'] = $data['name'];

    echo "
    <script>
        alert('Login admin berhasil!');
        window.location.href='../admin-dashboard.html';
    </script>
    ";

} else {

    echo "
    <script>
        alert('Email atau password admin salah!');
        window.location.href='../login-admin.php';
    </script>
    ";

}
?>