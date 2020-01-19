<?php
include 'core/init.php';
protect_page_redirect();
$title = 'Logging In';
if(empty($_POST) === false) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$rememberme = $_POST['rememberme'];
	
	if (empty($username) === true	|| empty($password) === true) {
		$errors[] = 'Please enter both a Username and a Password.';
	} else if (user_exists($username) === false) {
		$errors[] = 'That Username doesn\'t exists, please register.';	
	} else if (user_active($username) === false) {
		$errors[] = 'The account is still unactiveated.';
	} else 	{
	
		if (strlen($password) > 32) {
			$errors[] = 'The Password you have entered is too long.';
		}
	
		$login = login($username, $password);
		if ($login === false) {
			$errors[] = 'You have entered the wrong username and password combination.';
		} else if ($rememberme == "on"){
			setcookie('User_id', $login, time()+(7*24*60*60));
			login_date($username);
			header("Location: " . $username);
			exit();
		} else{
			$_SESSION['User_id'] = $login;
			login_date($username);
			header("Location: " . $username);
			exit();
		}
	}
} else {
	if (logged_in() == "C" || logged_in() == "S") {
		$errors[] = 'You are already logged in.';
	} else {
		$errors[] = 'No Data Recived.';
	}
}
include 'includes/overall/header.php';
if (empty($errors) === false){
	echo '<h1>There was a problem when we tried to log you in</h1>';
	echo  output_errors($errors);
}
include 'includes/overall/footer.php';
?>