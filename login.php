<!DOCTYPE html>
<html>
    <head>


        <title> Admin Login</title>
        <link rel="icon" type="images/logo-green.jpg"href="images/logo-green.jpg">
        <link rel="stylesheet" a href="css\adminloginstyle.css">
        <link rel="stylesheet" a href="css\font-awesome.min.css">
    </head>
    <body>
        <div class="container">
            <img src="images/sobielogo.jpg"/>


            <form  action="proccess.php" method="post">
                <div class="form-input">
                    <input type="text" name="uname" placeholder="Enter the Username"/> 
                </div>
                <div class="form-input">
                    <input type="password" name="psw" placeholder="Password"/>
                </div>
                <input type="submit" type="submit" value="LOGIN" class="btn-login"/>
                <br>
                <br>
                <a href="index.html" input type="submit" type="submit" class="btn-login1">HOME</a>
<!--                < onclick="href=index.html" type="submit"value="HOME" class="btn-login"/>-->
                <br>
                   
<!--                    <button onclick="location.href='index.html'" type="button" value="HOME" class="btn-login1">
                    </button>-->
                    


            </form>
        </div>
    </body>
</html>