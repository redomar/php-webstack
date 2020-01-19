<?php 
include 'core/init.php';
protect_page();
protect_admin($session_user_id);
include 'includes/overall/header.php';
$title = 'Admin Panel';

if (empty($_POST) === false) {
		$user = $_POST['type'];
		
		$update_data = array(
			'allow_email' 		=> $user
		);
		
		update_user($_POST['user_id'], $update_data);
		
		$user_id	= $_POST['user_id'];
		$profile_data	= user_data($user_id, 'username', 'first_name', 'last_name', 'email', 'type');
		
		$errors[] = "<h4>User " . $profile_data['username'] . " Has been Updated</h4>";
		echo output_errors($errors);
		echo "
		
		<a href='mail.php'> Return </a>
		
		";
		exit();
	}
include 'includes/overall/footer.php';