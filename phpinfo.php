<?php

//echo phpinfo();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = 'sobie';

$conn = mysqli_connect($servername, $username, $password, $dbname);

$result = $conn->query("SELECT * FROM `sobie`");

if ($result->num_rows > 1) {
    while ($row = $result->fetch_assoc()) {
        echo $row['id'] . "<br />";
    }
}

/*
$conn = mysql_connect($servername, $username, $password);
mysql_select_db($dbname);

$result = mysql_query("SELECT * FROM `sobie`");
$row = mysql_fetch_array($result);

print_r($row);

mysql_close();
*/
