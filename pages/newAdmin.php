<?php
session_start();
require_once "../Config/Database.php";
$conn = getConnection();

$nama_karyawan = $_POST["nama_karyawan"];
$email = $_POST["email"];
$no_telp = $_POST["no_telp"];
$password = $_POST["password"];

$sql = "INSERT INTO `karyawan` (`nama`, `email`, `no_telepon`,`role`, `password`) VALUES
('$nama_karyawan', '$email', '$no_telp', 2, '$password');";

$conn->query($sql);
$conn->errorInfo();
