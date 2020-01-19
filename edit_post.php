<?php
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';
$title = 'Blog - Posts';
?>
<h1>Edit Post</h1>
<?php

$post = get_posts($_GET['id']);

	if(isset($_POST['title'], $_POST['contents'], $_POST['category']) === true){
		$title 		= htmlentities(trim($_POST['title']));
		$contents 	= htmlentities(trim($_POST['contents']));
		$keyword 	= htmlentities(trim($_POST['keyword']));
		
		if (empty($title) === true){
			$errors[] = 'Please Fill in the title';
		} else if (empty($contents) === true){
			$errors[] = 'Please Fill in the Content for the Post';
		} else if(category_exists('id', $_POST['category']) === false){
			$errors[] = 'The category does not exist ';
		} else if(strlen($name) > 40){
			$errors[] = 'The Title name is too long. It must be less than 40 characters long';
		}
		
		if (isset($errors) === true && empty($errors) === false){
			echo output_errors($errors), '<a href=\'add_post.php\'>return</a>';
			exit();
		}

		if (empty($errors) === true){
			date_default_timezone_set('Europe/London');
			edit_post($_GET['id'], $title, $contents, $_POST['category'], $_POST['keyword']);
			
			
			
			header('Location: blog_posts.php?id='. $post[0]['post_id']);
			exit();
		}
	}

	echo $blog_links;

?>

<form action='' method='post' class='posts'>
	<ul class='table'>
		<li>
			<label for='title'> Title: </a><br />
			<input type='text' name='title' value='<?php if (empty($post[0]['title']) === false) {echo $post[0]['title'];} else {echo 'ERROR: POST NOT FOUND...'; }?>'/>
		</li>
		<li>
			<label for='contents'> Content: </a><br />
			<textarea class='textarea' name='contents' ><?php echo $post[0]['contents']; ?></textarea>
		</li>
		<li>
			<label for='keyword'> keyword: </a><br />
			<input type='text' name='keyword' value='<?php if (empty($post[0]['key_word']) === false) {echo $post[0]['key_word'];} else {echo 'No Keywords Set'; } ?>'/>
		</li>
		<li>
			<label for='category'> Category: </a><br />
			<select class='textarea' name='category' >
				<?php
					foreach(get_categories() as $category){
						$selected = ($category['name'] == $post[0]['name']) ? 'selected' : '';
						
						$output[] = '<option value=\'' . $category['id'] . '\''. $selected . '>' . $category['name'] . '</option>';
						$category = implode('', $output);
					}
					echo $category;
				?>
			</select>
		</li>
		<li>
			<input type='submit' value='Edit'>
			<input type='reset' value='Reset'>
		</li>
	</ul>
</form>

<?php echo $nbbc; include 'includes/overall/footer.php' ?>