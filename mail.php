<?php
include 'core/init.php';
protect_page();
protect_admin($session_user_id);
include 'includes/overall/header.php';
$title = 'Admin Panel - Mailing';

?>
<h1>Mail</h1>

<?php
if(isset($_GET['success']) === true && empty($_GET['success']) === true) {
$title = 'Admin Panel - Mailed';
?>
	<h3>Sent email to all users</h3>
<?php		
	} else {
	if(empty($_POST) === false) {
		if(empty($_POST['subject']) === true) {
			$errors[] = 'The subject was empty, please write the subject of the message' ;
		}
		
		if(empty($_POST['body']) === true) {
			$errors[] = 'The message was empty, please write out message' ;		
		}
		
		if(empty($errors) === true){
			$user_id	= $session_user_id;
			$profile_data	= user_data($user_id, 'username', 'first_name', 'last_name', 'email', 'type');
			mail_users($_POST['subject'], $_POST['body'], $profile_data['username']);
			header('Location: mail.php?success');
			exit();
		} else {
			echo output_errors($errors);
		}
		
	}
	?>

</br><h3>Send mail to all users</h3>
<p>Due to a severe incident, Sending email is now closed on this site. Wait for further news</p>
<div class='posts'>
<form action='' method='post' class='center'>
	<ul>
		<li>
			<h5>Subject:</h5>
			<input <?php echo $email_related ?> type='text' name='subject' />
		</li>
		<li>
			<h5>Message:</h5>
			<textarea <?php echo $email_related ?> class='textarea' name='body'></textarea>
		</li>
		<input <?php echo $email_related ?> type='submit' value='send' />
		<input <?php echo $email_related ?> type='reset' value='clear' />
	</ul>
</form>
<br/>
</div>
	<?php
	
		echo "<tr><td colspan='5'><h4>You are signed in as " .$user_data['Username'] . " and your email is " . $user_data['Email'] . "</h4></td></tr>"; 
	
	?>
	<table>
	<?php 
		
		echo "<tr><td>User Id</td><td>Username</td><td>First Name</td><td>Email</td><td>Account Type</td><td>Email Subscription</td></tr><tr><td></td></tr>";
		
		$user = active_member(0);
		foreach($user as $key => $member){
			echo "
			
			<tr>
			<td>
				" . $member['user_id'] . "
			</td>
			<td>
				<a href=" . $member['username'] . ">" . $member['username'] . "</a>
			</td>
			<td>
				" . ucfirst(strtolower($member['first_name'])) . "
			</td>
			<td>
				" . $member['email'] . "
			</td>
			<td>
				"; If($member['type'] !== '0'){ echo "AD-User";} else{echo "RG-User";}; echo "
			</td>
			<td>
				"; If($member['allow_email'] == 1){ echo "Subscribed";} else{echo "No";}; echo "
			</td>
			</tr>
			
			";
		}
		
	?>
	
	</table></br>
	<h3>Force Subscrition (don't use unless important!) </h3>
	<form action='mail_addon.php' method='POST'>
		<ul>
			<li>
				Username:<br />
				<select <?php echo $email_related ?> class="textarea" name="user_id" >
				<?php
					foreach(get_userid() as $user){
						$output[] = '<option value=\'' . $user['user_id'] . '\'>' . ucfirst(strtolower($user['username'])) . '</option>';
						$user = implode('', $output);
					}
					echo $user;
				?>
			</select>
			</li>			
			<li>
				Type:<br />
				<select <?php echo $email_related ?> class="textarea" name="type">
					<option value='1'>Subscribed</option>
					<option value='0'>Unsubscribe</option>
				</select>
			</li>
			<li>
				<input <?php echo $email_related ?> type='submit' value='Update'>
				<input <?php echo $email_related ?> type='reset' value='Reset*'>
			</li>
		</ul>
	</form>

<?php } ?>

<?php include 'includes/overall/footer.php' ?>