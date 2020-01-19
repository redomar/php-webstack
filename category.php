<?php
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';
$title = 'Blog - Categories';
?>
<h1>Category</h1>

<?php
	echo $blog_links;

	$posts = get_posts(null, $_GET['id']);

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

	echo $blog_links;
?>

<?php include 'includes/overall/footer.php' ?>