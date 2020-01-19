<?php
include 'core/init.php';
protect_page();
protect_admin($session_user_id);
include 'includes/overall/header.php';
$title = 'Admin Panel';

if (empty($_POST) === false) {
	$user = $_POST['type'];
	
	$update_data = array(
			'type' 		=> $user
		);
		
		update_user($_POST['user_id'], $update_data);
		
		$user_id	= $_POST['user_id'];
		$profile_data	= user_data($user_id, 'username', 'first_name', 'last_name', 'email', 'type');
		
		$errors[] = "<h4>User " . $profile_data['username'] . " Has been Updated</h4>";
		echo output_errors($errors);
		echo "
		
		<a href='admin.php'> Return </a>
		
		";
		exit();
}

?>
<h1>Admin</h1>

<div id='box'>
	<h3>Change user to or from Admin </h3>
	<form action='' method='POST'>
		<ul>
			<li>
				Username:<br />
				<select class="textarea" name="user_id" >
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
				<select class="textarea" name="type">
					<option value='1'>Admin</option>
					<option value='0'>Regular User</option>
				</select>
			</li>
			<li>
				<input type='submit' value='Update'>
				<input type='reset' value='Reset*'>
			</li>
		</ul>
	</form>
	<table>
	<?php 
		echo "<tr><td colspan='5'><h4>You are signed in as " .$user_data['Username'] . " and your email is " . $user_data['Email'] . "</h4></td></tr>"; 
		echo "<tr><td>User Id</td><td>Username</td><td>First Name</td><td>Email</td><td>Account Type</td></tr><tr><td></td></tr>";
		
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
			"; If($member['type'] !== '0'){ echo "Admin";} else{echo "Regular User";}; echo "
			</td>
			</tr>
			
			";
		}
		
	?>
	
	</table>
	</div><!-- box ended -->
<?php include 'includes/overall/footer.php' ?>