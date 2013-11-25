<?php
include("include/session.php");
$sql = "UPDATE users SET uid='NULL' WHERE username='".$session->username."'";
$database->Query($sql);
setcookie('name','',time()-3600);	  
setcookie('id','',time()-3600);

header('Location: index.php');
?>
