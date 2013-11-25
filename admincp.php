<?php 
include("include/session.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Showcase by Free CSS Templates</title>
<meta name="keywords" content="" />
<meta name="Showcase " content="" />
<link href="default.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>

<!-- start header -->

<?php
$session->ShowHeader("admincp");
$database->CheckExpirations();
?>
<div id="wrapper">
<!-- start page -->
<div id="page">
	<!-- start content -->
	<div id="content"><p>Here you can change sitewide preferences</p><br><br>
		<?php
		/*This is where the page switch begins */
		if(isset($_POST['com'])){ 
		$command = $_POST['com'];
		} else {
		$command = "default";
		}
		switch($command){
		case 'approveAd':
			$username = $session->username;
			$b = "UPDATE events SET approved='1' WHERE id='".$_POST['id']."'";
	 		$database->Query($b);
	 		echo 'This ad has been approved. This page will reload automaticly <script language="Javascript">
									location.href="admincp.php"
								</script>';
		break;
		case 'delete':
			$id = $_POST['id'];
			$database->DeleteEvent($id);
	 		echo 'This ad has been approved. This page will reload automaticly <script language="Javascript">
									location.href="admincp.php"
								</script>';
		break;
		
		case'default':
			echo '		
			<div class="post">
				<h1 class="title"><a href="#">Manage Users</a></h1>
				<p class="byline"><small></small></p>
				<div class="entry">
					<p>Form to manage users</p>
				
				</div>
			</div>
		
					<div class="post">
				<h1 class="title"><a href="#">Approve ads</a></h1>
				<p class="byline"><small></small></p>
				<div class="entry">
					<p>Form to approve or dissapprove of ads</p>';
				
					
					$q = 	"SELECT id , name , date, description, category, price, owner, approved, location FROM". 						" events WHERE approved ='0' ORDER BY id ASC";
	     				$result = $database->Query($q);
	     				while($row = mysql_fetch_array($result))
					{
						echo '
						<table border=1 width="100%">
						<tr class="listing">
						<td>'.$row['name'].'</td>
						<td>'.$row['id'].'</td>
						<td>'.$row['category'].'</td></tr>
						<tr>
						<td>'.$row['price'].'</td>
						<td>'.$row['date'].'</td>
						<td colspan="2">'.$row['location'].'</td></tr>
						<tr>
						<td colspan="3">'.$row['description'].'</td>
						</tr></table>
						<form action="admincp.php" method="POST">
						<input type="hidden" name="com" value="approveAd">
						<input type="hidden" name="id" value="'.$row['id'].'">
						<input type="submit" value="Approve">
						</form>
						<br><hr><br>';
					}
					
			echo '	
				</div>
			</div>
		
					<div class="post">
				<h1 class="title"><a href="#">Manage own events</a></h1>
				<p class="byline"><small></small></p>
				<div class="entry">
					<p>Form to manage own events</p>
				
				</div>
			</div>';
			break;
			}
			?>
		
		
	</div>
	<!-- end content -->
	
	<div id="sidebar1" class="sidebar">
		<ul>
			<?php $session->ShowSidebar(); ?>
			
			<li>
				<h2>Categories</h2>
				<ul>
					<li><a href="#">Aliquam libero</a></li>
					<li><a href="#">Consectetuer adipiscing elit</a></li>
					<li><a href="#">Metus aliquam pellentesque</a></li>
					<li><a href="#">Suspendisse iaculis mauris</a></li>
					<li><a href="#">Urnanet non molestie semper</a></li>
					<li><a href="#">Proin gravida orci porttitor</a></li>
					<li><a href="#">Aliquam libero</a></li>
					<li><a href="#">Consectetuer adipiscing elit</a></li>
					<li><a href="#">Metus aliquam pellentesque</a></li>
					<li><a href="#">Urnanet non molestie semper</a></li>
					<li><a href="#">Proin gravida orci porttitor</a></li>
					<li><a href="#">Aliquam libero</a></li>
					<li><a href="#">Consectetuer adipiscing elit</a></li>
					<li><a href="#">Metus aliquam pellentesque</a></li>
					<li><a href="#">Suspendisse iaculis mauris</a></li>
					<li><a href="#">Urnanet non molestie semper</a></li>
					<li><a href="#">Proin gravida orci porttitor</a></li>
				</ul>
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
