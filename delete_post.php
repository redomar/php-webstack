<?php
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';
$title = 'Blog - Posts';
?>
<h1>Delete a Category</h1>
<?php 

	


if(! isset($_GET['id'])){

	header('Location: blog.php?fail');
	exit();
}
if (isset($_GET['id']) === true && empty($_GET['id']) === false){
	delete('posts', $_GET['id']);
	
	header('Location: blog.php');
	exit();
}

?>

<?php include 'includes/overall/footer.php' ?>