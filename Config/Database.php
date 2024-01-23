<?php
function getConnection(): PDO
{

    $host = 'localhost';
    $port = 3306;
    $dbname = "orakarik";
    $username = 'root';
    $password = '';

    return new PDO("mysql:host=$host:$port;dbname=$dbname", $username, $password);
}
?>