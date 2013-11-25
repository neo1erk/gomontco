<?php 
include("include/session.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<SCRIPT LANGUAGE="JavaScript">
/*Form to change your profile */
function checkformProfile()
{

	if (document.chgprofile.password.value == '')
	{
		// something else is wrong
		alert('You need to enter a password');
		return false;
	}
	else if (document.chgprofile.email.value == '')
	{
		// something else is wrong
		alert('You need to enter an email address');
		return false;
	}
	// If the script gets this far through all of your fields
	// without problems, it's ok and you can submit the form

	return true;
}


/*Form to add an ad */

function checkformAd()
{
	if (document.addad.name.value == '')
	{
		// something is wrong
		alert('You need to enter a name for your event');
		return false;
	}
	else if (document.addad.date.value == '')
	{
		// something else is wrong
		alert('You need to enter a date');
		return false;
	}
	else if (document.addad.description.value == '')
	{
		// something else is wrong
		alert('You need to enter a description of your event');
		return false;
	}
	else if (document.addad.category.value == '')
	{
		// something else is wrong
		alert('You need to enter a category');
		return false;
	}
	else if (document.addad.price.value == '')
	{
		// something else is wrong
		alert('You need to enter a price');
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
$session->ShowHeader("usercp");
?>
<div id="wrapper">
<!-- start page -->
<div id="page">
	<!-- start content -->
	<?php
	/*This is where the page switch happens */
	if(isset($_POST['com'])){ 
		$command = $_POST['com'];
		} else {
		$command = "default";
		}
	switch($command){
	case 'chgprofile':
	
	$password = $_POST['password'];
	$email = $_POST['email'];

	
		$sql = "SELECT userid FROM users WHERE username='".$session->username."'";
		//echo $sql."<br>";
		$result = $database->Query($sql);	
		
 		if(!$result || (mysql_numrows($result) < 1)){
								 //echo "No ads found"; //Indicates username failure
							      } else {
								$row = mysql_fetch_array($result);
								$id = $row['userid'];
								//echo "++++++++++".$id;
								}		
		
		$b = "UPDATE users SET email = '$email',  password = '$password' WHERE userid='$id'";
 		$database->Query($b);
 		
 		echo 'Your ad has been added. This page will reload automaticly <script language="Javascript">
								location.href="usercp.php"
							</script>';
	break;
	case 'addad':
		 foreach($_POST['category'] as $item)
			   {
				  $category .= $item.", ";
			   }
		$expires = mktime(0,0,0,$_POST['month'],$_POST['day']+1,$_POST['year']);	
		$date    = mktime(0,0,0,$_POST['month'],$_POST['day'],$_POST['year']);	
		$username = $session->username;
		$b = "Insert INTO events (name, date, description, category, price, owner, approved, location, expires, expired)". 
		"VALUES ('".$_POST['name']."', '$date', '".$_POST['description']."',".
		"'".$category."', '".$_POST['price']."', '$username', '0', '".$_POST['location']."', '$expires', '1')";
 		$database->Query($b);
 		$sql = "UPDATE users SET ads = ads + 1 WHERE username = '".$session->username."'";
 		$database->Query($sql);
 		//Update number of ads
 		echo 'Your ad has been added. This page will reload automaticly <script language="Javascript">
								location.href="usercp.php"
							</script>';
	break;
	case 'deleteAd':
		 $id = $_POST['id'];
		 $database->DeleteEvent($id);
 		echo 'Your ad has been added. This page will reload automaticly <script language="Javascript">
								location.href="usercp.php"
							</script>';
		
 		$sql = "UPDATE users SET ads = ads - 1 WHERE username = '$username'";
 		$database->Query($sql);
	break;
	
	
	case'default':
		echo '
		<div id="content"><p>Here you can change your personal preferences or list your own event.</p><br><br>
			<div class="post">
				<h1 class="title"><a href="#">Change Profile</a></h1>
				<p class="byline"><small></small></p>
				<div class="entry">
					<p>Please fill in all fields when changing your profile</p>
					<form name="chgprofile" onSubmit="return checkformProfile()" method="Post">
					
					Email <br><input type="text" name="email" size="20" /><br>
					Password <br><input type="text" name="password" size="25" /><br>
					<input type="hidden" name="com" value="chgprofile" />
					<input type="submit" value="Submit" />
					</form><br><br>
					<hr>
				</div>
			</div>
		
			<div class="post">
				<h1 class="title"><a href="#">Manage Events</a></h1>
				<p class="byline"><small></small></p>
				<div class="entry">
				<h2>Add an ad</h2>
				<p> All ads will expire the day after the event.</p>';
				
				//<!--Check to see if we are allowed more ads -->
					if($database->adlimit($session->username) == 1)
					{
					
					echo '
					<form name="addad" onSubmit="return checkformAd()" method="Post">
					Name <br><input type="text" name="name" size="30" /><br><br>
					Date of the event<br>Month: <select name="month">
					<option selected>1
					<option>2
					<option>3
					<option>4
					<option>5
					<option>6
					<option>7
					<option>8
					<option>9
					<option>10
					<option>11
					<option>12
					</select>
					Day: <select name="day">
					<option selected>1
					<option>2
					<option>3
					<option>4
					<option>5
					<option>6
					<option>7
					<option>8
					<option>9
					<option>10
					<option>11
					<option>12
					<option>13
					<option>14
					<option>15
					<option>16
					<option>17
					<option>18
					<option>19
					<option>20
					<option>21
					<option>22
					<option>23
					<option>24
					<option>25
					<option>26
					<option>27
					<option>28
					<option>29
					<option>30
					<option>31
					</select>
					Year: <select name="year">
					<option selected>2008
					<option>2009
					<option>2010
					</select>
					<br>
					Prices <br><input type="text" name="price" size="25" /><br>
					Location <br><input type="text" name="location" size="25" /><br><br>
					
					<h3>Categories</h3>
					
					Bar:<input type="checkbox" value="bar" name="category[]"><br />
					Sale:<input type="checkbox" value="sale" name="category[]"><br />
					Club:<input type="checkbox" value="club" name="category[]"><br />
					Music:<input type="checkbox" value="music" name="category[]"><br />
					
					<br>
					Description <br><textarea name="description" rows="10" cols="50"></textarea><br>
					
					<input type="hidden" name="com" value="addad" />
					<input type="submit" value="Submit" />
					</form>
					<hr>';
					} else {
					echo 'You have reached your maximum amount of ads';
					}
					echo '
					<br><br><h2>View ads</h2>';
					$result = $database->ListOwnEvents($session->username);
					if(!$result || (mysql_numrows($result) < 1)){
						 echo "No ads found"; //Indicates username failure
					      } else {
						while($row = mysql_fetch_array($result))
						{	
							$expires = date("m/d/Y", $row['expires']);
							echo '
								<table border=1 width="100%">
								<tr class="listing">
								<td>'.$row['name'].'</td>
								<td>'.$expires.'</td>
								<td>'.$row['category'].'</td>';
									if($row['approved']==0){
										echo '<td>Not yet approved</td>';
									} else {
										echo '<td>Approved</td>';
									}
							echo '
									
								</tr>
								<tr>
								<td>'.$row['price'].'</td>
								<td>'.$row['date'].'</td>
								<td colspan="2">'.$row['location'].'</td></tr>
								<tr>
								<td colspan="4">'.$row['description'].'</td>
								</tr></table>
								<form action="usercp.php" method="POST">
								<input type="hidden" name="com" value="deleteAd">
								<input type="hidden" name="id" value="'.$row['id'].'">
								<input type="submit" value="Delete">
								</form>
								<br><hr><br>';
						}
					}
				echo '
				</div>
			</div>';
	break;
	}
	/*Page switch end */
	?>
		
	</div>
	<!-- end content -->
	
	<div id="sidebar1" class="sidebar">
		<ul>
			<?php $session->ShowSidebar(); ?>
			<li>
				</li>
		</ul>
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
