<?php
session_start();
require_once "../Config/Database.php";
$conn = getConnection();

$nama_produk = $_POST["nama_p"];
$id_kategori = $_POST["id_kategori"];
$id_kategori_arr = explode("-", $id_kategori);
$kategori = $id_kategori_arr[0];
$namakat = $id_kategori_arr[1];
$harga = $_POST["harga_p"];
$stok = $_POST["stok_p"];


// $nama_produk = "skqoewpo";
// $kategori = 7;
// $harga = 90000;
// $stok = 2;



$sql = "INSERT INTO produk (nama_produk, kategori_produk, harga_produk, stok) VALUES
('$nama_produk', '$kategori', '$harga', '$stok');";

$conn->query($sql);
$conn->errorInfo();
