<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "classreserve";

$conn = mysqli_connect($host, $user, $password, $database);

if(!$conn){
    die("Koneksi database gagal");
}

?>