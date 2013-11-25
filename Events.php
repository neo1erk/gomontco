<?php 
include("include/session.php");
//include("include/database.php");
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
$session->ShowHeader("events");
?>
<div id="wrapper">
<!-- start page -->
<div id="page">
	<!-- start content -->
	<div id="content">
	<?php
		$com = $_GET['com'];
		switch($com){
		case 'details':
			$details = $_GET['details'];
			$result = $database->ListEvent($details);
					if(!$result || (mysql_numrows($result) < 1)){
						 echo "No ads found"; //Indicates username failure
					      } else {
						while($row = mysql_fetch_array($result))
						{
							$date = date("m-d-Y",$row['date']);
							echo '
								<table border=1 width="100%">
								<tr class="listing">
								<td align="right">'.$row['name'].'</td>
								<td>'.$row['category'].'</td>
								<td>'.$row['price'].'</td></tr>
								<tr>
								<td>'.$date.'</td>
								<td colspan="2">'.$row['location'].'</td></tr>
								<tr>
								<td colspan="4">'.$row['description'].'</td>
								</tr></table>';
							if($session->userlevel >= 9){
								echo '<form action="admincp" method="POST">
									<input type="hidden" name="com" value="delete" />
									<input type="hidden" name="id" value="'.$row['id'].'" />
									<input type="Submit" value="Delete this ad" />
									</form>';
							} 
						}
					}
		break;
		case 'category':
			$category = $_GET['category'];
			$result = $database->SearchCategory($category);
					if(!$result || (mysql_numrows($result) < 1)){
						 echo "No ads found"; //Indicates username failure
					      } else {
						while($row = mysql_fetch_array($result))
						{	
							$date = date("m-d-Y",$row['date']);
							echo '
								<table border=1 width="100%">
								<tr class="listing">
								<td>'.$row['name'].'</td>
								<td>'.$row['id'].'</td>
								<td>'.$row['category'].'</td>
								
								</tr>
								<tr>
								<td>'.$row['price'].'</td>
								<td>'.$date.'</td>
								<td colspan="1">'.$row['location'].'</td></tr>
								<tr>
								<td colspan="3">'.$row['description'].'</td>
								</tr></table>
								
								<br><hr><br>';
						}
					}
		break;
		default:
		echo'
			<div class="post">
				<h1 class="title"><a href="#">Welcome to Gomontco!</a></h1>
				<p class="byline"><small>Posted on October 1st, 2007 by <a href="#">Free CSS Templates</a></small></p>
				<div class="entry">
				<table class="events" width="100%"  summary="Event listing" COLS="4" BORDERCOLOR="white" BORDER="1">
						<colgroup>
					   <col width="15%">
					   <col width="30%">
					   <col width="55%">
					 
					</colgroup>
					<tr class="label">
						<td ><b>Date</b></td>
						<td ><b>Name</b></td>
						<td ><b>Description</B></td>
					
					</tr>';
					
					$result = $database->ListEvents();
				
					while($row = mysql_fetch_array($result))
					{	
						$date = date("m-d-Y",$row['date']);
						echo '
						<tr class="listing">
						<td>'.$date.'</td>
						<td><a href="Events.php?com=details&details='.$row['id'].'">'.
						$row['name'].'</a></td>
						<td>'.$row['description'].'</td>
						</tr>';
					}
		echo '			</table>

				
		
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
				<h2>Calendar of Events</h2>
				<div id="calendar_wrap">
					<table width="100%" summary="Calendar">
						<caption>
						October 2007
						</caption>
						<thead>
							<tr>
								<th abbr="Monday" scope="col" title="Monday">M</th>
								<th abbr="Tuesday" scope="col" title="Tuesday">T</th>
								<th abbr="Wednesday" scope="col" title="Wednesday">W</th>
								<th abbr="Thursday" scope="col" title="Thursday">T</th>
								<th abbr="Friday" scope="col" title="Friday">F</th>
								<th abbr="Saturday" scope="col" title="Saturday">S</th>
								<th abbr="Sunday" scope="col" title="Sunday">S</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<td abbr="September" colspan="3" id="prev"><a href="#" title="View posts for September 2007">&laquo; Sep</a></td>
								<td class="pad">&nbsp;</td>
								<td colspan="3" id="next">&nbsp;</td>
							</tr>
						</tfoot>
						<tbody>
							<tr>
								<td>1</td>
								<td>2</td>
								<td>3</td>
								<td id="today">4</td>
								<td>5</td>
								<td>6</td>
								<td>7</td>
							</tr>
							<tr>
								<td>8</td>
								<td>9</td>
								<td>10</td>
								<td>11</td>
								<td>12</td>
								<td>13</td>
								<td>14</td>
							</tr>
							<tr>
								<td>15</td>
								<td>16</td>
								<td>17</td>
								<td>18</td>
								<td>19</td>
								<td>20</td>
								<td>21</td>
							</tr>
							<tr>
								<td>22</td>
								<td>23</td>
								<td>24</td>
								<td>25</td>
								<td>26</td>
								<td>27</td>
								<td>28</td>
							</tr>
							<tr>
								<td>29</td>
								<td>30</td>
								<td>31</td>
								<td class="pad" colspan="4">&nbsp;</td>
							</tr>
						</tbody>
					</table>
				</div>
			</li>
			<li>
				<h2>Categories</h2>
				<ul>
					<li><a href="Events.php?com=category&category=club">Clubs</a></li>
					<li><a href="Events.php?com=category&category=bar">Bars</a></li>
					<li><a href="Events.php?com=category&category=music">Music</a></li>
					<li><a href="Events.php?com=category&category=sale">Sales</a></li>
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
