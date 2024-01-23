<?php
require_once "../Config/Database.php";

$conn = getConnection();

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
}

$sql = "DELETE FROM transaksi WHERE id_transaksi = $id;";
$conn->query($sql);
