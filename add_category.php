<?php
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';
$title = 'Blog - Categories';
?>
<h1>Add a Category</h1>

<?php

if(isset($_GET['success']) && empty($_GET['success'])) {
		$title = 'Blog - Categories';
		echo '<h3>You successfully set a new Category</h3>';
		echo $blog_links;
		exit();
	}

if (isset($_POST['cat_name']) === true){
	$name = htmlentities(trim($_POST['cat_name']));
	
	if (empty($name) === true){
		$errors[] = 'Please Enter a Category Name';
	} else if(category_exists('name', $name) === true){
		$errors[] = 'The Category name \'' . $name . '\' already exists';
	} else if(strlen($name) > 32){
		$errors[] = 'The Category name is too long. It must be less than 32 characters long';
	}
	
	if(empty($errors) === true){
		add_category($name);
		
		header('Location: add_category.php?success');
		exit();
	}
	echo output_errors($errors);
}

	echo $blog_links;
?>

<form action='' method='post' class='posts'>
	<ul class='table'>
		<li>
			<label for='cat_name'> Name: </a><br />
			<input type='text' name='cat_name' />
		</li>
		<li>
			<input type='submit' value='Post Category'>
			<input type='reset' value='Clear Name'>
		</li>
	</ul>
</form>

<?php include 'includes/overall/footer.php' ?>