
 <?php session_start();

//echo session_id();

$loginname= trim($_POST['uname']);
$loginpwd= trim($_POST['psw']);
//$hash= password_hash($loginpwd,PASSWORD_DEFAULT);


include('dbcreds.php');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM admin where username = '". $loginname ."'";
//$sqlp = "SELECT * FROM accounts where password = '". $loginpwd ."'";
//$resultp = $conn->query($sqlp);
$result = $conn->query($sql);


//THIS NEEDS TO BE ADDED TO SOBIE Authentication.

if ($result->num_rows > 0) {
    // output data of each row
    if($row = $result->fetch_assoc()) {

        $epass= $row['password'];
        $valid= password_verify($loginpwd,$epass);
     if($valid) {
        $conn->close();
        // add user to session
        $_SESSION['username'] = $loginname;
        //redirect to users page 
        header("Location:admin.php");
        exit(0);
     }
   }
} 
header("Location:login.php");
$conn->close();

?>





<?php //session_start();

//$user = trim($_POST['uname']);
//$pass = trim($_POST['psd']);
//
////var_dump($_POST);
////$servername = "localhost";
////$username = "root";
////$password = "";
////$dbname = "sobie";
//include('dbcreds.php');
//
//// Create connection
//$conn = mysqli_connect($servername, $username, $password, $dbname);
//// Check connection
//if (!$conn) {
//    die("Connection failed: " . mysqli_connect_error());
//}
//
//$sql = "SELECT * FROM admin where username = '" . $user . "' ";
//$result = mysqli_query($conn, $sql);
//
//
//echo $sql;
//
//if($result->num_rows > 0){
//   if($row = $result->fetch_assoc()){
//     
////       echo " <br> Name: " . $row["username"]. "<br>  Pwd:" . $row["password"]. "<br>";
//       
//       $epass= $row['password'];
////       $storedPassword = password_hash($pass,PASSWORD_DEFAULT);
////       echo $storedPassword;
//       
//       $valid= password_verify($pass,$epass);
//       //echo $epass;
////       echo $valid;
//       if($valid){
//           $conn->close();
//           // add user to session
//           $_SESSION['username'] = $user;
////           redirect to admin page
//           header("Location: admin.php");
//           echo "<br>good to go";
//           exit(0);
//           
//       }
//   } 
//}
//else
//echo "<br>not ready";
////$conn->close();
////if (mysqli_num_rows($result) > 0) {
////    // output data of each row
////    while ($row = mysqli_fetch_assoc($result)) {
////        $phash = password_hash($pass, PASSWORD_DEFAULT);
////        $_SESSION['login'] = "1";
//////       / header("location: admin.php");
//////        echo "UserName: " . $row["username"]. " password" . $row["password"]. "<br>";
////    }
////} else {
////    $errorMessage = "Login FAILED";
////        session_start();
////				$_SESSION['login'] = '';
////    header("location: login.php");
////    
////} 
//
//
//mysqli_close($conn);
?>
