<?php
include 'core/init.php';
//protect_page();
include 'includes/overall/header.php';
$title = 'Downloads';
?>
<h1>Downloads</h1>

<?php

if(isset($_GET['success'])){
	$success = $_GET['success'];
	echo "<h3>You have successfully uploaded " . $success . "</h3>";
	exit();
}

if(isset($_GET['delete']) === true && empty($_GET['delete']) === false){
	$file_id = $_GET['delete'];
	
	remove_file($file_id, $session_user_id);
}

if(empty($_POST) === false && empty($errors) === true){
	
	$filename = $_POST['filename'];
	
	if(empty($_FILES['upfile']['name']) === false){
		$allowed = array('jpg','jpeg','gif','bmp','png','tif','doc','docx','xls','xlsx','zip','mp3','wav','ogg','txt','ico','rns','jar','jars');
		$file_name = $_FILES['upfile']['name'];
		$file_extn = strtolower(end(explode('.', $file_name)));
		$file_temp = $_FILES['upfile']['tmp_name'];
		
		if(in_array($file_extn, $allowed) === true){
			upload_file($user_data['Username'], $file_temp, $file_extn, $filename);
			header("Location: downloads.php?success=" . $filename . "." . $file_extn);
			exit();
			
			#echo $filename . "|" . $file_name . "FILE IN TMP. EXT TYPE = " . $file_extn;
		
		}
	} else{
		$errors[] = 'Please choose a file from your hard drive.';
	}
	if (empty($_POST['filename']) === true) {
		$errors[] = "Please write a name for the file";
	}
}
if (empty($errors) === false){
		echo output_errors($errors);
	}
?>

<div id='downloads'>
	<table>
		<tr>
			<td>
				<h4>Name</h4>
			</td>
			<td>
				<h4>Download Link</h4>
			</td>
		</tr>
		
			<?php 
			
			$files = (isset($_GET['username']) === true) ? get_files($_GET['username']) : get_files();
			
			foreach ($files as $file){
			echo "<tr>
				<td class='download_name'>
					<h5>" . end(explode('/', $file['directory'])) . "</h5><p><strong>" . $file['username'] . "</strong> |" . date('jS F Y | h:ia', strtotime($file['uploaded_date'])) . "</p>
				</td>
				<td class='download_link'>
					<p><a target='_blank' href='". $file['directory'] ."' >Download</a></p>
				</td>";
				
				if($session_user_id === $file['user_id']){
					echo "
					<td class='download_link'>
						<p><a href='downloads.php?delete=". $file['file_id'] ."'>Delete</a></p>
					</td>
					</tr>";
					}
				} ?>
		
	</table></br></br>
	<?php ddd(); ?>
</div>
<?php include 'includes/overall/footer.php' ?>