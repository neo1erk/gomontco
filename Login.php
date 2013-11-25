<?php
include("include/database.php");
if(isset($_POST['pusername']) || isset($_POST['psPassword'])) {
//echo "name = ".$_POST['pusername']."<br> pass=".$_POST['psPassword'];
	if(isset($_POST['psRefer'])) {
		$refferer = $_POST['psRefer'];
		/*++ This needs to be fixed */
		//$refferer = "index.php";
		$password = $_POST['psPassword'];
		$username = $_POST['pusername'];
		
	} else {
		$refferer = "index.php";
	}

	//echo "<br>referer = ".$refferer;
	
	//should be moved to a seperate file or changed if switching databases
	
	
	$q = "SELECT password FROM users WHERE username = '$username'";
	$result =$database->Query($q);
      if(!$result || (mysql_numrows($result) < 1)){
           header('Location: index.php?login=badname');
         return 1; //Indicates username failure
      }

      /* Retrieve password from result, strip slashes */
      $dbarray = mysql_fetch_array($result);
      $dbarray['password'] = stripslashes($dbarray['password']);
      $password = stripslashes($password);

      /* Validate that password is correct */
      if($password == $dbarray['password']){
         //return 0; //Success! Username and password confirmed
       	//add in cookie creation and page reload
       	
       	srand((double)microtime()*1000000); 
	$id = rand(0,100000); 
       	$b = "UPDATE users SET uid='$id' WHERE username='$username'";
	$bresult = $database->Query($b);
 
       	setcookie('name',$username,time()+36000, '/');	  
       	setcookie('id',$id,time()+36000, '/');	  
       
        header("Location: $refferer");
      }
      else{
      header('Location: index.php?login=badpass');
      
         return 2; //Indicates password failure
      }
	
	
} else {

	?>
	<h2>Login</h2>
					<form action="Login.php" method="Post">
					Email Address:<br />
					<input type="Text" name="pusername" />
					<br />
					Password:<br />
					<input type="password" name="psPassword" />
					<br />
					<input type="submit" value="Login" />
					<input type="hidden" name="psRefer" value="<? echo($refferer) ?>"
					</form>
	<?php
}


?>
