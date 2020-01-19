<?php
include 'core/init.php';
//protect_page();
include 'includes/overall/header.php';
$title = 'Members';
?>
<h1>Members</h1>

	<table>
		<tr><td><h4>Username</h4></td><td><h4>First Name</h4></td><td><h4>Bio</h4></td><td><h4>Posts</h4></td></tr><tr><td></td></tr>
<?php

	$user = public_member(2);
	foreach($user as $key => $member){
		if ($member['public'] !== '0'){
			echo "
			
			<tr>
			<td>"; if($member['user_id'] === $session_user_id){ echo "<strong>";} echo "
				<a href=" . strtolower($member['username']) . ">" . ucfirst(strtolower($member['username'])) . "</a>"; if($member['user_id'] === $session_user_id){ echo "</strong>";} echo "
			</td>
			<td>"; if($member['user_id'] === $session_user_id){ echo "<strong>";} echo "
				" . ucfirst(strtolower($member['first_name'])) . ""; if($member['user_id'] === $session_user_id){ echo "</strong>";} echo "
			</td>
			<td width='150'>
				"; If($member['bio'] !== '0'){ echo substr($member['bio'], 0 , 18 /*43*/);}; if (strlen($member['bio']) >= 18){echo "...";}; echo "
			</td>
			<td>
				"; If(isset($member['username']) === true){ echo count_user_posts($member['username']);}; echo "
			</td>
			<td>
				"; If($member['last_login'] !== '0000-00-00 00:00:00'){ echo "<div class='border'>" . date('jS F Y | h:ia', strtotime($member['last_login'])) . "</div>";} else{echo "--------";}; echo "
			</td>
			</tr>
			
			";
		}
	}
?>
</table>
<?php include 'includes/overall/footer.php' ?>