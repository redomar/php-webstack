<?php
ob_start();
include 'core/init.php';
protect_page_redirect();
include 'includes/overall/header.php';

$title = 'Register';

if(isset($_GET['success']) === true && empty($_GET['success']) === true) {
		$title = 'Register';
		echo '<h2>You successfully registered, thank you</h2><br /><h4>Your Account is inactive... Go to your email and press the activate link</br></br>And Sometimes it can go into your Junk Folder</h4></br><table><form action=\'activate.php\' method=\'GET\'><tr><td>Email you registered with:</td><td><input $email_related name=\'email\' /></td><tr></tr><td>The code on the Email:</td><td><input $email_related name=\'email_code\' /></td></tr><tr><td><input $email_related type=\'submit\' value=\'Activate\' /></td></tr></form></table>';
		exit();
	}

if (empty($_POST) === false) {
	$req_fields = array('username','password','password_confirm','first_name','last_name','email');
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $req_fields) === true) {
			$errors[] = 'All Fields are required';
			break 1;
		}
	}
	
	if(empty($errors) === true) {
		if (user_exists($_POST['username']) === true) {
			$errors[] = "Sorry, the Username '" . $_POST['username'] . "' already exists.";
		}
		if (email_exists($_POST['email']) === true) {
			$errors[] = "Sorry, the E-mail '" . $_POST['email'] . "' is already in Use.";
		}
		if(preg_match("/\\s/", $_POST['username']) == true){
			$errors[] = 'Your Username must not have a space.';
		}
		if (strlen($_POST['password']) <= 6 ) {
			$errors[] = 'Your Password must be 6 charaters or more.';
		}
		if ($_POST['password'] !== $_POST['password_confirm']) {
			$errors[] = 'Your Passwords do not match.';
		}
		if (empty($_POST['password_confirm']) === true) {
			$errors[] = 'Please write the same password again in confirm password.';
		}
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			$errors[] = 'A valid email is required.';
		}
	}
}

?>
<h1> Registeration Page </h1>

<!--<p>Registeration is closed! we are having problems with our email client. Please wait for further notice</p>-->
<?php
if (empty($_POST) === false) {
	if(empty($_POST) === false && empty($errors) === true){
		$register_data = array(
			'username' 		=> $_POST['username'],
			'password' 		=> $_POST['password'],
			'first_name' 	=> $_POST['first_name'],
			'last_name' 	=> $_POST['last_name'],
			'email' 		=> $_POST['email'],
			'email_code' 	=> md5($_POST['username'] + microtime()),
		);
		
		register_user($register_data);
		header('Location: register.php?success');
		exit();
	}else if (empty($errors) === false){
		echo output_errors($errors);
	}
}
?>

<form action="" method="POST" enctype="multipart/form-data">
	<table>
		<tr>
			<td>
				Username:<br />
				<input <?php echo $email_related ?> id="usernamejs" type="text" name="username" />
			</td>
			<td>
				<span class='dynamic_response' id="username_out" ></span>
			</td>
		</tr>
		<tr>
			<td>
				Password:<br />
				<input <?php echo $email_related ?> id="password" type="password" name="password" />
			</td>
			<td>
				<span class='dynamic_response' id="password_out" ></span>
			</td>
		</tr>
		<tr>
			<td>
				Confirm Password:<br />
				<input <?php echo $email_related ?> id="confirm" type="password" name="password_confirm" />
			</td>
			<td>
				<span class='dynamic_response' id="confirm_out" ></span>
			</td>
		</tr>
		<tr>
			<td>
				First Name:<br />
				<input <?php echo $email_related ?> type="text" name="first_name" />
			</td>
		</tr>
		<tr>
			<td>
				Last Name:<br />
				<input <?php echo $email_related ?> type="text" name="last_name" />
			</td>
		</tr>
		<tr>
			<td>
				Email:<br />
				<input <?php echo $email_related ?> id='emailjs' type="text" name="email" />
			</td>
			<td>
				<span class='dynamic_response' id="email_out" ></span>
			</td>
		</tr>
		<tr>
			<td>
				<input <?php echo $email_related ?> type="checkbox" name="allow_email" checked="checked"/><!---->
				Do you want to recieve emails from us?
			</td>
		</tr>
		<tr>
			<td>
				<input <?php echo $email_related ?> type='submit' value='Register'>
				<input <?php echo $email_related ?> type='reset' value='Clear'>
			</td>
		<tr>
	</table>
</form>

<?php include 'includes/overall/footer.php'; 

?>