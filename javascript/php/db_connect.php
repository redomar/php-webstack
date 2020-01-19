<?php
	mysql_connect ('localhost','x','x');
	mysql_select_db ('redomarc_database');
	
	function user_exists($username) {
		return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username'"), 0) == 1) ? true : false;
	}
	
	function email_exists($email) {
		return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email` = '$email'"), 0) == 1) ? true : false;
	}
	
?>