<?php
	if(isset($_COOKIE['User_id']) === True){
		$user_date = user_data($session_user_id,'last_login');
		if($session_user_id == 2){
			$user_expiry_time = strtotime($user_date['last_login'])+52*7*24*60*60;
		} else {
			$user_expiry_time = strtotime($user_date['last_login'])+7*24*60*60;
		}
		
		$ifc = current_time(show_time_zone($session_user_id), $user_expiry_time);
		
		$echo = "You are not going to be signed out when you close your browser.<br><br>You will be signed out ";
		if (date('d M Y') !== date('d M Y', $user_expiry_time)){$echo .= "on the:<br><h5>&nbsp;" . $ifc . "</h5>";} else {$echo .= "at:<br><h5>&nbsp;" . $ifc . "</h5>";}
		
	} else if(isset($_SESSION['User_id']) === True){
		$echo = "You will be signed out when you close your browser.<br><br>";
	} 
	?>
	<div class="widget">
		<h2>Loggout Status</h2>
		<div class="inner">
			<?php
				echo $echo;
			?>
		</div>
	</div>
	<?php 
	
?>