<?php
class MySQLDB
{
   var $connection;         //The MySQL database connection
   var $num_active_users;   //Number of active users viewing site
   var $num_active_guests;  //Number of active guests viewing site
   var $num_members;        //Number of signed-up users
   /* Note: call getNumMembers() to access $num_members! */

   /* Class constructor */
   function MySQLDB(){
      /* Make connection to database */
      $this->connection = mysql_connect(localhost, eric, 100259) or die(mysql_error());
      mysql_select_db(montco, $this->connection) or die(mysql_error());
      }
      
      function Query($sql){
      $result = mysql_query($sql, $this->connection);
      return $result;
      }
      function SearchCategory($category){
      $sql = "SELECT name, date, category, description, approved, location, price, id FROM events WHERE category LIKE '%$category%' "; 
      $result = mysql_query($sql, $this->connection);
      return $result;
      }
      function ListEvent($id){
      $sql = "SELECT name, date, category, description, approved, location, price, id FROM events WHERE id = '$id'"; 
      $result = mysql_query($sql, $this->connection);
      return $result;
      }
      function ListEvents(){
      $sql = "SELECT name, date, description, approved, id, expired FROM events WHERE approved = '1' AND expired='1'"; 
      $result = mysql_query($sql, $this->connection);
      return $result;
      }
      function DeleteEvent($id){
    
      
      $sql = "SELECT owner FROM events WHERE id = '$id'";
      $result = mysql_query($sql, $this->connection);
      if(!$result || (mysql_numrows($result) < 1)){
	 //Indicates username failure
	} else {
	      while($row = mysql_fetch_array($result))
		{	
			$owner = $row['owner'];
			$sql2 = "UPDATE users SET ads='ads -1' WHERE username = '$owner'";
			$result1 = mysql_query($sql2, $this->connection);
		}
	}
      $sql = "DELETE FROM montco.`events` WHERE id = '$id'"; 
      $result = mysql_query($sql, $this->connection);
      
      return $result;
      }
      function ListOwnEvents($name){
      $sql = "SELECT name, date, description, approved, id, owner, category, price, location, expires FROM events WHERE owner = '".$name."'"; 
      $result = mysql_query($sql, $this->connection);
      return $result;
      }
      
      //Looks for ads that expired yesterday and makes them expired
      //It updates users accounts to give them one more event
      //It looks for adds expired for two weeks and deletes them
      function CheckExpirations(){
      $todays_date = mktime(0,0,0,date("m"),date("d"),date("Y"));
      $expires = mktime(0,0,0,date("m"),date("d")-14,date("Y"));
      
      /*Set expired ads to 0
      $sql = "UPDATE events SET expired='0' WHERE expires < '$todays_date'";
      $result = mysql_query($sql, $this->connection);
      */
      
      //Select a list of owners from ads about to be deleted
      $sql = "SELECT owner FROM events WHERE expires < '$todays_date'";
      $result = mysql_query($sql, $this->connection);
      if(!$result || (mysql_numrows($result) < 1)){
	 //Indicates username failure
	} else {
	      while($row = mysql_fetch_array($result))
		{	
			$owner = $row['owner'];
			$sql2 = "UPDATE users SET ads='ads -1' WHERE username = '$owner'";
			$result1 = mysql_query($sql2, $this->connection);
		}
	}
	
      $sql = "DELETE FROM events WHERE expires < '$expires'";
      $result = mysql_query($sql, $this->connection);
      
      return $result;
      }
      
      function adlimit($username){
      $sql = "SELECT ads, adlimit FROM users WHERE username = '$username' "; 
      $result = mysql_query($sql, $this->connection);
      if(!$result || (mysql_numrows($result) < 1)){
								 //username not found
								 return 0;
							      } else {
								$row = mysql_fetch_array($result);
								$ads = $row['ads'];
								$adlimit = $row['adlimit'];
								//echo "++++++++++".$id;
								}
      if( $ads < $adlimit ){
      		return 1;
      		} else {
      		return 2;
      		}
      		
      
      }
};
/* Create database connection */
$database = new MySQLDB;
?>
