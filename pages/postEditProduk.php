<?php
session_start();
require_once "../Config/Database.php";
$conn = getConnection();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_produk = $_POST["nama_p"];
    echo $nama_produk;
    $id_kategori = $_POST["id_kategori"];
    $id_kategori_arr = explode("-", $id_kategori);
    $kategori = $id_kategori_arr[0];
    $namakat = $id_kategori_arr[1];
    $harga = $_POST["harga_p"];
    $stok = $_POST["stok_p"];
    
    $sql = "UPDATE produk SET nama_produk = '$nama_produk' ,  kategori_produk = '$kategori' , harga_produk = '$harga', stok = $stok;";

    // $conn->query($sql);
    $conn->exec($sql);
}
