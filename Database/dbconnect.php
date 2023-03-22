<?php
$server = "localhost";
$username = "root";
$password = "";
$db = "dhhmusic";

$con = mysqli_connect($server, $username, $password, $db);
if (!$con) {
    echo "Database Is Not Connected";
}

// $server = "localhost";
// $username = "id20474993_root";
// $password = "Dipak@123456";
// $db = "id20474993_dhhmusic";

// $con = mysqli_connect($server, $username, $password, $db);
// if (!$con) {
//     echo "Database Is Not Connected";
// }
?>