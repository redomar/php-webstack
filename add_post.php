<?php
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';
$title = 'Blog - Posts';
?>
<h1>Add a Post</h1>

<?php

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
			add_post($title, $contents, $_POST['category'], $user_data['Username'], $keyword);
			
			$id = mysql_insert_id();
			
			header("Location: blog_posts.php?id=$id");
			exit();
		}
	}

	echo $blog_links;
?>


<form action='' method='post' class='posts'>
	<ul class='table'>
		<li>
			<label for='title'> Title: </a><br />
			<input type='text' name='title' value='<?php if (isset($_POST['title'])) {echo $_POST['title'];} ?>'/>
		</li>
		<li>
			<label for='contents'> Content: </a><br />
			<textarea class='textarea' name='contents' ><?php if (isset($_POST['contents'])) {echo $_POST['contents'];} else {echo "";} ?></textarea>
		</li>
		<li>
			<label for='keyword'> keyword: </a><br />
			<input type='text' name='keyword' value='<?php if (isset($_POST['keyword'])) {echo $_POST['keyword'];}?>'/>
		</li>
		<li>
			<label for='category'> Category: </a><br />
			<select class='textarea' name='category' >
				<?php
					foreach(get_categories() as $category){
						
						$output[] = '<option value=\'' . $category['id'] . '\'>' . $category['name'] . '</option>';
						$category = implode('', $output);
					}
					echo $category;
				?>
			</select>
		</li>
		<li>
			<input type='submit' value='Post'>
			<input type='reset' value='Clear'>
		</li>
	</ul>
</form>

<?php echo $nbbc;?>
<p>if you have no clue what BBCode is, then visit out Here <strong><a href='help.php'>http://redomar.co.cc/help.php</a></strong></p>

<?php include 'includes/overall/footer.php' ?>