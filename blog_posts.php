<?php
include 'core/init.php';
include 'includes/overall/header.php';
$title = 'Blog - Posts';
?>
<h1>Posts</h1>

<?php
	if(isset($_GET['id']) === true && empty($_GET['id']) === false){
		header('Location: blog.php?id=' . $_GET['id']);
	} else {
		header('Location: blog.php');
	}
?>

<?php include 'includes/overall/footer.php' ?>