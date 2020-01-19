<?php
ob_start();
include 'core/init.php';
protect_page_redirect();
include 'includes/overall/header.php';

$title = 'Activate your account';

if (isset($_GET['success']) === true && empty($_GET['success']) === true) {
	$title = 'Activate your account';?>
    <h3>Your accout has been activated. To sign in put your username and password on the right menu</h3>
    <?php
}else if (isset($_GET['email'], $_GET['email_code']) === true) {
	
	$email		= $_GET['email'];
	$email_code	= $_GET['email_code'];
	
	if(email_exists($email) === false) {
		$errors[] = 'The Email does not exist or the code has expired';
	} else if (activate($email, $email_code) === false){
		$errors[] = 'Sorry, we had a problem with activating your acount';		
	}
	
	if(empty($errors) === false){
	?>
    
    <h2> Oops... </h2>
    
    <?php
		echo output_errors($errors);
	} else {
			header('Location: activate.php?success');
			exit();
	}
	
	} else {
	header('Location: index.php');
	exit();
}

include 'includes/overall/footer.php';
?>