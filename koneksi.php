<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "database_gas";  // Sesuaikan dengan nama database Anda

$kon = mysqli_connect($host, $user, $password, $db);
if (!$kon) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}
?>
