<?php


function username_to_userid($username){
	$query = mysql_query("SELECT `user_id` FROM `users` WHERE `username` = '$username'");
	$query = mysql_fetch_assoc($query);
	
	
	return $query;
}

function profile_data($user_id){
	$data = user_data($user_id, 'username', 'first_name', 'last_name', 'email', 'type', 'profile', 'bio', 'last_login');
	return $data;
}

function get_files($username = null){
	#$username = mysql_real_escape_string($username);
	$files = array();
	
	$query = "SELECT `users`.`user_id` AS `user_id`, `users`.`username` AS `username`, `file_id`, `directory`, `uploaded_date`
		FROM `userfiles`
		INNER JOIN `users` ON `users`.`username` = `userfiles`.`username`";
		
	if(isset($username) === true){
		$name = mysql_real_escape_string($name);
		
		$query .= " WHERE  `users`.`username` = '$username'";
	}
	
	$query .= " ORDER BY `file_id` DESC";
	
	$query = mysql_query($query); 
	
	while($row = mysql_fetch_assoc($query)){
		$files[] = $row;
	}
	
	return $files;
}

function remove_file($file, $userid){
	$data = profile_data($userid);
	$data = $data['username'];
	$query = "DELETE FROM `userfiles` WHERE `file_id` = '$file' AND `username` = '$data'";
	mysql_query($query);
	//unlink($dir)
}

function upload_file($username, $file_temp, $file_extn, $filename){
	$file_name = 'userfiles/' . mysql_real_escape_string($filename) . '.' . $file_extn;
	date_default_timezone_set('Europe/London');
	$date = date('Y-m-d H:i:s');
	move_uploaded_file($file_temp, $file_name);
	mysql_query("INSERT INTO `userfiles`(`username`, `directory`, `uploaded_date`) VALUES ('$username','" . mysql_real_escape_string($file_name) . "', '$date')");
}

function count_user_posts($name){
	$name = mysql_real_escape_string($name);
	$query = mysql_result(mysql_query("SELECT COUNT(`user`) FROM `posts` WHERE `user` = '$name'"), 0);
	return $query;
}

