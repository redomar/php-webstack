<?php
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';
$title = 'Forum';
?>
<h1>Forum</h1>
<p>Forums</p>

<div id='forum'>
	<table>
		<?php
			/*$per_page = '6';
			$page[] = pagination($per_page, $_GET['page']);
			$start = $page['start'];
			$per_page = $page['per_page'];
			
			$post = mysql_query("SELECT `posts`.`id` AS `post_id`, `categories`.`id` AS `category_id`, `title`, `contents`, `key_word`, `user`, `date_posted`, `categories`.`name`
				FROM `posts`
				INNER JOIN `categories` ON `categories`.`id` = `posts`.`cat_id`
				ORDER BY `post_id` DESC
				LIMIT $start, $per_page");
			
			foreach ($post as $posts){
				$contents = $bb->Parse($posts['contents']);
				echo '<p>' . $contents . '</p>';
			}*/
			
			
			$posts = (isset($_GET['id']) === true) ? get_posts($_GET['id']) : get_posts();
			foreach ($posts as $post){
				$user_id = username_to_userid($post['user']);
				$profile_data = profile_data($user_id['user_id']);
				$contents = $bb->Parse($post['contents']);
				
				echo "
					<tr>
						<td class='forum_post_name'>
							<img class='prof_pic' src='" . $profile_data['profile'] . "'alt='" . $profile_data['first_name'] . "'\'s Profile/></br></br><h4><a href='" . $post['user'] . "'>" . $post['user'] . "</a></h4>Name: " . $profile_data['first_name'] . "</br>Posts: " . count_user_posts($profile_data['username']) . "
						</td>
						<td class='forum_post'>
							<p>" . $contents . "</p>
						</td>
					</tr>";
			}
		?>
	</table>
</div>

<?php include 'includes/overall/footer.php' ?>