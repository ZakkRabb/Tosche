<?php
session_start();
require_once "../Config/Database.php";
$conn = getConnection();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_nama = $_POST["edit_id_nama"];
    $id_nama_arr = explode(" - ", $id_nama);
    $id = $id_nama_arr[0];
    $nama = $id_nama_arr[1];

    $id_transaksi = $_POST["edit_no_order"];
    
    
    $tgl_transaksi = date("Y-m-d", strtotime($_POST["edit_tanggal"]));

    $id_barang = $_POST["edit_id_barang"];
    $id_barang_arr = explode(" - ", $id_barang);
    $id_barang_id = $id_barang_arr[0];
    $nama_barang = $id_barang_arr[1];

    $jumlah = $_POST["edit_jumlah_barang"];
    $total = $_POST["edit_total_tagihan"];
    

    $sql = "UPDATE transaksi SET id_customer = '$id' ,  tanggal_transaksi = '$tgl_transaksi' , id_barang = $id_barang_id , jumlah_barang = $jumlah, total_tagihan = $total WHERE id_transaksi = $id_transaksi ;";

    // $conn->query($sql);
    $conn->exec($sql);
}