function login_date($username){
	date_default_timezone_set('Europe/London');
	$date = date('Y-m-d H:i:s');
	mysql_query("UPDATE `users` SET 
			`last_login`	= '$date' 
			WHERE `username` = '$username'");
}

function active_member($asc){
	
	$select = "SELECT * FROM `users`";
	if ($asc == 1){ $select .=" ORDER BY  `users`.`username` ASC";}
	$query = mysql_query($select);
	
	while($row = mysql_fetch_assoc($query)){
		$result[] = $row;
	}
	
	return $result;
}

function public_member($asc){
	
	$select = "SELECT * FROM `users` WHERE `public` = 1";
	if ($asc == 1){ $select .=" ORDER BY  `users`.`username` ASC";}
	if ($asc == 2){ $select .=" ORDER BY  `users`.`last_login` DESC";}
	$query = mysql_query($select);
	
	while($row = mysql_fetch_assoc($query)){
		$result[] = $row;
	}
	
	return $result;
}

function get_userid($id = null){
	$categories = array();
	
	$query = mysql_query("SELECT `user_id`, `username` FROM `users`");
	
	while($row = mysql_fetch_assoc($query)){
		$categories[] = $row;
	}
	
	return $categories;
}

function change_profile_image($user_id, $file_temp, $file_extn){
	$file_name = 'images/profile/' .substr(md5(time()), 0, 8) . '.' . $file_extn;
	move_uploaded_file($file_temp, $file_name);
	mysql_query("UPDATE `users` SET `profile` = '" . mysql_real_escape_string($file_name) . "' WHERE `user_id` = " . (int)$user_id);
}

function is_admin($user_id) {
	$user_id = (int)$user_id;
	
	return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `user_id` = '$user_id' AND `type` = 1"), 0) == 1) ? true : false;
}

function recover($mode, $email) {
	$mode 		= sanitize($mode);
	$email 		= sanitize($email);
	$user_data 	= user_data(user_id_from_email($email), 'user_id', 'first_name', 'username');	

	if ($mode == 'username'){
		email($email, 'Username Recovery for Redomar.cu.cc', "Hello " . $user_data['first_name'] . "\n\nYour user name was: " . $user_data['username'] . "\n\nhttp://redomar.cu.cc");
	} else if ($mode == 'password') {
		$generated_password = substr(md5(rand(999, 999999)), 0, 8);
		change_password($user_data['user_id'], $generated_password);
		update_user($user_data['user_id'], array('password_recover' => '1'));
		email($email, 'Password Recovery for Redomar.cu.cc', "Hello " . $user_data['first_name'] . "\n\nYour new password is: " . $generated_password . "\nYou MUST! change your password to use this username \n\nhttp://redomar.cu.cc");
	}

}

function activate($email, $email_code) {
	$email 		= mysql_real_escape_string($email);
	$email_code	= mysql_real_escape_string($email_code);

	ini_set('display_errors',1);

    error_reporting(E_ALL);	

	if (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM users WHERE `email` = '$email' AND `email_code` = '$email_code' AND active = 0"), 0) == 1) {
		mysql_query("UPDATE `users` SET `active` = 1 WHERE `email` = '$email'");
		return true;
	} else {
		return false;	
	}

}

function update_user($user_id, $update_data) {
	$update = array();
	array_walk($update_data, 'array_sanitize');
	
	foreach($update_data as $field=>$data){
			$update[] = '`' . $field . '` = \'' . $data . '\'';
	}

	mysql_query("UPDATE `users` SET " . implode(', ', $update) . " WHERE  `user_id` = " . $user_id) or die(mysql_error());

}

function change_password($user_id, $password){
	$user_id = (int)$user_id;
	$password = md5($password);
	
	mysql_query("UPDATE `users` SET `password` = '$password', `password_recover` = 0 WHERE `User_id` = $user_id");
}

function register_user($register_data) {
	array_walk($register_data, 'array_sanitize');
	
	$register_data['password'] = md5($register_data['password']);
	$fields = '`' . implode('`, `', array_keys($register_data)) . '`';
	$data = '\'' . implode('\', \'', $register_data) . '\'';

	mysql_query("INSERT INTO `users`($fields) VALUES($data)");
	email($register_data['email'], 'Redomar.cu.cc Email Activation', "Hello " . $register_data['first_name'] . ",\n\nUsername: " . $register_data['username'] . "\nEmail Activation Code: " . $register_data['email_code'] . " \n\nYou will need to activate your account for the first time only. \n\n http://redomar.cu.cc/activate.php?email=" . $register_data['email'] . "&email_code=" . $register_data['email_code'] . "\n\nif you have not registered from this website then ignore this \n\nhttp://redomar.cu.cc");
}

function user_count() {
	return mysql_result(mysql_query("SELECT COUNT(User_id) FROM users WHERE Active = 1"), 0);
}

function inactive_users() {
	return mysql_result(mysql_query("SELECT COUNT(User_id) FROM users WHERE Active = 0"), 0);
}

function user_data($user_id) {
	$data = array();
	$user_id = (int)$user_id;

	$func_num_args = func_num_args();
	$func_get_args = func_get_args();

	if ($func_num_args > 1) {
		unset($func_get_args[0]);

		$fields = '`' . implode('`, `', $func_get_args) . '`';
		$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `users` WHERE `User_id` = $user_id"));

		return $data;
	}
}

function logged_in() {
	if (isset($_SESSION['User_id'])){
		$loggedin = "S";
	}else if(isset($_COOKIE['User_id'])){
		$loggedin = "C";
	} else{
		$loggedin = false;
	}
	return $loggedin;
}

function user_exists($username) {
	$usrname = sanitize($username);	
	return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = '$username'"), 0) == 1) ? true : false;
}

function email_exists($email) {
	$email = sanitize($email);	
	return (mysql_result(mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE email = '$email'"), 0) == 1) ? true : false;
}

function user_active($username) {
	$usrname = sanitize($username);	
	return (mysql_result(mysql_query("SELECT COUNT(User_id) FROM users WHERE Username = '$username' AND Active = 1"), 0) == 1) ? true : false;
}

function user_id_from_username($username){
	$username = sanitize($username);
	return mysql_result(mysql_query("SELECT User_id FROM users WHERE Username = '$username'"), 0, 'User_id');
}

function user_id_from_email($email){
	$email = sanitize($email);
	return mysql_result(mysql_query("SELECT `user_id` FROM `users` WHERE `email` = '$email'"), 0, 'user_id');
}

function login($username, $password) {
	$user_id = user_id_from_username($username);
	$username = sanitize($username);
	$password = md5($password);

	return (mysql_result(mysql_query("SELECT COUNT(User_id) FROM users WHERE Username = '$username' AND Password = '$password'"), 0) == 1) ? $user_id : false;
}

?>