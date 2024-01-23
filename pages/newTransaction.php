<?php
session_start();
require_once "../Config/Database.php";
$conn = getConnection();

$id_nama_coy = $_POST["id_nama"];
$id_nama_arr = explode(" - ", $id_nama_coy);
$id_customer = $id_nama_arr[0];
$nama = $id_nama_arr[1];

$tgl_transaksi = date("Y-m-d", strtotime($_POST["tgl_transaksi"]));

$id_nama_produk = $_POST["nama_produk"];
$id_nama_produk_arr = explode(" - ", $id_nama);
$id_produk = $id_nama_produk_arr[0];
$nama_produk = $id_nama_produk_arr[1];

$jumlah_produk = $_POST["jumlah_barang"];

$total_tagihan = $_POST["total_tagihan"];

$id_nama_kasir = $_POST["nama_karyawan"];
$id_nama_kasir_arr = explode(" - ", $id_nama_kasir);
$id_kasir = $id_nama_kasir_arr[0];
$nama_kasir = $id_nama_kasir_arr[1];



$sql = "INSERT INTO 'transaksi' ('id_pegawai', 'id_customer', 'tanggal_transaksi', 'id_barang', 'jumlah_barang', 'total_tagihan') VALUES
('$id_kasir', '$id_customer', '$tgl_transaksi', '$id_produk', '$jumlah_produk', '$total_tagihan');";

$conn->query($sql);
$conn->errorInfo();
