<?php
include 'core/init.php';
include 'includes/overall/header.php';
$title = 'Oops';

if (logged_in() == "C" || logged_in() == "S") {
		echo "<h1>Sorry, You are logged in!</h1><br />
		<h2>You cannot register OR login while logged in</h2>";
	} else {
		echo "<h1>Sorry, You need to be logged in!</h1><br />
		<h2>Please, login or register</h2>";
	}

 include 'includes/overall/footer.php'; ?>