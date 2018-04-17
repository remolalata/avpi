<?php
// $servername = "localhost";
// $username = "avprimer_user";
// $password = "avpi1611101!";
// $dbname = "avprimer_db";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "av";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}
?>
