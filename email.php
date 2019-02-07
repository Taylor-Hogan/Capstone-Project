<html>
<body>


</body>
</html>


<?php

$email = addslashes($_POST['email']);

//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "sobie";

include('dbcreds.php');


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "INSERT INTO emaillist (email)
VALUES ('$email')";
// Check connection

if ($conn->query($sql) === TRUE) {

//    echo "New record created successfully";
    // I want this to go back to the active page that they subnmitd on. 
            
            header("Location:emailsignupthankyou.html");
    
    //alert("Email subscrbed Successfully! Thank you!!");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
