<?php

include("database.php");
//global $database;
class Session
{
   var $username;     //Username given on sign-up
   var $userid;       //Random value generated on current login
   var $userlevel;    //The level to which the user pertains
   var $time;         //Time user was last active (page loaded)
   var $logged_in;    //True if user is logged in, false otherwise
   var $userinfo = array();  //The array holding all user info
   var $url;          //The page url current being viewed


	function Session(){
	//$this->logged_in = false;
      	$this->time = time();
      	$this->startSession();
   	}

   /**
    * startSession - Performs all the actions necessary to 
    * initialize this session object. Tries to determine if the
    * the user has logged in already, and sets the variables 
    * accordingly. Also takes advantage of this page load to
    * update the active visitors tables.
    */
   	function startSession(){
   	global $database;
   	/**Check login if present */
	   	if(isset($_COOKIE['name']) && isset($_COOKIE['id'])){
	   		//Cookie found, now make sure its good
			//$this->logged_in = false;
			$this->username = $_COOKIE['name'];
	   		$q = "SELECT uid, level FROM users WHERE username = '$this->username'";
	   		$result =$database->Query($q);
	   		
	   		if(!$result || (mysql_numrows($result) < 1)){
				  //Indicates username failure
				  $this->logged_in = true;
				  $this->userlevel = 0;
				} else {

				      /* Retrieve password from result, strip slashes */
				      $dbarray = mysql_fetch_array($result);
				     
				      /* Validate that password is correct */
				      if($_COOKIE['id'] == $dbarray['uid']){
				      //Correct
				      $this->logged_in = true;
				      $this->userlevel = $dbarray['level'];
				      } else {
				      //Bad id number
				       	$this->logged_in = false;
					$this->userlevel = 0;
				      }
			}
		} else {
			$this->logged_in = false;
			$this->userlevel = 0;
					}
	}//end function
	function ShowHeader($page){
				echo '
				<img src="image.gif"/><div id="logo"> 
				<h1><a href="#">Gomontco </a></h1>
				
				<p>Find something to do</p>
				</div>
				<div id="menu">
				<ul id="main">';
				
					switch($page) {
					
					case("index"):
					echo '
					<li class="current_page_item"><a href="index.php">Home</a></li>
					<li><a href="Events.php">Events</a></li>
					<li><a href="Services.php">Services</a></li>
					<li><a href="About.php">About Us</a></li>';
					break;
					
					case("events"):
					echo '
					<li><a href="index.php">Home</a></li>
					<li  class="current_page_item"><a href="Events.php">Events</a></li>
					<li><a href="Services.php">Services</a></li>
					<li><a href="About.php">About Us</a></li>';
					break;
					
					case("services"):
					echo '
					<li><a href="index.php">Home</a></li>
					<li><a href="Events.php">Events</a></li>
					<li  class="current_page_item"><a href="Services.php">Services</a></li>
					<li><a href="About.php">About Us</a></li>';
					break;
					
					case("about"):
					echo '
					<li><a href="index.php">Home</a></li>
					<li><a href="Events.php">Events</a></li>
					<li><a href="Services.php">Services</a></li>
					<li  class="current_page_item"><a href="About.php">About Us</a></li>';
					break;
					
					default:
					echo '
					<li><a href="index.php">Home</a></li>
					<li><a href="Events.php">Events</a></li>
					<li><a href="Services.php">Services</a></li>
					<li><a href="About.php">About Us</a></li>';
					break;
					}
				
				
			/*Only show the following if they haved logged in  */
			if($this->userlevel >= 1){
				if($page == "usercp"){
				echo '<li class="current_page_item">';
				} else { 
				echo '<li>';
				}
				echo '<a href="usercp.php">User Control Panel</a></li>';
				
				}
			if($this->userlevel >= 9){
				if($page == "admincp"){
				echo '<li class="current_page_item">';
				} else { 
				echo '<li>';
				}
				echo '<a href="admincp.php">Admin Control Panel</a></li>';
				
				}
				echo '
				<!--<li><a href="#">Contact Us</a></li>-->
				</ul><!--
				<ul id="feed">
				<li><a href="#">Entries RSS</a></li>
				<li><a href="#">Comments RSS</a></li>
				</ul> -->
				</div>
				<!-- end header -->';
	}//End header function
	
	function ShowSidebar(){
	?>
	<li>
				<form id="searchform" method="get" action="#">
					<div>
						<input type="text" name="s" id="s" size="15" value="" />
						<br />
						<input type="submit" value="Search" id="x" />
					</div>
				</form>
			</li>
			<li>
					<h2>Login</h2>
			<?php
			/*Only show the following if they haved logged in  */
			if($this->logged_in == false){
				if($_GET['login'] == badname){
					echo 'Bad username';
				} elseif ($_GET['login'] == badpass){
					echo 'Bad password';
				}

				?>
				
					<form action="Login.php" method="Post">
					Username:<br />
					<input type="Text" name="pusername" />
					<br />
					Password:<br />
					<input type="password" name="psPassword" />
					<br />
					<input type="submit" value="Login" />
					<input type="hidden" name="psRefer" value="<? echo($_SERVER['REQUEST_URI']) ?>"
					</form><br>
					<a href="Register.php">Register</a> for free.
				</li>
			<?php 
			} else {
			?>
				<li>
				
				Welcome <?php echo $this->username; ?>.<br><br>
				<a href="Logout.php">Logout</a>
				</li>
			<?php
			}
	}
};
$session = new Session;
?>
