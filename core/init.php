<?php

ob_start();
session_start();
//error_reporting(0);

require 'database/connect.php';
require 'functions/users.php';
require 'functions/blog.php';
require 'includes/bbcode/nbbc.php';
require 'functions/general.php';
require 'classes/oauth.php';
require 'classes/twitteroauth.php';
require 'classes/twitter_class.php';
require 'classes/wrapper.php';
require 'classes/clicks.php';

$ips = $_SERVER['REMOTE_ADDR'];
$ipp = $_SERVER['REMOTE_PORT'];

$click = new Clicks($ips, $ipp);


	date_default_timezone_set(show_time_zone($session_user_id));
	
	$current_file = end(explode('/', $_SERVER['SCRIPT_NAME']));

if (logged_in() == "S") {
	$session_user_id = $_SESSION['User_id'];
	$user_data = user_data($session_user_id, 'User_id', 'Username', 'Password', 'First_Name', 'Last_Name', 'Email', 'password_recover', 'type', 'allow_email', 'public', 'profile', 'bio', 'last_login');
	
	if (user_active($user_data['Username']) === false) {
		session_destroy();
		header('Location: index.php');
		exit();
	}	

	if($current_file !== 'changepwd.php' && $current_file !== 'logout.php' && $user_data['password_recover'] == 1) {
		header('Location: changepwd.php?force');
		exit();
	}

}else if (logged_in() == "C") {
	$session_user_id = $_COOKIE['User_id'];
	$user_data = user_data($session_user_id, 'User_id', 'Username', 'Password', 'First_Name', 'Last_Name', 'Email', 'password_recover', 'type', 'allow_email', 'public', 'profile', 'bio');
	
	if (user_active($user_data['Username']) === false) {
		setcookie('User_id', $login, time()-(7*24*60*60));
		header('Location: index.php');
		exit();
	}

	if($current_file !== 'changepwd.php' && $current_file !== 'logout.php' && $user_data['password_recover'] == 1) {
		header('Location: changepwd.php?force');
		exit();
	}

}

$errors = array();

$blog_links = "
	<h3> Links </h3>
	<div class='blog_links'>
		<a href='blog_posts.php'>View Blogs</a>
		<a href='category_list.php'>View Categorires</a>
		<a href='add_post.php'>Add a Post</a>
		<a href='add_category.php'>Add a Category</a>
		<!--<a href='add_category'>Add a Category</a>-->
	</div>
";

$nbbc = " <br /><p>Powered By <a target=\"_blank\" href='http://nbbc.sourceforge.net/' ><img src='images/nbbc.png' alt='NBBC Code Parser' /></a></p>";

$bb = new bbcode();

$youtube = array(
	"simple_start" 	=> "<iframe width='480' height='270' src='//www.youtube.com/embed/",
	"simple_end" 	=> "?feature=player_detailpage' frameborder='0' allowfullscreen></iframe>",
	"class"		=> "inline"
);

$bb->AddRule('yt', $youtube);

//$email_related = "disabled='disabled'";

?>