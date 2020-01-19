<?php
include 'core/init.php';
include 'includes/overall/header.php';
$title = 'Feedback';

if(isset($_GET['success'])){
	echo "<h3>Thanks For your Feedback </h3>";
	exit();
}

if(empty($_POST) === false){

	if (empty($_POST) === false) {
		$req_fields = array('name','email','message');
		foreach($_POST as $key=>$value) {
			if (empty($value) && in_array($key, $req_fields) === true) {
				$errors[] = 'All Fields are required';
				break 1;
			}
		}
	}
	
	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			$errors[] = 'A valid email is required.';
		}
	
	if(isset($errors) === true && empty($errors) === false){
		echo output_errors($errors);
		exit();
	} else {
		feedback_data($_POST['name'], $_POST['email'], $_POST['message']);
		email("Mohamed12@live.co.uk", "Feedback", $_POST['message']);
		header('Location: register.php?success');
		exit();
	}
	
}
?>
<h1>Feedback</h1>
<p>Thank you for visiting my website <? $smile = ":D"; $smile = $bb->Parse($smile); echo $smile; ?></p>
<p>I hope you liked seeing my website. I have put some good effort to make this site and I need feedback from users to make the site become more userfriendly. You are free to criticize as much as you feel like but don't over exaggerate <? $smile = ";)"; $smile = $bb->Parse($smile); echo $smile; ?> </p>
<p>If you found any Bugs and/or Issues regarding this site please Include in here. Thanks</p>

FORM IS NOW OPEN</br></br>

<form action="" method="POST"><table>
	<tr><td><h5>Your Name:</h5></td><td><input class="entry" name="name" type="text" placeholder="Name"/></td></tr>
	<tr><td><h5>Your Email:</h5></td><td><input class="entry" name="email" type="text" placeholder="Email"/></td></tr>
	<tr><td><h5>Your Feedback:</h5></td><td><textarea class="entry" id="entry" name="message" placeholder="Type your feedback here"></textarea></td></tr>
	<tr><td></td><td><input name="submit" type="submit" value="send"/></td></tr></table>
	
</form>

<?php include 'includes/overall/footer.php' ?>