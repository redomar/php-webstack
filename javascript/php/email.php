<?php
require 'db_connect.php';

if (isset($_POST['email']) === true) {
	$email = htmlentities(mysql_real_escape_string($_POST['email']));
	
	if(empty($email) === false) {
		$user_result = email_exists($email);
		
		if($user_result == true) {
			echo "This email has been taken";
		} else if($user_result == false) {
			echo "Email ", $email;
		}
		
	}
}

?>