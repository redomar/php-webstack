<?php

function feedback_data($name, $email, $message){
	htmlentities(mysql_real_escape_string($name));
	htmlentities(mysql_real_escape_string($email));
	htmlentities(mysql_real_escape_string($message));
	
	mysql_query("INSERT INTO `feedback`(`name`, `email`, `message`) VALUES('$name', '$email', '$message') ");
	
}

function date_and_time(){
	
	date_default_timezone_set('Europe/London');
	
	$date = date('j\n\d M');
	
	return $date;
}

function currnt_year(){
	
	date_default_timezone_set('Europe/London');
	
	$date = date('Y');
	
	return $date;
}

function show_time_zone($user_id){
	
	$user_time = user_time_zone($user_id);
	
	if ($user_time == 1){
		return '\'America/Vancouver\'';
	} else if($user_time == 2){
		return '\'Africa/Mogadishu\'';
	} else if($user_time == 3){
		return '\'Asia/Tokyo\'';
	} else {
		return '\'Europe/London\'';
	}
	
}

function user_time_zone($user_id){
	
	$select = "SELECT `username`, `user_time_zone` FROM `users` WHERE `user_id` = '$user_id'";
	
	$query = mysql_fetch_array(mysql_query($select));
	
	if (empty($query['user_time_zone']) === true){
		return 0;
	} else {
		return $query['user_time_zone'];
	}
	
}

function current_time($zone, $user_expiry_time){
	date_default_timezone_set($zone);
	
	if (date('d M Y') !== date('d M Y', $user_expiry_time)){
		return date('D d M Y - H:i', $user_expiry_time);
	} else if (date('G', $user_expiry_time) > 23 && date('G', $user_expiry_time) <= 9){
		return "This Morning at " . date('H:i', $user_expiry_time);
	} else if (date('G', $user_expiry_time) > 20 && date('G', $user_expiry_time) <= 23){
		return "Tonight at " . date('H:i', $user_expiry_time);
	} else if (date('G', $user_expiry_time) > 17 && date('G', $user_expiry_time) <= 20){
		return "This Evening at " . date('H:i', $user_expiry_time);
	} else {
		return "Today at " . date('H:i', $user_expiry_time);
	}
}

function current_time_zones($zone){
	date_default_timezone_set($zone);
	$now = date('G');

	if ($now > 0 && $now < 9) {
		return "it is morning now and the time is " . date('H:i');
	} else if ($now > 10 && $now < 17) {
		return "it is day time now and the time is " . date('H:i');
	} else if ($now > 18 && $now < 22){
		return "it is evening now and the time is " . date('H:i');
	} else {
		return "it is night time now and the time is " . date('H:i');
	}
}

function search_result($search) {
	$returned_result = array();
	$where = "";
	
	$search = preg_split('/[\s]+/', $search);
	$total_keywords = count($search);
	
	foreach ($search as $key=>$keyword) {
		$where .= "`key_word` LIKE '%$keyword%' or `title` LIKE '%$keyword%' or `contents` LIKE '%$keyword%' or `categories`.`name` LIKE '%$keyword%'";
		if ($key != ($total_keywords - 1)){
			$where .= " AND ";
		}
	}
	
	$result = "SELECT  `posts`.`id` AS  `post_id` ,  `categories`.`id` AS  `category_id` ,  `title` ,  LEFT(`contents`, 50)as `contents` ,  `key_word` ,  `user` ,  `date_posted` ,  `categories`.`name` 
			FROM  `posts` 
			INNER JOIN  `categories` ON  `categories`.`id` =  `posts`.`cat_id`
			WHERE $where";
	$result_num = ($result = mysql_query($result)) ? mysql_num_rows($result) : 0;
	
	if($result_num === 0){
		return false;
	} else {
		
		while ($result_row = mysql_fetch_assoc($result)){
			
			$returned_result[] = array(
						'title' 	=>  $result_row['title'],
						'contents'	=>  $result_row['contents'],
						'user' 		=>  $result_row['user'],
						'name' 		=>  $result_row['name'],
						'post_id' 		=>  $result_row['post_id']
			);
			
		}
		
		return $returned_result;
		
	}
}

function mail_users($subject, $body, $sender) {
	$count = 0;
	$query = mysql_query("SELECT `email`, `first_name` FROM `users` WHERE `allow_email` = 1");
	$result = mysql_fetch_array($query);
	while (($row = mysql_fetch_assoc($query)) !== false){
		email($row['email'], $subject, "Hello " . $row['first_name'] . ",\n\n". $body . "\n\nYours faithfully " . $sender . "\nhttp://redomar.cu.cc");
		$count++;
	}
	
	email("jaden@redomar.cu.cc", $sender . " Has sent " . $count . " Messages", $sender . " Has sent Messages to" . $count . " Users\n------------------\n\nHello user \n\n Message: \n" . $body);
	
}

function email($to, $subject, $body) {
	mail($to, $subject, $body, 'From: jaden@redomar.cu.cc');
}

function ddd(){
	if (logged_in() !== false) {
	echo"
		<div>
			<form action='' method='POST' enctype='multipart/form-data'>
				<label for='upfile'>Upload File: </label>
				<input type='file' name='upfile'/></br>
				<label for='filename'>Name the File: </label>
				<input type='text' name='filename'/></br>
				<input type='submit' name='submit' value='upload'>
			</form>
	</div>";
	}

}

function protect_page() {
	if (logged_in() !== "C" && logged_in() !== "S") {
		header('Location: sorry.php');
		exit();
	}
}

function protect_page_redirect() {
	if (logged_in() == "C" || logged_in() == "S") {
		header('Location: sorry.php');
		exit();
	}
}

function protect_admin($user_id){
	$user_id = (int)$user_id;
	if(is_admin($user_id) === false){
		header('Location: kicked.php');
		exit();
	}
}

function array_sanitize(&$item) {
	$item = htmlentities(strip_tags(mysql_real_escape_string($item)));
}

function sanitize($data) {
	return htmlentities(strip_tags(mysql_real_escape_string($data)));	
}

function output_errors($errors) {
	$output = array();
	foreach($errors as $error) {
		$output[] = '<li>' . $error . '</li>';
	}
	return '<ul>' . implode('', $output) . '</ul>';
}
?>