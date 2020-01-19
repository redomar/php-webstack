<?php
ob_start();
include 'core/init.php';
include 'includes/overall/header.php';

$title = 'Profile';
$username	= $_GET['username'];
if (isset($username[0]) === true && empty($username[0]) === false) {
		
		if(isset($_POST['user_bio']) === true && empty($_POST['user_bio']) === false){			
			$update_data = array(			
				'bio' 		=> $_POST['user_bio']	
		);		

		update_user($session_user_id, $update_data);
		header('Location: settings.php?success');
		exit();
		
	} else if (empty($errors) ===  false){
	$errors[] = 'Please fill in before you hit update bio button';			
		echo output_errors($errors);
		echo 'Please refresh the page...';
		exit();
	}
		
	if (user_exists($username) === true){
		$user_id	= user_id_from_username($username);
		$profile_data	= profile_data($user_id);
		$title = $profile_data['first_name'].'\'s Profile';
		$posts = count_user_posts($profile_data['username']);
	?>

		<h1><?php echo $profile_data['username']; ?>'s Profile</h1>	
		<?php
					echo "<div class='profiles'>";
					echo '<img src="', $profile_data['profile'], '" alt="', $profile_data['first_name'], '\'s Profile"/>';
					echo "</div>";
		?>

		<table class='table'>
			<tr>
				<td>
					<p>First Name:</p>
				</td>
				<td>
					<p><?php echo $profile_data['first_name']; ?></p>
				</td>
			</tr>
			<tr>
				<td>
					<p>Last Name:</p>
				</td>
				<td>
					<p><?php echo $profile_data['last_name']; ?></p>
				</td>
			</tr>
			<tr>
				<td>
					<p>Email:</p>
				</td>
				<td>
					<p>HIDDEN (soon will implement a way to hide)<?php #echo $profile_data['email']; ?></p>
				</td>
			</tr>
			<tr>
				<td>
					<p>User Type:</p>
				</td>
				<td>
					<p><?php if($profile_data['type'] == 1){echo "Admin";} else {echo "Regular User";}?></p>
				</td>                
			</tr>
			<tr>
				<td>
					<p>Blog Posts:</p>
				</td>
				<td>
					<p><?php echo $posts; ?></p>
				</td>
			</tr>
			<tr>
				<td>
					<p>Last Seen:</p>
				</td>
				<td>
					<p><?php If($profile_data['last_login'] !== '0000-00-00 00:00:00'){ echo "<strong>" . date('jS F Y ', strtotime($profile_data['last_login'])) . "at" . date(' h:ia', strtotime($profile_data['last_login'])) . "</strong>";} else{echo "<strong>Never</strong>";} ?></p>
				</td>
			</tr>
            <tr>
				<td>
					<p>Personal Bio:</p>
				</td>
				<td>
					<p><?php if($profile_data['bio'] !== '0'){echo $profile_data['bio'];} else if ($profile_data['bio'] === '0'){echo "No Bio Set";}?></p>
				</td>
			</tr>
            <tr> 
            <td>            
				<p><?php
					if($user_id === $user_data['User_id']){?>
					<form action="" method="post" >
						<input type='submit' value='Update Bio' name='update' />
						</p>            
            </td>
			<td>
				<textarea name='user_bio'></textarea>
			</form>
			<?php } ?>
			</td>
            </tr>
		</table>
		
		
		<?php		
		
	} else {
		header('Location: index.php');
		exit();
		}
} else {
	header('Location: index.php');
	exit();
}

 include 'includes/overall/footer.php' ?>