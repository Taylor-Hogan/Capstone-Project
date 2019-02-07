<html>
    <head>

    </head>
    <body>    

        <?php
        $Name = addslashes($_POST['Name']);
        $Email = addslashes($_POST['Email']);
        $Telephone = addslashes($_POST['Telephone']);
        $Subject = addslashes($_POST['Subject']);
        $Message = addslashes($_POST['Message']);

//        $servername = "localhost";
//        $username = "root";
//        $password = "";
//        $dbname = "sobie";
        include('dbcreds.php');



// Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        $sql = "INSERT INTO inquiries (Email,Name,Telephone,Subject,Message)
VALUES ('$Email','$Name','$Telephone','$Subject','$Message')";

//var_dump($sql);
// Check connection

        if ($conn->query($sql) === TRUE) {

            echo "New record created successfully";
            // I want this to go back to the active page that they subnmitd on. 
            
            header("Location:contactthankyou.html");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
        ?>
        
       
        
<!--        MAIL FUNCTION-->
        
        
        
        <?php
//if "email" variable is filled out, send email
  if (isset($_REQUEST['Email']))  {
  
  //Email information
  $admin_email = "taylorwinstonhogan@gmail.com";
  $email = $_REQUEST['Email'];
  $subject = $_REQUEST['Subject'];
  $comment = $_REQUEST['Message'];
  
  //send email
  mail($admin_email, "$subject", $comment, "From:" . $Emailmail);
  
  //Email response
  echo "Thank you for contacting us, We will contact you shortly!";
  }
  
?>




    </body>
</html>