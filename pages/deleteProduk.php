<?php
require_once "../Config/Database.php";

$conn = getConnection();

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
}

$sql = "DELETE FROM produk where kode_produk = $id;";
$conn->query($sql);
