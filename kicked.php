<?php
include 'core/init.php';
include 'includes/overall/header.php';

$title = 'Oops';

if (logged_in() === true) {
		echo "<h1>You've been kicked from this page</h1><br />
		<h2>Only admins allowed here</h2>";
	} else {
		echo "<h1>Sorry, You need to be logged in!</h1><br />
		<h2>Please, login or register</h2>";
	}

 include 'includes/overall/footer.php' ?>