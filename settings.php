<?php
ob_start();
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';
$title = 'User Settings';

if (empty($_POST) === false) {
	$req_fields = array('first_name','last_name','email');
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $req_fields) === true) {
			$errors[] = 'All Fields are required and need to be filled in';
			break 1;
		}
	}
	
	if (empty($errors) === true){
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === true) {
			$errors[] = 'A valid email is required.';	
		} else if (email_exists($_POST['email']) === true && $user_data['Email'] !== $_POST['email']) {
			$errors[] = "Sorry, the E-mail '" . $_POST['email'] . "' is already in Use.";
		}
	}
}

?>

<h1>User Settings</h1>

<?php

if (empty($_POST) === false) {	

	if(empty($_FILES['profile']['name']) === false){
		$allowed = array('jpg', 'jpeg', 'gif', 'png');
		$file_name = $_FILES['profile']['name'];
		$file_extn = strtolower(end(explode('.', $file_name)));
		$file_temp = $_FILES['profile']['tmp_name'];
		
		if(in_array($file_extn, $allowed) === true){
			change_profile_image($session_user_id, $file_temp, $file_extn);
			header('Location: index.php');
			exit();
		} else {
			$errors[] = 'sorry, the picture file type is not supported. Please try a ' . implode(', ', $allowed) . ' file format';
		}
		
	}
	}


if(isset($_GET['success']) === true && empty($_GET['success']) === true) {
		$title = 'User Settings';
		echo '<h2>You successfully Updated';
		exit();
	} else {

if (empty($_POST) === false && empty($errors) === true) {	

	$update_data = array(
			'first_name' 	=> $_POST['first_name'],
			'last_name' 	=> $_POST['last_name'],
			'email' 		=> $_POST['email'],
			'allow_email'	=> ($_POST['allow_email'] == 'on') ? 1 : 0,
			'public'		=> ($_POST['public'] == 'on') ? 0 : 1
		);
		
		update_user($session_user_id, $update_data);
		header('Location: settings.php?success');
		exit();
		
} else if (empty($errors) === false) {
	echo output_errors($errors);
}
	}
?>

<form action='' method='POST' enctype='multipart/form-data'>
	<ul>
		<li>
			Upload Profile Image:<br />
			<input type="file" name='profile' />
		</li>
		<li>
			First Name:<br />
			<input type="text" name="first_name" value="<?php echo $user_data['First_Name']; ?>"/>
		</li>
		<li>
			Last Name:<br />
			<input type="text" name="last_name" value="<?php echo $user_data['Last_Name']; ?>"/>
		</li>
		<li>
			Email:<br />
			<input <?php echo $email_related ?> type="text" name="email" value="<?php echo $user_data['Email']; ?>"/>
		</li>
		<li>
			<input <?php echo $email_related ?> type="checkbox" name="allow_email" <?php if($user_data['allow_email'] == 1) {echo 'checked="checked"';} ?>/>
			Do you want to recieve emails from us?
		</li>
		<li>
			<input type="checkbox" name="public" <?php if($user_data['public'] != 1) {echo 'checked="checked"';} ?>/>
			Do you want to be hidden from <a href='members.php'>members</a> page?
		</li>
		<!--<li>
			Time Zone:<br />
			<select class="textarea" name="zone">
				<option value='0'>United Kingdom</option>
				<option value='1'>Canada</option>
				<option value='2'>Somalia</option>
				<option value='3'>Japan</option>
			</select>
		</li>-->
		<li>
			<input type='submit' value='Update'>
			<input type='reset' value='Reset*'>
		</li>
	</ul>
</form>

<?php
include 'includes/overall/footer.php';
?>