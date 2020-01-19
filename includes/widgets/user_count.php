<div class="widget">
	<h2>Users</h2>
	<div class="inner">
		<?php 
		$user_count = user_count();
		$suffix = ($user_count != 1) ? 's' : '';
		$inactive_users = inactive_users();
		$suffix2 = ($inactive_users != 1) ? 's' : '';
		?>
		<ul>
			<li>
				Activated Acounts:&nbsp;&nbsp;<?php echo user_count(); ?> user<?php echo $suffix; ?>.
			</li>
            <li>
				Unactivated Acounts:&nbsp;<?php echo inactive_users(); ?> user<?php echo $suffix2; ?>.
			</li>
		</ul>
	</div>
</div>