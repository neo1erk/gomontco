<?php 
include("include/session.php");
global $database;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<SCRIPT LANGUAGE="JavaScript">
function checkform()
{
	if (document.register.username.value == '')
	{
		// something is wrong
		alert('You need to enter a username');
		return false;
	}
	else if (document.register.password.value == '')
	{
		// something else is wrong
		alert('You need to enter a password');
		return false;
	}
	else if (document.register.email.value == '')
	{
		// something else is wrong
		alert('You need to enter an email address');
		return false;
	}
	// If the script gets this far through all of your fields
	// without problems, it's ok and you can submit the form

	return true;
}
</SCRIPT>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Showcase by Free CSS Templates</title>
<meta name="keywords" content="" />
<meta name="Showcase " content="" />
<link href="default.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>

<!-- start header -->

<?php
$session->ShowHeader("index");
?>
<div id="wrapper">
<!-- start page -->
<div id="page">
	<!-- start content -->
	<div id="content">
		<div class="post">
			<h1 class="title"><a href="#">Register</a></h1>
			<p class="byline"><small></a></small></p>
			<div class="entry">
			
				<?php
				
					$result = $_POST['status'];
					if($_GET['status']== "accepted"){
					echo '<p>Thank you for registering. Please check your email to finish signing up</p>';
					} else{
						switch ($result)
						{
							case'failed'://field missing
							echo '<p>You are missing some information</p>';
							break;
							
							case 'response':
							break;
							
							case 'applying':
							//Update database, check application
							$password = $_POST['password'];
							$username = $_POST['username'];
							$email = $_POST['email'];
							
							//Insert into database
					$b = "Insert INTO users (username, password, email, level) VALUES ('$username','$password','$email', '1')";
							$result = $database->Query($b);	
							
							//Build email
							$subject = "Thank you for registering on Gomontco.com";
					$body = 'Thank for registering. Please follow this link to finish your registration.<br><a 						href="Register.php?status=response&code='.$randnum.'">Register.php?status=response&code='.$randnum.'</a>';
							?>
							<script language="Javascript">
								location.href="Register.php?status=accepted"
							</script>
							<?php
							break;
							case 'nmtk'://name taken
							echo '<p>Your name was taken</p>';
							break;	
						}
					?>
					<p>Please fill in all fields marked with an asterisk(*).<p>
					<form action="Register.php" name="register" onSubmit="return checkform()" method="Post">
					Username: <input type="text" name="username"  size="15" value="" />*
					<br />
					Password: <input type="password" name="password" size="15" value="" />*
					<br />
					Email: <input type="text" name="email"  size="25" value="" />*
					<br />
					<input type="hidden" name="status" value="applying"/>
					<input type="submit" value="Register" />
					<?php
					}?>
				
			</div>
		</div>
		
	</div>
	<!-- end content -->
	
	<div id="sidebar1" class="sidebar">
		<ul>
			<li>
				<form id="searchform" method="get" action="#">
					<div>
						<input type="text" name="s" id="s" size="15" value="" />
						<br />
						<input type="submit" value="Search" id="x" />
					</div>
				</form>
			</li>
			</div>
	<!-- end sidebars -->
	<div style="clear: both;">&nbsp;</div>
</div>
<!-- end page -->
</div>
<div id="footer">
	<p>&copy;2007 All Rights Reserved. &nbsp;&nbsp; Design by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a>.</p>
</div>
</body>
</html>
