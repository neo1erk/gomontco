<?php
$tomorrow = mktime(0,0,0,date("m"),date("d"),2009);
$tom = date("m-d-Y", $tomorrow);
echo $tomorrow."<br>".$tom;
?>
