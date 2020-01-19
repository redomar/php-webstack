<?php
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';
$title = 'Blog - Categories';
?>
<h1>View Categories</h1>

<?php 
echo $blog_links;
$posts = get_posts();
foreach($posts AS $post){
		if(category_exists('name', $post['name']) === false){
			$post['name'] = 'Uncategorized';
		}
		}
foreach (get_categories() as $category){

	if(is_admin($session_user_id) === true){
	$output[] = '<li><a href=\'category.php?id=' . $category['id'] . '\'>' . $category['name'] . '</a> - <a href=\'delete_category.php?id=' . $category['id'] . '\'> Delete </a></li>';
	$category = '<div class=\'posts\'><ul>' . implode('', $output) . '</ul></div>';
	} else {
	$output[] = '<li><a href=\'category.php?id=' . $category['id'] . '\'>' . $category['name'] . '</a></li>';
	$category = '<div class=\'posts\'><ul>' . implode('', $output) . '</ul></div>';
	}
}
echo $category;
?>

<?php include 'includes/overall/footer.php' ?>