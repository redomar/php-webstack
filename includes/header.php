<header>
	<?php if(isset($_GET['accept-cookies'])) {
		setcookie('accept-cookies', 'true', time()+(60*60*24*7*52));
		header('Location: http://redomar.cu.cc/home.php');
	}
	
	if(!isset($_COOKIE['accept-cookies'])){ ?>
	<div class="cookie-banner">
		<div class="cookie-container">
			<p>Notice: This site may use cookies. Please check out <a href="/cookies.php">the cookie policy</a></p>
			<div id="button">
				<a href="?accept-cookies" class="button">I accept the cookie policy</a>
			</div>
		</div>
	</div>
	<?php } ?>
    <img href='index.php' src='images/redomar2.png'  />
    		<?php include 'includes/menu.php'; ?>
    <div class="clear"></div>
</header>