<?php
ob_start();
include 'core/init.php';
protect_page();
$title = 'Change Password';

if (empty($_POST) === false) {	
	$req_fields = array('password_current','password','password_confirm');
		foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $req_fields) === true) {
			$errors[] = 'All Fields are required';
			break 1;
		}
	}
	
	if (md5($_POST['password_current']) === $user_data['Password']) {
		if (trim($_POST['password']) !== trim($_POST['password_confirm'])) {
			$errors[] = 'The passwords don\'t match';
		} else if (strlen($_POST['password']) <= 6) {
			$errors[] = 'The password is too short, please make a password more than 6 charaters';
		}
	} else {
		$errors[] = 'Your current password is wrong';
		if (trim($_POST['password']) !== trim($_POST['password_confirm'])) {
			$errors[] = 'The passwords don\'t match';
		} else if (strlen($_POST['password']) <= 6) {
			$errors[] = 'The password is too short, please make a password more than 6 charaters';
		}
	}
}
include 'includes/overall/header.php';
?>
<h1>Change Password</h1>

<?php 
	if(isset($_GET['success']) === true && empty($_GET['success']) === true) {
		$title = 'Change Password';
		echo '<h2>You successfully changed your Password</h2>';
		exit();
	} else {
	
	if(isset($_GET['force']) === true && empty($_GET['force']) === true) {
		$title = 'Change Password';
		?>
		
		<p>Please change your password. you can find a password in your email... use it as current and type out a new password</p>
		
		<?php
	}
	if (empty($_POST) === false && empty($errors) === true) {
		change_password($session_user_id, $_POST['password']);
		header('Location: changepwd.php?success');
	} else if (empty($errors) === false) {
		echo output_errors($errors);
	}
	}
?>

<form action="" method="POST" enctype="multipart/form-data">
	<ul>
		<li>
			Current Password:<br />
			<input type="password" name="password_current" />
		</li>
		<li>
			New Password:<br />
			<input type="password" name="password" />
		</li>
		<li>
			Confirm Password:<br />
			<input type="password" name="password_confirm" />
		</li>
		<li>
			<input type='submit' value='Change Password'>
			<input type='reset' value='Clear'>
		</li>
	</ul>
</form>

<?php include 'includes/overall/footer.php'; 

ob_end_flush();?>