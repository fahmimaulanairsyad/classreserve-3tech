<?php

include '../config/database.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

if(mysqli_num_rows($check) > 0){
    echo "Email sudah terdaftar";
    exit;
}
$query = "INSERT INTO users(name,email,password,role)
VALUES('$name','$email','$password','student')";

mysqli_query($conn, $query);

header("Location: ../login-student.php");

?>