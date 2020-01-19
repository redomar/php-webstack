<?php
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';
if ($_GET['id'] <= 0){
	$title = 'Blog';
	$rss = true;
} else {
	$tab = (isset($_GET['id']) === true) ? get_posts($_GET['id']) : get_posts();
	$title = "Blog - ";
	$title .= $tab[0]['title'];
}
?>

<h1>Blog</h1>

<div class='search'>
<form action='search.php' method='post'>
<h3>Search for Posts:
<input type='text' name='search' id='search' />
<input type='submit' value='Search' />
</h3>
</form>
</div>

<?php

if (isset($_GET['fail']) === true){
	$title = 'Blog - No Delete File';
	?>
	
	<p>Sorry, There is nothing to delete</p>
	
	<a href='blog.php'> Return to Blog</a>
	
	<?php
	exit();
}

if (isset($_GET['not_found']) === true){
	$title = 'Blog - Not Found';
	?>
	
	<p>Sorry, Your search could not be found</p>
	
	<a href='blog.php'> Return to Blog</a>
	
	<?php
	exit();
}

?>
<p>Welcome to our bloging area...
<br>Please be carefull of links being posted here</p>

<?php
	echo $blog_links;
	
	$posts = (isset($_GET['id']) === true) ? get_posts($_GET['id']) : get_posts();
	
	foreach($posts AS $post){
		
		$contents = $bb->Parse($post['contents']);
		
		if(category_exists('name', $post['name']) === false){
			$post['name'] = 'Uncategorized';
		}
		
		if(is_admin($session_user_id) === true){
		$output[] = '<div class=\'posts\'><h3><a href=\'blog_posts.php?id=' . $post['post_id'] . '\'>' . $post['title'] . '</a></h3><div class=\'center\'>' . $contents .
		'</div><table class=\'post_table\'><tr><td>Posted on:</td><td>' . date('d M y - H:i', strtotime($post['date_posted'])) . '</td>
		<td>Posted by:</td><td><a href=\'/' . $post['user'] . '\'>' . $post['user'] . '</a></td></tr><tr>
		<td>Category :</td><td><a href=\'category.php?id=' . $post['category_id'] . '\'>' . $post['name'] .'</a></td>
		<td><a href=\'edit_post.php?id=' . $post['post_id'] . '\'>Edit Post</a></td><td><a href=\'delete_post.php?id=' . $post['post_id'] . '\'>Delete Post</a></td>
		</tr></table></div>';
		} else if($post['user'] === $user_data['Username']){
		$output[] = '<div class=\'posts\'><h3><a href=\'blog_posts.php?id=' . $post['post_id'] . '\'>' . $post['title'] . '</a></h3><div class=\'center\'>' . $contents .
		'</div><table class=\'post_table\'><tr><td>Posted on:</td><td>' . date('d M y - H:i', strtotime($post['date_posted'])) . '</td>
		<td>Posted by:</td><td><a href=\'/' . $post['user'] . '\'>' . $post['user'] . '</a></td></tr><tr>
		<td>Category :</td><td><a href=\'category.php?id=' . $post['category_id'] . '\'>' . $post['name'] .'</a></td>
		<td><a href=\'edit_post.php?id=' . $post['post_id'] . '\'>Edit Post</a></td><td><a href=\'delete_post.php?id=' . $post['post_id'] . '\'>Delete Post</a></td>
		</tr></table></div>';
		} else {
		$output[] = '<div class=\'posts\'><h3><a href=\'blog_posts.php?id=' . $post['post_id'] . '\'>' . $post['title'] . '</a></h3><div class=\'center\'>' . $contents .
		'</div><table class=\'post_table\'><tr><td>Posted on:</td><td>' . date('d M y - H:i', strtotime($post['date_posted'])) . '</td>
		<td>Posted by:</td><td><a href=\'/' . $post['user'] . '\'>' . $post['user'] . '</a></td></tr><tr>
		<td>Category :</td><td><a href=\'category.php?id=' . $post['category_id'] . '\'>' . $post['name'] .'</a></td>
		</tr></table></div>';
		}
		
		$post = implode('', $output);
	}
	echo $post;
	
	echo $nbbc;

	echo $blog_links;
?>

<?php include 'includes/overall/footer.php' ?>