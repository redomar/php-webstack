<?php
require 'db_connect.php';

if (isset($_POST['username']) === true) {
	$username = mysql_real_escape_string($_POST['username']);
	
	if(empty($username) === false) {
		$user_result = user_exists($username);
		
		if($user_result == true) {
			echo "Username has been taken, try a different on";
		} else if($user_result == false) {
			echo "Username is available!";
		}
		
	}
}

?>