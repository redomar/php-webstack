<?php
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';
$title = 'Blog - Search Posts';
?>
<h1>Blog</h1>

<div class='search'>
<form action='' method='post'>
<h3>Search for Posts:
<input type='text' name='search' value='<?php echo $_POST['search'] ?>' />
<input type='submit' value='Search' />
</h3>
</form>
</div>

<?php

if(isset($_POST['search']) === true){
	$search 	= mysql_real_escape_string(htmlentities(trim($_POST['search'])));
	
	if (empty($search)){
		$errors[] = 'Please type in the search bar';
	} else if (strlen($search) <= 2){
		$errors[] = 'Please type in more than two letters';
	} else if(search_result($search) === false){
		$errors[] = 'Your Search for \'' . $search . '\' did not match any posts';
	}
	
	if(empty($errors) === true){
		
		$result = search_result($search);
		$total = count($result);
		$suffix = ($total != 1) ? 's' : '';
		
		echo '<p><strong>', $total, '</strong> result', $suffix, ' has been found for <strong>', $search, '</strong><p>';
		
		foreach($result as $results){
			echo '<p>	<strong><a href="blog.php?id=', $results['post_id'],'">', $results['title'],'</a></strong><br/>
						', $results['contents'], '...<br/>
						<a href="blog.php?id=', $results['post_id'],'">http://redomar.co.cc/blog.php?id=', $results['post_id'],'</a><br/></p>';
		}
		
	} else {
		echo output_errors($errors);
	}
	
	
} else {
	header('Location: blog.php?not_found');
	exit();
}

?>

<?php include 'includes/overall/footer.php' ?>