<?php
$hostname = "localhost";
$username = "akshaikh";
$password = "ZHF9s3Oq";
$database = "akshaikh";
$connect = mysqli_connect($hostname, $username, $password, $database);
if (!$connect) {
    $error = mysqli_connect_error();
}

?>