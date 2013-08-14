<?php

$my_email = "Ralph@ems.com";

/*
info@emspecs.com
Enter the continue link to offer the user after the form is sent.  If you do not change this, your visitor will be given a continue link to your homepage.

If you do change it, remove the "/" symbol below and replace with the name of the page to link to, eg: "mypage.htm" or "http://www.elsewhere.com/page.htm"

*/

$continue = "/";

/*

Step 3:

Save this file (FormToEmail.php) and upload it together with your webpage containing the form to your webspace.  IMPORTANT - The file name is case sensitive!  You must save it exactly as it is named above!  Do not put this script in your cgi-bin directory (folder) it may not work from there.

THAT'S IT, FINISHED!

You do not need to make any changes below this line.

*/

$errors = array();

// Remove $_COOKIE elements from $_REQUEST.

if(count($_COOKIE)){foreach(array_keys($_COOKIE) as $value){unset($_REQUEST[$value]);}}

// Check all fields for an email header.

function recursive_array_check_header($element_value)
{

global $set;

if(!is_array($element_value)){if(preg_match("/(%0A|%0D|\n+|\r+)(content-type:|to:|cc:|bcc:)/i",$element_value)){$set = 1;}}
else
{

foreach($element_value as $value){if($set){break;} recursive_array_check_header($value);}

}

}

recursive_array_check_header($_REQUEST);

if($set){$errors[] = "You cannot send an email header";}

unset($set);

// Validate email field.

if(isset($_REQUEST['email']) && !empty($_REQUEST['email']))
{

if(preg_match("/(%0A|%0D|\n+|\r+|:)/i",$_REQUEST['email'])){$errors[] = "Email address may not contain a new line or a colon";}

$_REQUEST['email'] = trim($_REQUEST['email']);

if(substr_count($_REQUEST['email'],"@") != 1 || stristr($_REQUEST['email']," ")){$errors[] = "Email address is invalid";}else{$exploded_email = explode("@",$_REQUEST['email']);if(empty($exploded_email[0]) || strlen($exploded_email[0]) > 64 || empty($exploded_email[1])){$errors[] = "Email address is invalid";}else{if(substr_count($exploded_email[1],".") == 0){$errors[] = "Email address is invalid";}else{$exploded_domain = explode(".",$exploded_email[1]);if(in_array("",$exploded_domain)){$errors[] = "Email address is invalid";}else{foreach($exploded_domain as $value){if(strlen($value) > 63 || !preg_match('/^[a-z0-9-]+$/i',$value)){$errors[] = "Email address is invalid"; break;}}}}}}

}

// Check referrer is from same site.

