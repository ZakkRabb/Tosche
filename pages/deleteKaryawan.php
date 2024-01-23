<?php
require_once "../Config/Database.php";

$conn = getConnection();

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
}

$sql = "DELETE FROM karyawan WHERE id_karyawan = $id;";
$conn->query($sql);
