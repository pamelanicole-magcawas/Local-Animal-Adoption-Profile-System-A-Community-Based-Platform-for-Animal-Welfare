<?php

$host = "localhost";
$dbname = "signup_db";
$username = "root";
$password = "";

$mysqli = new mysqli(hostname: $host,username:  $username,password: $password,database: $dbname);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

return $mysqli;
?>