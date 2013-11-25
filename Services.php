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
$session->ShowHeader("services");
?>
<div id="wrapper">
<!-- start page -->
<div id="page">
	<!-- start content -->
	<div id="content">
		<div class="post">
			<h1 class="title"><a href="#">Welcome to Gomontco!</a></h1>
			<p class="byline"><small>Posted on October 1st, 2007 by <a href="#">Free CSS Templates</a></small></p>
			<div class="entry">
				<p><strong>Gomontco </strong> is something something something something something something something something something something something something something something something something something something something something something</p>
				
			</div>
		</div>
		
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
