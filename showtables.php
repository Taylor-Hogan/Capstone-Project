<?php
//db creds
include 'dbcreds.php';

if(isset($_POST['submit'])){
 $regsiters = $_POST['regsiters'];
$email = $_POST['email'];
$contact = $_POST['contactInfo'];
$inquries = $_POST['inquries'];
  

//get varsS


    // Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$option = isset($_POST['quicklook']) ? $_POST['quicklook'] : false;
   if ($regsiters) {

$sql = "SELECT id, first_name, last_name FROM sobie";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["first_name"]. " " . $row["last_name"]. "<br>";
    }
} else {
    echo "0 results";
}  
       
  
   } else if ($email) {
    
       $sql = "SELECT id, first_name, last_name FROM emaillist";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. $row["email"]. "<br>";
    }
} else {
    echo "0 results";
} 
}


}
   