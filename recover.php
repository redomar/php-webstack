<?php
ob_start();
include 'core/init.php';
protect_page_redirect();
include 'includes/overall/header.php';
?>
<h1>Recover <?php if($_GET['mode'] === 'username'){
						echo 'Forgotten Username';
					} else if($_GET['mode'] === 'password'){
						echo 'Forgotten Password';
					} ?></h1>
<?php

if(isset($_GET['success']) === true && empty($_GET['success']) === true) {
	?>
	
	<p>Thank you. We've Emailed you your Username, thanks</p>
	
	<?php
} else {
	$mode_allowed = array('username', 'password');
	if (isset($_GET['mode']) === true && in_array($_GET['mode'], $mode_allowed) === true ) {
		
		if($_GET['mode'] === 'username'){
			$title = 'Forgot Username';
		} else {
			$title = 'Forgot Password';
		}
		
		if (isset($_POST['email']) === true && empty($_POST['email']) === false){
			if (email_exists($_POST['email']) === true){
				recover($_GET['mode'], $_POST['email']);
				header('Location: recover.php?success');
				exit();
			} else {
				echo '<p>that email address was not found, please try agian</p>';
			}
		}	
		?>
		
		<form action='' method='post'>
			
			<ul>
				<li>
					Please enter your E-Mail address:</br>
					<input type="text" name="email" />
				</li>
				<li>
					<input type="submit" value="Recover" />
				</li>
			</ul>
			
		</form>
		
		<?php
	} else {
		header('Location: index.php');
		exit();
	}
}

?>

<?php include 'includes/overall/footer.php' ?>