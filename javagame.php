<?php
include 'core/init.php';
include 'includes/overall/header.php';
$title = 'JavaGame';
?>
<h1>Java Game</h1>
<p>Here is a game I made in Java</p>

<center>
	<a bgcolor="#333">
		<p color="a0a0a0">Java Game</p>
		<br>
		<applet code="com.redomar.game.GameLauncher.class" archive="http://redomar.cu.cc/java/javagame.jar" width="480" height="360" title="Java(TM)"></applet>
	</a>
</center>

<?php include 'includes/overall/footer.php' ?>