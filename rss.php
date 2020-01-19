<?php

include 'core/init.php';

header('Content-Type: application/rss+xml');

$posts = (isset($_GET['id']) === true) ? get_posts($_GET['id']) : get_posts();




?>
<?php echo '<?xml version="1.0" encoding="UTF-8" ?>';?>

<rss version="2.0">
	<channel>
		<title>Redomar Blog</title>
		<description>Latest on the Redomar Blog</description>
		<link>http://www.redomar.cu.cc/</link>
		<lastBuildDate><?php echo date('r'); ?></lastBuildDate>
	<?php 
		#foreach($posts AS $post){
			$post = $posts[0];
	?>
		<item>
			<title><?php echo $bb->Parse($post['title']); ?></title>
			<description><?php echo $bb->Parse($post['contents']); ?></description>
			<link>http://redomar.cu.cc/blog.php?id=<?php echo $post['post_id']; ?></link>
			<media:thumbnail url="http://cdn1.iconfinder.com/data/icons/angry-icons-by-femfoyou/125/redbird.png" height="291" width="512"/>
			<pubDate><?php echo date('r', strtotime($post['date_posted'])); ?></pubDate>
		</item>
	<?php
		#}	
	?>

	</channel>
</rss>