if(!(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) && stristr($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST']))){$errors[] = "You must enable referrer logging to use the form";}

// Check for a blank form.

function recursive_array_check_blank($element_value)
{

global $set;

if(!is_array($element_value)){if(!empty($element_value)){$set = 1;}}
else
{

foreach($element_value as $value){if($set){break;} recursive_array_check_blank($value);}

}

}

recursive_array_check_blank($_REQUEST);

if(!$set){$errors[] = "You cannot send a blank form";}

unset($set);

// Display any errors and exit if errors exist.

if(count($errors)){foreach($errors as $value){print "$value<br>";} exit;}

if(!defined("PHP_EOL")){define("PHP_EOL", strtoupper(substr(PHP_OS,0,3) == "WIN") ? "\r\n" : "\n");}

// Build message.

function build_message($request_input){if(!isset($message_output)){$message_output ="";}if(!is_array($request_input)){$message_output = $request_input;}else{foreach($request_input as $key => $value){if(!empty($value)){if(!is_numeric($key)){$message_output .= str_replace("_"," ",ucfirst($key)).": ".build_message($value).PHP_EOL.PHP_EOL;}else{$message_output .= build_message($value).", ";}}}}return rtrim($message_output,", ");}

$message = build_message($_REQUEST);

$message = $message . PHP_EOL.PHP_EOL."-- ".PHP_EOL."";

$message = stripslashes($message);

$subject = "FormToEmail Comments";

$headers = "From: " . $_REQUEST['email'];

mail($my_email,$subject,$message,$headers);

?>

<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>Emergency Management Specialists</title>
	<meta name="description" content="Emergency Management Specialists">
    <meta name="keywords" content="emergency management, survival, search and rescue, washington, spokane, planning, training, comprehensive emergency management plan, SAR, disaster planning">
	<meta name="author" content="Michael Sherriffs Hall, www.mshall1.com">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	

	
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->


<link rel="stylesheet" id="base-css" href="style/base.css" type="text/css" media="all">
<link rel="stylesheet" id="skeleton-css" href="style/skeleton.css" type="text/css" media="all">
<link rel="stylesheet" id="layout-css" href="style/layout.css" type="text/css" media="all">

<link rel="stylesheet" id="custom-style-css" href="style/custom.css" type="text/css" media="all">



<!-- form
	================================================== -->

<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css">
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>




<!-- Favicons
	================================================== -->

<link rel="shortcut icon" href="favicon.ico" type="x-icon">
<link rel="icon" href="favicon.ico" type="x-icon">

     <style type="text/css">
     #send it {
	color: #000;
}
     </style>
</head>

<body onLoad="MM_preloadImages('Images/nav-down-ourcomp.png','Images/nav-down-services.png','Images/nav-down-people.png','Images/nav-down-contact.png','Images/nav-down-home.png')">
	
		<div id="st-wrapper">
        
                    	
	
		<section class="social-wrapper">
		<div>
                	<h1></a></h1>
          </div> 
			<div class="container">

			
			         

				
				
                
              <div class="seven columns">
                <img src="Images/EMS.png" alt="Emergency Management Specilists" width="395" height="133" class="scale-with-grid">
              </div>
			<div class="nine columns" >
             <img src="Images/header-phone.png" alt="(509) 443-1377" width="409" height="80" align="right" class="scale-with-grid">
             <p>&nbsp;</p>
             <p>&nbsp;<a name="top2"></a></p>
             
             <div class="navi">
             <a href="company.html" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image5','','Images/nav-down-ourcomp.png',1)"><img src="Images/nav-up-ourcomp.png" alt="Our Company" name="Image5" width="112" height="35" border="0"></a><a href="services.html" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image6','','Images/nav-down-services.png',1)"><img src="Images/nav-up-services.png" alt="Services" name="Image6" width="78" height="35" border="0" class="navibox"></a><img src="Images/nav-down-people.png" alt="Our People" name="Image7" width="116" height="35" border="0" class="navibox"><a href="contact.html" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image8','','Images/nav-down-contact.png',1)"><img src="Images/nav-up-contact.png" alt="Contact Us" name="Image8" width="95" height="35" border="0" class="navibox"></a><a href="index.html" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image9','','Images/nav-down-home.png',1)"><img src="Images/nav-up-home.png" alt="Home" name="Image9" width="48" height="35" border="0" class="navibox"></a> </div>
             
             </div>
			
				
				
			
            
            <div class="eleven columns">
            <p>&nbsp;</p>

           	  </div>
            
			</div>
			
		</section>
		
    	<!--   header   -->
    	<section id="header">
        	
			<header class="container clearfix">
			
               
  
				
			</header>
			
        </section>
        <!--   end header   -->
        	
					<!--   top-box   -->
        	<section id="top-box">
				
			</section>
        	<!--   end top-box   -->
			
						
				<!--   main-container   -->
				<section id="main-container" class="container" role="main">
                
                
<div class="sixteen columns logo">
  
  <p><img src="Images/news.png" width="429" height="31" alt="Our People"></p>  </div>
  
<div class="eleven columns">
   
   <p><strong>@@@@@This is a sample of text to be replaced.@@@@@</strong></p>
   <p> <strong>@@@@@Four score and seven years ago our fathers brought forth on this continent, a   new nation, conceived in Liberty, and dedicated to the proposition that all men   are created equal. </strong></p>
   <p><strong> Now we are engaged in a great civil war, testing whether that nation, or any   nation so conceived and so dedicated, can long endure. We are met on a great   battle-field of that war. We have come to dedicate a portion of that field, as a   final resting place for those who here gave their lives that that nation might   live. It is altogether fitting and proper that we should do this. </strong></p>
   <p><strong> But, in a larger sense, we can not dedicate -- we can not consecrate -- we can not   hallow -- this ground. The brave men, living and dead, who struggled here, have   consecrated it, far above our poor power to add or detract. The world will   little note, nor long remember what we say here, but it can never forget what   they did here. It is for us the living, rather, to be dedicated here to the   unfinished work which they who fought here have thus far so nobly advanced. It   is rather for us to be here dedicated to the great task remaining before us --   that from these honored dead we take increased devotion to that cause for   which they gave the last full measure of devotion -- that we here highly resolve   that these dead shall not have died in vain -- that this nation, under God, shall   have a new birth of freedom -- and that government of the people, by the people,   for the people, shall not perish from the earth.</strong>@@@@@</p>


     


   <h3>Thank you! <?php print stripslashes($_REQUEST['name']); ?></h3>
                  <h3>Your message has been sent.</h3>
                    <h2><a href="index.html">Click here to continue</a></h2>
<h3>&nbsp;</h3>



</div>  

  
<div class="clearfix"></div>

		  </section>
				<!--   end main-container   -->
				
				
		
		<!--   footer   -->
        <section id="footer">
        	
			
            <!--   copyright   -->
            <footer class="copy clearfix">
		
				
			
            	<div class="container">
					
                    <div class="sixteen columns">
						<p class="center">Copyright &#169; 2013 • Emergency Management Specialists LLC • All Rights Reserved.</p>
						
					</div>
							
				
					
				</div>
				
            </footer>
            <!--   end copyright   -->
			
        </section>
        <!--   end footer   -->
    </div>

</body></html>