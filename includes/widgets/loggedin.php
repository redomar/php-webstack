<div class="widget">
	<h2>Welcome <?php echo ucfirst(strtolower($user_data['First_Name'])); ?>!</h2>
	<div class="inner">
		
		
			<?php /* 
				
				if (empty($user_data['profile']) === false) {
					echo "<div class='profile'>";
					echo '<img src="', $user_data['profile'], '" alt="', $user_data['First_Name'], '\'s Profile"/>';
					echo '</br><a href="/', $user_data['Username'],'" >' . $user_data['Username'] .'</a>\'s Profile Picture';
					echo "</div>";
				}
				*/
			?>	
		
		
		
		<ul>
			<li>
				<a href='/<?php echo $user_data['Username']; ?>'>Profile</a>
			</li>
			<li>
				<a href='settings.php'>Settings</a>
			</li>
			<li>
				<a href='changepwd.php'>Change Password</a>
			</li>
			<li>
				<a href='logout.php'>Logout </a>
			</li>
		</ul>
	</div>
</div>