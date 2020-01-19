<footer>
    &copy; Redomar.co.cc 2012-<?php echo currnt_year();?>. All rights reserved.  Hosted by <a target="_blank" href='http://www.host-ed.me'>host-ed.me</a>
	<br />
	<div><img src='images/css.png'/><img src='images/php.png'/><img src='images/mysql.png'/></div>
	<a href="https://plus.google.com/107763376300412561611?" rel=author">Mohamed Omar</a>
</footer>
<head>
	<?php if(empty($title) === true){echo '<title>Welcome to RedOmar\'s Website</title>';} else {echo '<title>' . $title . '</title>';}?>
	<?php if(isset($rss) === true){echo "<link rel='alternate' type='application/rss+xml' title='Redomar Blog' href='rss.php' />";}?>
</head>