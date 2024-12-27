<?php
date_default_timezone_set('Asia/Jakarta');

$servername = "localhost";
$username = "root";
$password = "123456";
$db = "best_recipe"; //nama database

//create connection
$conn = new mysqli($servername, $username, $password, $db);

//check apakah ada error connection
if ($conn->connect_error) {
    //jika ada, hentikan script dan tampilkan pesan error
    die("Connection failed: " . $conn->connect_error);
}

//echo "Connected successfully<hr>";
?>