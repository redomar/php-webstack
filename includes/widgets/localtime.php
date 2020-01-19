<div class='widget'>
	<h2>Local Time</h2>
	<div class='inner'>
		<!--<img src="http://www.basoukazuma.com/Crunchyroll/Time-Image.php?o=Etc&tz=GMT+0"></img>-->
		<?php
			date_default_timezone_set('Europe/London');
			echo $date = date('H:i:s D jS F Y');
		?>
	</div>
</div>