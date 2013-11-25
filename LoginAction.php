<?php
// Check if the information has been filled in

if(isset($_POST['pusername']) || isset($_POST['psPassword'])) {
	// No login information

	$pusername = $_POST['$pusername'];
	$psPassword = $_POST['$psPassword'];
	// Authenticate user
	$hDB = mysql_connect('localhost', 'eric', '100259');
	mysql_select_db('montcoS', $hDB);
	$sQuery = "Select userid, MD5(UNIX_TIMESTAMP() + userid + RAND(UNIX_TIMESTAMP())) uid 
	From ssers
	Where username = '$pusername'
	And password = password('$psPassword')";
	$hResult = mysql_query($sQuery, $hDB);
	if(mysql_affected_rows($hDB)) {
		$aResult = mysql_fetch_row($hResult);
		// Update the user record
		$sQuery = "
		Update tblUsers
		Set uid = '$aResult[1]'
		Where userid = $aResult[0]";
		mysql_query($sQuery, $hDB);
		// Set the cookie and redirect

		setcookie("session_id", $aResult[1]);
		if(!$psRefer) $psRefer = 'index.php';
		header('Location: '.$psRefer);
		} else {
		// Not authenticated
		header('Location: index.php?falied');
		}
	}
	}
	else {
	header('Location: Login.php?refer='.urlencode($psRefer));
} 
?>
