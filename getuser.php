

<!DOCTYPE html>
<html>
<head>
<style>
    
    tableheading{
        font-size: 50px;
        color: #ffb900;
        font-weight: 300;
        text-transform: Uppercase;
        /*padding-bottom: 10px;*/
    }
table {
    width:80%;
    border-collapse:collapse;
    overflow-y: scroll;
    column-width:10px;
/*    padding: 10px;*/
    /*/max-heighth: 500px;*/
    
    
}

td {
    border: 1px solid #000;
    border-color: #000;/*#ffb900*/
    padding: 5px;
    text-align: center;
    
  
    
}
 th{
    text-align:center;
    border: 1px solid #000;
    color: #ffb900;
    background: black;
    padding: 10px;
 
}

/*th {text-align: center;}*/
</style>
    
</head>
<body>

<?php
$q = intval($_GET['q']);

    include('dbcreds.php');
    
$con = new mysqli($servername, $username, $password, $dbname);
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}else{
    //echo 'connected successfuly!!';
}

//    WHERE id = '".$q."'
  
//// SOBIE TABLE OPTION (Regsiters)   
    
//mysqli_select_db($con,$q);
    
switch($q){
        
    case '1':   
//$sql="SELECT * FROM sobie LIMIT 5";
  $sql="SELECT * FROM sobie";

$result = mysqli_query($con,$sql);
echo" <tableheading> Register Sign-ups</tableheading> ";
echo "<table>
<tr>
<th>First Name</th>
<th>Last Name</th>
<th>Type</th>
<th>Organization</th>
<th>Date Submitted</th>
</tr>";
    
while($row = mysqli_fetch_array($result)) {
    
    echo "<tr>";
    echo "<td>" . $row['first_name'] . "</td>";
    echo "<td>" . $row['last_name'] . "</td>";
    echo "<td>" . $row['type'] . "</td>";
    echo "<td>" . $row['organization'] . "</td>";
    echo "<td>" . $row['date_submitted'] . "</td>";;
    echo "</tr>";
}
echo "</table>";
    
  break;
        
        
//  EMAIL LIST  TABLE OPTION  (Email List)  
    case '2': 
        
    mysqli_select_db($con,$q);
$sql="SELECT * FROM emaillist";

$result = mysqli_query($con,$sql);
echo" <tableheading> Email List</tableheading> ";
echo "<table>
<tr>

<th>Email</th>

</tr>";
    
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    //echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
//    echo "<td>" . $row['Age'] . "</td>";
//    echo "<td>" . $row['Hometown'] . "</td>";
//    echo "<td>" . $row['Job'] . "</td>";
    echo "</tr>";
}
echo "</table>";
    
    
    break;
// INQUIRIES TABLE OPTION   (Inquiries)
    
    case '3':
    
    mysqli_select_db($con,$q);
$sql="SELECT * FROM inquiries";

$result = mysqli_query($con,$sql);
echo" <tableheading> Inquiries </tableheading> ";
echo "<table>
<tr>
<th> Name </th>
<th> Email </th>
<th> Phone </th>
<th> Subject </th>
<th> Message </th>

</tr>";
    
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['Name'] . "</td>";
    echo "<td>" . $row['Email'] . "</td>";
    echo "<td>" . $row['Telephone'] . "</td>";
    echo "<td>" . $row['Subject'] . "</td>";
    echo "<td>" . $row['Message'] . "</td>";
    echo "</tr>";
}
echo "</table>";
    
    break;
    
    case '4':
// QUICK Contact Information (Quick Contact)
    
mysqli_select_db($con,$q);
$sql = "SELECT first_name,middle_name,last_name,address,city,state,zip,phone,organization,total FROM sobie";;

$result = mysqli_query($con,$sql);
echo" <tableheading> Contact Information </tableheading> ";
echo "<table>
<tr>
<th>First Name</th>
<th>Middle Name</th>
<th>Last Name</th>
<th>Address</th>
<th>City</th>
<th>State</th>
<th>Zip</th>
<th>Phone</th>
<th>Organization</th>
<th>Total</th>


</tr>";
    
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['first_name'] . "</td>";
    echo "<td>" . $row['middle_name'] . "</td>";
    echo "<td>" . $row['last_name'] . "</td>";
    echo "<td>" . $row['address'] . "</td>";
    echo "<td>" . $row['city'] . "</td>";
    echo "<td>" . $row['state'] . "</td>";
    echo "<td>" . $row['zip'] . "</td>";
    echo "<td>" . $row['phone'] . "</td>";
    echo "<td>" . $row['organization'] . "</td>";
    echo "<td>" ."$". $row['total'] . "</td>";
    echo "</tr>";
}
echo "</table>";

//$sql = " SELECT first_name,middle_name,last_name,address,city,state,zip,phone,organization,total FROM sobie";
break;
        
}
mysqli_close($con);
        
?>
</body>
</html>