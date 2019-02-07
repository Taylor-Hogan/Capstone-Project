<?php
include('dbcreds.php');
/*
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  $result = $conn->query("SELECT * FROM `sobie`");

  if($result->num_rows > 1)
  {
  while($row = $result->fetch_assoc())
  {
  echo $row['id'] . "<br />";
  }
  }

  $conn->close();
 */

if (count($_POST) > 1) {

    // check that user answered the SPAM check correctly . . .
    if ($_POST['rand_answer'] == "" OR $_POST['rand_answer'] != $_POST['number1'] + $_POST['number2']) {
        die("SPAM check incorrect. Please go back.");
    }

    // collect post vars...
    $last_name = addslashes($_POST['last_name']);
    $middle_name = addslashes($_POST['middle_name']);
    $first_name = addslashes($_POST['first_name']);
    $pre = addslashes($_POST['pre']);
    $type = addslashes($_POST['type']);
    $address = addslashes($_POST['address']);
    $city = addslashes($_POST['city']);
    $state = addslashes($_POST['state']);
    $zip = addslashes($_POST['zip']);
    $email = addslashes($_POST['email']);
    $phone = addslashes($_POST['phone']);
    $fax = addslashes($_POST['fax']);

    $abstract_title = addslashes($_POST['abstract_title']);
    $abstract_topic1 = addslashes($_POST['abstract_topic1']);
    $abstract_topic2 = addslashes($_POST['abstract_topic2']);
    $abstract_sp_topic = addslashes($_POST['abstract_sp_topic']);
    $authors = addslashes($_POST['authors']);

    $abstract_title_2 = addslashes($_POST['abstract_title_2']);
    $abstract_topic1_2 = addslashes($_POST['abstract_topic1_2']);
    $abstract_topic2_2 = addslashes($_POST['abstract_topic2_2']);
    $abstract_sp_topic_2 = addslashes($_POST['abstract_sp_topic_2']);
    $authors_2 = addslashes($_POST['authors_2']);

    $presentationPref = (isset($_POST['presentationPref']) ? addslashes($_POST['presentationPref']) : '');
   
    $reg_type = addslashes($_POST['reg_type']);

    $proceedings = (isset($_POST['proceedings']) ? addslashes($_POST['proceedings']) : '');
    
     $journal_submission = (isset($_POST['journal_submission']) ? addslashes($_POST['journal_submission']) : '');
    
    $additional_person = (isset($_POST['additional_person']) ? addslashes($_POST['additional_person']) : '');
    
    $organization = addslashes($_POST['organization']);
    $total = addslashes($_POST['total']);


    $ext = strtolower(pathinfo($_FILES["f_up"]["name"], PATHINFO_EXTENSION));
    $ext_2 = strtolower(pathinfo($_FILES["f_up_2"]["name"], PATHINFO_EXTENSION));

    // insert data into mysql db...=
    //include('admin/dbpw176.php');
    //mysql_connect($host176,$user176,$pass176);
    //@mysql_select_db($user176) or die( "Unable to select database");
    //mysql_query("INSERT INTO sobie (last_name, middle_name, first_name, pre, type, address, city, state, zip, email, phone, fax, organization, abstract_title, abstract_topic1, abstract_topic2, abstract_sp_topic, authors, abstract_title_2, abstract_topic1_2, abstract_topic2_2, abstract_sp_topic_2, authors_2, reg_type, proceedings, journal_submission, additional_person, total, ext, ext_2, presentationPref, date_submitted) VALUES('$last_name', '$middle_name', '$first_name', '$pre', '$type', '$address', '$city', '$state', '$zip', '$email', '$phone', '$fax', '$organization', '$abstract_title', '$abstract_topic1', '$abstract_topic2', '$abstract_sp_topic', '$authors', '$abstract_title_2', '$abstract_topic1_2', '$abstract_topic2_2', '$abstract_sp_topic_2', '$authors_2', '$reg_type', '$proceedings', '$journal_submission', '$additional_person', '$total', '$ext', '$ext_2', '$presentationPref', NOW());
    //$last_id=mysql_insert_id();
    //mysql_close();

    $last_id = 0;

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $sql = "INSERT INTO sobie (last_name, middle_name, first_name, pre, type, address, city, state, zip, email, phone, fax, organization, abstract_title, abstract_topic1, abstract_topic2, abstract_sp_topic, authors, abstract_title_2, abstract_topic1_2, abstract_topic2_2, abstract_sp_topic_2, authors_2, reg_type, proceedings, journal_submission, additional_person, total, ext, ext_2, presentationPref, date_submitted) VALUES('$last_name', '$middle_name', '$first_name', '$pre', '$type', '$address', '$city', '$state', '$zip', '$email', '$phone', '$fax', '$organization', '$abstract_title', '$abstract_topic1', '$abstract_topic2', '$abstract_sp_topic', '$authors', '$abstract_title_2', '$abstract_topic1_2', '$abstract_topic2_2', '$abstract_sp_topic_2', '$authors_2', '$reg_type', '$proceedings', '$journal_submission', '$additional_person', '$total', '$ext', '$ext_2', '$presentationPref', NOW())";

    if ($conn->query($sql) === TRUE) {
        // we are good to go...
        $last_id = $conn->insert_id;
    } else {
        die('something went wrong...');
    }

    // if a file has been speficied...
    if ($_FILES['f_up']['tmp_name'] != '') {
        $document = $_FILES['f_up']['tmp_name'];
        move_uploaded_file($document, "abstracts/{$first_name}.{$last_name}.{$ext}");
    }

    if ($_FILES['f_up_2']['tmp_name'] != '') {
        $document = $_FILES['f_up_2']['tmp_name'];
        move_uploaded_file($document, "abstracts/{$first_name}.{$last_name}_2.{$ext_2}");
    }



    //This is the email sent to the submitter.
    // send letter...

    $message = "
Thank you for submitting your research to the SOBIE (Society of Business, Industry, and Economics). It is our pleasure to inform you that your paper(s) have been accepted for presentation at the SOBIE annual academic conference in Sandestin, Florida on April 19-21, 2019.

We look forward to seeing you in April.

AL Chow, SOBIE 2018 President
South Alabama University

David L. Black, SOBIE 2018 Conference Chairman
University of North Alabama

http://www.una.edu/sobie/
";


    $send_to = stripslashes($email);
    $subject = "SOBIE: Thank you for your submission";
    $headers = 'From:' . "sobie@una.edu" . "\n";
    $headers .= 'Reply-To:' . "sobie@una.edu" . "\n";
//	$headers .= 'MIME-Version: 1.0' . "\n";
//	$headers .= 'Content-type: text/html; charset=iso-8859-1';
    $add_params = '-r sobie@una.edu';

    mail($send_to, $subject, $message, $headers, $add_params);



// this is the Begining of the the submission form. (after you click submit this shows.) 
    echo '


<!DOCTYPE html>
<html>

<head>
	<title>Submission Successful</title>
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
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script> 
$(function(){
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
	<link href="//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,900,900italic,700italic"rel="stylesheet" type="text/css">
</head>

<body>
<!--header on Load-->
    <div id="header"></div>
	<!-- header -->

	<!-- banner -->
	<div class="inner_page_agile">
		<h3>Submission Successful</h3>
		

	</div>
	<!--//banner -->
	<!--/w3_short-->
	<div class="services-breadcrumb_w3layouts">
		<div class="inner_breadcrumb">

			<ul class="short_w3ls"_w3ls>
				<li><a href="index.html">Home</a><span>|</span></li>
				<li></li>
			</ul>
		</div>
	</div>
	<!--//w3_short-->
	<!-- /inner_content -->
	<div class="inner_content_info_agileits">
		<div class="container">
			<div class="tittle_head_w3ls">
            <br/>
            
			</div>
			<div class="inner_sec_grids_info_w3ls">
			
			        <div class="col-md-3 col-sm-4 banner_bottom_left">
			        	<div >

			        	</div>
			        </div>
				<div class="col-md-9 co-sm-8 banner_bottom_left">

					<p style="font-size:25px; font-weight:bold; margin-bottom:0px;">
            Thank you  for registering for SOBIE Conference at Sandestin Resort<br>  
                        April 19-21, 2017 - Destin, Florida<br /><br /><br />
					


					<b>Please make checks payable to SOBIE.<br />
					Mail to:</b><br />
					SOBIE<br />
					c/o David L. Black<br />
					Box 5198 / One Harrison Plaza<br />
					University of North Alabama<br />
					Florence, AL 35632<br /><br />';

    echo "<b>Total: \${$total}</b><br />";

    echo '<br style="clear:both;" />
					
					
				</div>
				

			</div>

			
		</div>
	</div>
	<!-- //inner_content -->
	
	
    <!--footer on Load-->
    <div id="footer"></div>
</body>

</html>
';

    // this is the end of the the submission form. 
}
// if there is no post data... display input form...
else {
    ?>
    <!DOCTYPE html>
    <html>

        <head>
            <title>Register</title>
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

        </head>

        <body>
            <!--header on Load-->
            <div id="header"></div>


            <!-- banner -->
            <div class="inner_page_agile">
                <h3>CONFERENCE REGISTRATION</h3>


            </div>

            <!--/w3_short-->
            <div class="services-breadcrumb_w3layouts">
                <div class="inner_breadcrumb">

                    <ul class="short_w3ls"_w3ls>
                        <li><a href="index.html">HOME</a><span>|</span></li>
                        <li>REGISTER</li>
                    </ul>
                </div>
            </div>
            <!--//w3_short-->
            <!-- /inner_content -->
            <div class="inner_content_info_agileits">
                <div class="container">

        
                    <form enctype="multipart/form-data" action="" method="post" name="register">


                        <br>
                    
                              <center>
                   <img src="images/sobielogo.jpg" alt="" width="30%" style=" padding-left:0px ;  border: 0px solid #000; box-shadow: 4px 4px 5px #444;" data-pagespeed-url-hash="3254628555" onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                   
                 <div class="clearfix"> </div> 
                       </center>
                        <br>
                        <div class="page_text2">
                     <p>  
                        <b >Sandestin Resort - <b style="color:blue;"> April 10-12, 2019 </b>- Destin, Florida</b> 
                        
                    </p>
                            
                        <p>
                            Please make your conference registration by <b style="color:blue;">Thursday, March 7th.</b>
                        </p>
    
                    <br>
                      
                        <br>
                        <p><b>All fields are required.</b> Submit a separate form for each individual attending.
                            Additionally, please note that to submit the form you must specify an abstract to
                            upload, and see the highlighted section at the bottom for security reasons. After the
                            form is submitted you will see a confirmation page with registration information.</p>
                        <br>

           </div>
          
                        <form>
<!--                            <div class="form-row">-->
                                <div class="form-group">
                                <label for="pre">Prefix:</label>
                                <select name="pre" class="form-control">
                                    <option selected>Choose...</option>
                                    <option>Dr.</option>
                                    <option>Mr.</option>
                                    <option>Mrs.</option>
                                    <option>Ms.</option>
                                </select>
                                </div>
                            <div class="form-group">
                                <label for="type">Type of Registration:</label>
                                <select name="type" class="form-control">
                                    <option selected>Choose...</option>
                                    <option>Faculty</option>
                                    <option>Professional</option>
                                    <option>Undergrad Student</option>
                                    <option>Graduate Student</option>
                                </select>
                            </div>
                                <div class="form-group">
                                    <label for="first_name">First Name:</label>
                                    <input type="text" class="form-control"name="first_name" placeholder="First Name">

                            </div>
                            <div class="form-group">
                                    <label for="middle_name">Middle Name:</label>
                                    <input type="text" class="form-control" name="middle_name" placeholder="Middle Name">
                            </div>
                            <div class="form-group">
                                    <label for="last_name">Last Name:</label>
                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                            </div>
                            <div class="form-group">
                                    <label for="inputAddress">Address:</label>
                                    <input type="text" class="form-control" name="address" placeholder="1234 Main St">
                            </div>
                            <div class="form-group">
                                    <label for="inputAddress">City:</label>
                                    <input type="text" class="form-control" name="city"placeholder="city">
                            </div>

                            <div class="form-group">
                                
                                    <label for="inputState">State:</label>
                                    <select name="state" class="form-control">
                                        <option selected>Choose...</option>
                                        <option value="AL">Alabama</option>
                                        <option value="AK">Alaska</option>
                                        <option value="AZ">Arizona</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="CA">California</option>
                                        <option value="CO">Colorado</option>
                                        <option value="CT">Connecticut</option>
                                        <option value="DE">Delaware</option>
                                        <option value="DC">Dist of Columbia</option>
                                        <option value="FL">Florida</option>
                                        <option value="GA">Georgia</option>
                                        <option value="HI">Hawaii</option>
                                        <option value="ID">Idaho</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IN">Indiana</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="ME">Maine</option>
                                        <option value="MD">Maryland</option>
                                        <option value="MA">Massachusetts</option>
                                        <option value="MI">Michigan</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MO">Missouri</option>
                                        <option value="MT">Montana</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NV">Nevada</option>
                                        <option value="NH">New Hampshire</option>
                                        <option value="NJ">New Jersey</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="NY">New York</option>
                                        <option value="NC">North Carolina</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="OH">Ohio</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="OR">Oregon</option>
                                        <option value="PA">Pennsylvania</option>
                                        <option value="RI">Rhode Island</option>
                                        <option value="SC">South Carolina</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="TX">Texas</option>
                                        <option value="UT">Utah</option>
                                        <option value="VT">Vermont</option>
                                        <option value="VA">Virginia</option>
                                        <option value="WA">Washington</option>
                                        <option value="WV">West Virginia</option>
                                        <option value="WI">Wisconsin</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                            </div>
                             <div class="form-group">
                                    <label for="inputZip">Zip:</label>
                                    <input type="text" class="form-control" name
                                           ="zip" placeholder="Zipcode">
                            </div>

                             <div class="form-group">
                                    <label for="phone">Phone:</label>
                                    <input type="text" class="form-control" name
                                           ="phone" placeholder="Phone Number">
                            </div>
                             <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="text" class="form-control" name
                                           ="email" placeholder="Email">
                            </div>
                             <div class="form-group">
                                    <label for="fax">Fax:</label>
                                    <input type="text" class="form-control" name
                                           ="fax" placeholder="Fax">
                            </div>
                             <div class="form-group">
                                    <label for="organization">University:</label>
                                    <input type="text" class="form-control" name
                                           ="organization" placeholder="University">
                            </div>

                                <div class="form-group">
                                    
                                <br/>
                                <center>      
                                    <h2>Presentaion Prefrence</h2><br/>
                                    <div class="form-check form-check-inline">

                                        <input class="form-check-input" type="radio" name="presentationPref" name
                                               ="presentationPrefWednesday" value="Wednesday">
                                        <label class="form-check-label" for="presentationPrefWednesday">Wedndesday,April,10</label>


                                        <input class="form-check-input" type="radio" name="presentationPref" name
                                               ="presentationPrefThursday" value="Thursday">
                                        <label class="form-check-label" for="presentationPrefThursday">Thursday,April,11</label>
<br/>
                                        <input class="form-check-input" type="radio" name="presentationPref" name
                                               ="presentationPrefFriday" value="Friday">
                                        <label class="form-check-label" for="presentationPrefFriday">Friday,April,12</label>

                                        <input class="form-check-input" type="radio" name="presentationPref" name
                                               ="presentationPrefNP" value="NP">
                                        <label class="form-check-label" for="presentationPrefNP">No Prefernce</label>
                                        <br/>
                                        <br/>
                                        <h3>SOBIE will make every effort to accommodate your request for presentation.</h3>

                                    </div>
                                </center>
                            </div>
                                <br/>
                                <br/>
 <div class="form-group">
                                <h3> Abstract</h3>
                                <div class="form-group">
                                    <label for="abstract_title">Title:</label>
                                    <input type="text" class="form-control" name="abstract_title"       placeholder="Title">
     </div>
      <div class="form-group">
<!--                                    <div class="form-row">-->
                                        <label for="abstract_topic1">Primary Topic:</label>
                                        <select name="abstract_topic1" class="form-control">
                                            <option> Choose..</option>
                                            <option>Accounting</option>
                                            <option>Business Analytics</option>
                                            <option>Business Law</option>
                                            <option>Computer Information Services</option>
                                            <option>Economics</option>
                                            <option>Entrepreneurship</option>
                                            <option>Finance</option>
                                            <option>Management</option>
                                            <option>Marketing</option>
                                            <option>Pedagogy</option>
                                            <option>Public Administration</option>
                                            <option>Other</option>
                                        </select>
     </div>
           <div class="form-group">
                                        <label for="abstract_topic2">Secondary Topic:</label>
                                        <select name="abstract_topic2" class="form-control">
                                            <option> Choose..</option>
                                            <option>Accounting</option>
                                            <option>Business Analytics</option>
                                            <option>Business Law</option>
                                            <option>Computer Information Services</option>
                                            <option>Economics</option>
                                            <option>Entrepreneurship</option>
                                            <option>Finance</option>
                                            <option>Management</option>
                                            <option>Marketing</option>
                                            <option>Pedagogy</option>
                                            <option>Public Administration</option>
                                            <option>Other</option>
                                        </select>
     </div>
      <div class="form-group">
                                        <label for="abstract_sp_topic">Specialized Topic:</label>
                                        <select name="abstract_sp_topic" class="form-control">
                                            <option> Choose..</option>
                                            <option>Accounting: Accounting Education</option>
                                            <option>Accounting: Ethics</option>
                                            <option>Accounting: Financial Accounting</option>
                                            <option>Accounting: Managerial Accounting</option>
                                            <option>Accounting: Tax</option>
                                            <option>Business Analytics</option>
                                            <option>Business Law</option>
                                            <option>Computer Information Services: Applications</option>
                                            <option>Computer Information Services: Systems</option>
                                            <option>Computer Information Services: Technology</option>
                                            <option>Economics: General</option>
                                            <option>Economics: Growth &amp; Development</option>
                                            <option>Economics: International</option>
                                            <option>Economics: Sports Economics</option>
                                            <option>Finance: Corporate Finance</option>
                                            <option>Finance: International Finance</option>
                                            <option>Finance: Investments / Derivatives</option>
                                            <option>Finance: Real Estate</option>
                                            <option>Hospitality &amp; Tourism</option>
                                            <option>International Business</option>
                                            <option>Management: Business Ethics</option>
                                            <option>Management: Human Resource</option>
                                            <option>Management: Leadership</option>
                                            <option>Management: Organizational Behavior</option>
                                            <option>Management: Quality Management</option>
                                            <option>Management: Strategic</option>
                                            <option>Marketing: E-Commerce &amp; Technology</option>
                                            <option>Marketing: International Marketing</option>
                                            <option>Marketing: Strategy &amp; Sales</option>
                                            <option>Pedagogy</option>
                                            <option>Project Management</option>
                                            <option>Public Administration</option>
                                            <option>Other</option>
                                        </select>
                                    </div> 
      <div class="form-group">
                                    <label for="Author(s)">Author(s) (List Primary First):</label>
                                    <input type="text" class="form-control" name="authors" placeholder="Author(s)">
     </div>
      <div class="form-group">
                                    <div class="upload">
                                    <!--UPLOAD BUTTTON DOESNT SHOW UP....-->
                               

                                        
                                    <label for="f_up">Upload Abstract:</label>
                                    
                                    <input type="file" name="f_up" accept=".txt, .rtf, .pdf, .doc, .docx, .xls, .xlsx" />
                                    </div>
           <div class="form-group">
                                    <!--<input style="border: solid 1px #FFF;color: yellow" type="file" name="f_up" id="fileToUpload">--> 
                                    <!--<input type="file"  value="Upload File Now" accept=".txt, .rtf, .pdf, .doc, .docx, .xls, .xlsx" />-->
                                    <!--</div>-->
                                    <!--    <button type="button" name="custom-button">CHOOSE A FILE </button>-->
                                    <!--SECOND ABSTRACT-->
                                    <br>
                                  
                                    </div> 
           <div class="form-group">
                                    <h3> 2nd Abstract (optional):</h3>
                                    <div class="form-group">
                                        <label for="abstract_title_2">Title:</label>
                                        <input type="text" class="form-control" name="abstract_title_2" placeholder="Title">
               </div>
<!--                                        <div class="form-row">-->
                <div class="form-group">
                                            <label for="abstract_topic1_2">Primary Topic:</label>
                                            <select name="abstract_topic1_2" class="form-control">
                                                <option> Choose..</option>
                                                <option>Accounting</option>
                                                <option>Business Analytics</option>
                                                <option>Business Law</option>
                                                <option>Computer Information Services</option>
                                                <option>Economics</option>
                                                <option>Entrepreneurship</option>
                                                <option>Finance</option>
                                                <option>Management</option>
                                                <option>Marketing</option>
                                                <option>Pedagogy</option>
                                                <option>Public Administration</option>
                                                <option>Other</option>
                                            </select>
               </div>
                <div class="form-group">
                                            <label for="abstract_topic2_2">Secondary Topic:</label>
                                            <select name
                                                    ="abstract_topic2_2" class="form-control">
                                                <option> Choose..</option>
                                                <option>Accounting</option>
                                                <option>Business Analytics</option>
                                                <option>Business Law</option>
                                                <option>Computer Information Services</option>
                                                <option>Economics</option>
                                                <option>Entrepreneurship</option>
                                                <option>Finance</option>
                                                <option>Management</option>
                                                <option>Marketing</option>
                                                <option>Pedagogy</option>
                                                <option>Public Administration</option>
                                                <option>Other</option>
                                            </select>
               </div>
                <div class="form-group">
                                            <label for="abstract_sp_topic_2">Specialized Topic:</label>
                                            <select name ="abstract_sp_topic_2" class="form-control">
                                                <option> Choose..</option>
                                                <option>Accounting: Accounting Education</option>
                                                <option>Accounting: Ethics</option>
                                                <option>Accounting: Financial Accounting</option>
                                                <option>Accounting: Managerial Accounting</option>
                                                <option>Accounting: Tax</option>
                                                <option>Business Analytics</option>
                                                <option>Business Law</option>
                                                <option>Computer Information Services: Applications</option>
                                                <option>Computer Information Services: Systems</option>
                                                <option>Computer Information Services: Technology</option>
                                                <option>Economics: General</option>
                                                <option>Economics: Growth &amp; Development</option>
                                                <option>Economics: International</option>
                                                <option>Economics: Sports Economics</option>
                                                <option>Finance: Corporate Finance</option>
                                                <option>Finance: International Finance</option>
                                                <option>Finance: Investments / Derivatives</option>
                                                <option>Finance: Real Estate</option>
                                                <option>Hospitality &amp; Tourism</option>
                                                <option>International Business</option>
                                                <option>Management: Business Ethics</option>
                                                <option>Management: Human Resource</option>
                                                <option>Management: Leadership</option>
                                                <option>Management: Organizational Behavior</option>
                                                <option>Management: Quality Management</option>
                                                <option>Management: Strategic</option>
                                                <option>Marketing: E-Commerce &amp; Technology</option>
                                                <option>Marketing: International Marketing</option>
                                                <option>Marketing: Strategy &amp; Sales</option>
                                                <option>Pedagogy</option>
                                                <option>Project Management</option>
                                                <option>Public Administration</option>
                                                <option>Other</option>
                                            </select>
                                        </div> 
                <div class="form-group">
                                        <label for="Author(s)">Author(s) (List Primary First):</label>
                                        <input type="text" class="form-control" name="authors_2" placeholder="Author(s)">
               </div>
               
                <div class="form-group">
                    <div class="upload">

                                <label for="f_up_2">Upload Abstract:</label>
                                         <br>
                                        
                                         
                                <input type="file" name="f_up_2" accept=".txt, .rtf, .pdf, .doc, .docx, .xls, .xlsx" />

                                        </div>
               </div>
                                        <!--    <button type="button" name="custom-button">CHOOSE A FILE </button>--> 


<br/>
                <div class="form-group">
                                        <td>Registration Type:</td><br>
                                        <td colspan="3">
                                            <input type="radio" name="reg_type" value="normal" id="normal" onchange="calc_total();" checked="true"/>
                                            <label for="normal">  Normal ($225) </label>
                                            <br/>
                                            <input type="radio" name="reg_type" value="student" id="student" onchange="calc_total();"/>
                                            <label for="student"> Student ($0) </label>
                                            <br/>
                                            <input type="radio" name="reg_type" value="late" id="late" onchange="calc_total();"/>
                                            <label for="late">  Late Registration ($240) </label>
                                        </td>
                                        <br><br>
                                        <td>Optional Selections:</td><br>
                                        <td colspan="3">

                                            <input type="checkbox" name="proceedings" value="yes" id="proceedings" onchange="calc_total();"/>
                                            <label for="proceedings">  Proceedings ($25) </label>
                                            <br/>
                                            <input type="checkbox" name="journal_submission" value="yes" id="journal_submission" onchange="calc_total();"/>
                                            <label for="journal_submission"> Journal Submission ($50)</label>
                                            <br/>
                                            <input type="checkbox" name="additional_person" value="yes" id="additional_person" onchange="calc_total();"/>
                                            <label for="additional_person"> Additional person attending breakfast on April 17th ($25)</label>
                                        </td>

                                        <br><br><br>
                                        <b>Total: </b><br>
                                        <br>
                                        <td colspan="3">
                                            $
                                            <input type="text" name="total" size="10" readonly="true" value="225"/>
                                        </td>


                                        <p> <center>
                                            <br/>
                                            <b> Please make checks payable to SOBIE. <br/> Mail to:</b>
                                            <br/>
                                            SOBIE
                                            <br/>
                                            c/o David L. Black
                                            <br/>
                                            Box 5198 / One Harrison Plaza
                                            <br/>
                                            University of North Alabama
                                            <br/>
                                            Florence, AL 35632
                                            <br/>
                                            <br/>
                                        </center>
                                        
                                        </p>
                              
               </div>
                                        <div class="form-group">
                                        <form action="W-9 FORM.pdf">
                                    <a  href="pdfs/w9form.pdf"target="_blank">Download W9 Form</a>
                                        </form>
                                                   
               </div>
                                        <br/>
                                        <br/>
 <div class="form-group">
                                        <input type="hidden" name="number1" id="number1" value=""/>
                                        <input type="hidden" name="number2" id="number2" value=""/>

                                        <script type="text/javascript">var num1 = Math.floor(Math.random() * 11) + 1;var num2 = Math.floor(Math.random() * 11) + 1;document.register.number1.value = num1;document.register.number2.value = num2;</script>

                                        <span style="background-color: #ffffaa;">
                                            <b style="color: red;">NOTE:</b>
                                            In order to prevent SPAM, we need you to add:
                                            <b>
                                                <script type="text/javascript">document.write(num1);</script>
                                            </b>
                                            +
                                            <b>
                                                <script type="text/javascript">document.write(num2);</script>
                                            </b>
                                            =
                                            <input type="text" name="rand_answer" size="2"/>
                                        </span>
                                        <br/>
                                        <br/>


                                        <center>
                                            <input type="submit" value="Submit Registration"/>
                                        </center>


               </div>
                                        <script type="text/javascript">function calc_total() {
                         var reg = Number(0);
                         var proceedings = Number(0);
                         var journal_submission = Number(0);
                         var additional_person = Number(0);
                         if (document.register.reg_type[0].checked) {
                             reg = 225;
                         } else if (document.register.reg_type[1].checked) {
                             reg = 0;
                         } else if (document.register.reg_type[2].checked) {
                             reg = 240;
                         } else if (document.register.reg_type[3].checked) {
                             reg = 0;
                         }
                         if (document.register.proceedings.checked) {
                             proceedings = 25;
                         } else {
                             proceedings = 0;
                         }
                         if (document.register.journal_submission.checked) {
                             journal_submission = 50;
                         } else {
                             journal_submission = 0;
                         }
                         if (document.register.additional_person.checked) {
                             additional_person = 25;
                         } else {
                             additional_person = 0;
                         }
                         var total = reg + proceedings + journal_submission + additional_person;
                         document.register.total.value = total;
                     }
                     function validateFileType() {
                         var exts = new Array('txt', 'rtf', 'pdf', 'doc', 'docx', 'xls', 'xlsx');
                         var file1 = document.getElementsByName('f_up');
                         var file2 = document.getElementsByName('f_up_2');
                         var valid = false;
                         if (!file1 && !file2) {
                             valid = true;
                         } else {
                             if (file1.length > 0) {
                                 var ext1 = file1.substr(file1.lastIndexOf('.'), file1.length);
                                 for (var i = 0; i < exts.length; i++) {
                                     if (exts[i] == ext1) {
                                         valid = true;
                                         break;
                                     }
                                 }
                             }
                             if (file2.length > 0) {
                                 var ext2 = file2.substr(file2.lastIndexOf('.'), file2.length);
                                 for (var i = 0; i < exts.length; i++) {
                                     if (exts[i] == ext2) {
                                         valid = true;
                                         break;
                                     }
                                 }
                             }
                         }
                         return valid;
                     }</script>

                                        <br style="clear: both;"/>

                                    </div>
                                </div>

                            </div>
                            
                            
                            </div>
                            
            
            </div>
                            <script>(function (i, s, o, g, r, a, m) {
              i['GoogleAnalyticsObject'] = r;
              i[r] = i[r] || function () {
                  (i[r].q = i[r].q || []).push(arguments)
              }, i[r].l = 1 * new Date();
              a = s.createElement(o), m = s.getElementsByTagName(o)[0];
              a.async = 1;
              a.src = g;
              m.parentNode.insertBefore(a, m)
          })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
          ga('create', 'UA-40185345-1', 'una.edu');
          ga('send', 'pageview');</script>





                            <!--footer on Load-->
                            <div id="footer"></div>

                            </body>

                            </html>

    <?php
}
?>

