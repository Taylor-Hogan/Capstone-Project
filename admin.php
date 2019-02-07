<?php
session_start();

if(!isset($_SESSION['username'])){
   header("Location:login.php");
    
    exit(0);
}
// ADDS SESSION USER TO VARIBLE to be used later
// this can be used in sobie admin page.
else{
    $username = $_SESSION['username'];
    
}
//if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
//
//    header("Location: login.php");
//}
?>

<html>

    <head>
        <title>Admin</title>
        <link rel="icon" type="images/logo-green.jpg"href="images/logo-green.jpg">
        <!--/tags -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <script type="application/x-javascript">
            addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
            }, false);

            function hideURLbar() {
            window.scrollTo(0, 1);
            }
        </script>
        <!--header and footer on load    -->
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script>
            $(function () {
                $("#header").load("header_footer_On_LOAD/header.html");
                $("#footer").load("header_footer_On_LOAD/footer.html");
            });
        </script> 
        <!--//tags -->
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />



        <link href="css/font-awesome.css" rel="stylesheet">
        <!-- //for bootstrap working -->
        <link href="//fonts.googleapis.com/css?family=Work+Sans:200,300,400,500,600,700" rel="stylesheet">
        <link href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,900,900italic,700italic'
              rel='stylesheet' type='text/css'>

        
        
        <style>
  
            button{
             font-size: 25px;
             align-content: center;
             
/*             background-color: green;*/
            }
    tableheading2{
         font-size: 50px;
        color: #ffb900;
        font-weight: 300;
        text-transform: Uppercase;
        /*padding-bottom: 10px;*/
    }
table {
    width:80%;
    border-collapse:collapse;
/*    overflow-y: scroll;*/
    column-width:1px;

/*    padding: 10px;*/
    /*/max-heighth: 500px;*/
    
    
}
 th{
    text-align:center;
    border: 1px solid #000;
    color: #ffb900;
    background: black;
    padding: 10px;
    font-size: 25px;
    text-transform: Uppercase;
   
     
  
 
}

td {
    border: 1px solid #000;
    border-color: #000;/*#ffb900*/
    padding: 12px;
    text-align: center;
    font-size: 25px;
    column-span: none; 
    border-radius:none;
    
}


/*th {text-align: center;}*/
</style>
        
        

    </head>

    <body>
        <!--header on Load-->
        <div id="header"></div>


        <!-- banner -->
        <div class="inner_page_agile">
            <h3>Administrator</h3>


        </div>
        <!--//banner -->
        <!--/w3_short-->
        <div class="services-breadcrumb_w3layouts">
            <div class="inner_breadcrumb">

                <ul class="short_w3ls"_w3ls>
                    <li><a href="index.html">Home</a><span>|</span></li>
                    <li>Administrator<span>|</span></li>
                    <li><a href="logout.php">Logout</a><span>|</span></li>
                     <li>  Logged in: <?= $username ?> </li>   
                    
                    <!--                     <li><form  action="logout.php">
                                                 <button  class="button"id="adminbutton" type="submit" value="Submit">Logout</button></form>-->
                </ul>
            </div>
        </div>
        <!--//w3_short-->


    <center>

<?php
//        echo getcwd();
//        $files = scandir('abstracts');
//        foreach ($files as $file) {
//          echo $file;
//        }
?>
        <script>
            function showUser(str) {
                if (str == "") {
                    document.getElementById("txtHint").innerHTML = "";
                    return;
                } else {
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("txtHint").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "getuser.php?q=" + str, true);
                    xmlhttp.send();
                }
            }
        </script>

            <br/> 
            <br/>
   
     
        <div class="page_text">
            

<tableheading2>  options </tableheading2>
<table class="tableheading2">
  <tr>
    <th>Options</th>
    
    <th>Button</th>
  </tr>
  <tr>
    <td>For Zip File of Abstracts</td>
    
    <td> <form method="POST" action="download.php">
                <button type="submit" name="submit">Abstracts</button>
            </form></td>
  </tr>
  <tr>
    <td>For Excel File of Registers</td>
    
    <td><form method="POST" action="exportRegister.php">
                <button type="submit">Registers</button>
            </form></td>
  </tr>
  <tr>
    <td>For Excel File of Conference Contacts</td>
  
    <td><form method="POST" action="contactExport.php">
                <button type="submit">Contact Info  </button>
            </form></td>
  </tr>
  <tr>
    <td>For Excel File of Email Sign-Ups</td>
 
    <td><form method="POST" action="exportEmailList.php">
        <button type="submit">Email List</button></form></td>
  </tr>
  
</table>

            
            
            
          </div>
        
         <br/> 
        <br/>
        
        <div class="page_text">            
            <p>  Use this box to show current entries</p>
             </div> 
              <br/>
            
            <form>
                <select name="users" onchange="showUser(this.value)">
                    <option value="">Choose an Table</option>
                    <option value="1">Registers</option>
                    <option value="2">Email List</option>
                    <option value="3">Inquiries</option>
                    <option value="4">Quick Contact</option>
                </select>
            </form>
                
               
            <br>
            
            <div id="txtHint" style="overflow-y: scroll; height:500px;">Table info will be listed here...</div>
            

        <br/>   
        <br/>





             
            
<!--            <p>Click Button Below for all abstracts</p>
            <br/>
            <form method="POST" action="download.php">
                <button type="submit" name="submit">ALL Abstracts</button>
            </form>
    
            
            <p>Click Button Below for List of Conference  Registers</p>
            <br/>
            <form method="POST" action="exportRegister.php">
                <button type="submit">Registers</button>
            </form>  
            <br/>   
            <br/> 
            <p>Click Button Below for List of Conference  Contacts</p>
            <br/>     
            <form method="POST" action="contactExport.php">
                <button type="submit">Registers Information</button>
            </form>
            <br/>      
            <br/> 
            <p>Click Button Below for List of Conference  Questions</p>
            <br/>     
            <form method="POST" action="exportQuestions.php">
                <button type="submit">Inquires</button>
            </form>  
            <br/>   
            <br/>  
            <p>Click Button Below for List of Email Sign-ups</p>
            <br/>    
            <form method="POST" action="exportEmailList.php">
                <button type="submit">Email List</button>
            </form>-->

       

    </center>
    <br/>   
    <br/>   
    <br/>








    <!--footer on Load-->
    <div id="footer"></div>
</body>

</html>
