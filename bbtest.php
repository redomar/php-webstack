<?php
include 'core/init.php';
protect_page();
protect_admin($session_user_id);
include 'includes/overall/header.php';
$title = 'Admin Panel BBCode Testing';
?>
<h1>BBCODE - TESTING</h1>

<?php 

echo "<p>this is where we test out the bbcode before implementing on the site</p>";

$uuu = 'password';
$ee = str_split(md5($uuu), 8);
echo $ee[1];

if (isset($_POST['text']) === true) {
	
	echo $bb->Parse($_POST['text']);
}
 ?>

 <form action='' method='POST'>
	<input type='text' name='text'/>
	<input type='submit' />
 </form>
 
<?php /*

$posts = (isset($_GET['id']) === true) ? get_posts($_GET['id']) : get_posts();

echo '<pre>';
print_r($posts);
echo '</pre>';

foreach ($posts as $post){
	
	echo $post['post_id'], '\n';
	
}
*/
?></br>
test 2 </br></br>

<?php /*

$query = mysql_query("SELECT `email`, `first_name` FROM `users` WHERE `allow_email` = 1");
$result = mysql_fetch_array($query);

while (($row = mysql_fetch_assoc($query)) !== false){

echo $result['email'], '</br>';

}*/


?></br>
-----------------------------------
<?php echo $nbbc; include 'includes/overall/footer.php' ?>