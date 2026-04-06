<?php
$host     = "sql211.infinityfree.com";
$user     = "if0_41512936";
$password = "lester123audije";
$dbname   = "if0_41512936_db_sis";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>