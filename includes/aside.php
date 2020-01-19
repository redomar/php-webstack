<aside>
	<?php
	if (logged_in() == "S") {
		include 'includes/widgets/loggedin.php';
		include 'includes/widgets/expiry.php';
		if(is_admin($session_user_id) === true){
			include 'includes/widgets/admin_panel.php';
		}
		
		}else if (logged_in() == "C") {
		include 'includes/widgets/loggedin.php';
		include 'includes/widgets/expiry.php';
		if(is_admin($session_user_id) === true){
			include 'includes/widgets/admin_panel.php';
		}
		
	} else {
		include 'includes/widgets/login.php';
	}
	include 'includes/widgets/user_count.php';
	include 'includes/widgets/localtime.php';
	include 'includes/widgets/server_status.php';
	?>
</aside>