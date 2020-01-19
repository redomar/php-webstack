<?php
	include 'core/init.php';
?>
<html>
	<head>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<link rel="stylesheet" href="css/bootstrap.css">
	</head>
	<body style="background-color:#ff8800">
		<div class="container">
			<div class="row">
				<div class="col-md-4" style="background-color:#333;color:#eee;height:100%;">
					<h3>Login and Register</h3>
					<br><hr>
					<?php
						if (logged_in() == "S" || logged_in() == "C"){
							echo "<h3>You are already Logged In</h3><div style='margin-left: 70px;'";
							echo "<a href='//redomar.cu.cc'><button type=\"button\" class=\"btn btn-default\">Go Home</button></a>";
							echo "<a style='padding-left:15px' href='logout.php'><button type=\"button\" class=\"btn btn-primary\">Logout</button></a></div>";
						} else {
							?>
								
								<form role="form" action="login.php" method="post" enctype="multipart/form-data">
									<div class="form-group">
									<label for="exampleInputEmail1">Username</label>
									<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter username" name='username'>
								  </div>
								  <div class="form-group">
									<label for="exampleInputPassword1">Password</label>
									<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name='password'>
								  </div>
								  <div class="checkbox">
									<label>
									  <input type="checkbox" name='rememberme'> Keep me logged in
									</label>
								  </div>
								  <button type="submit" class="btn btn-default">Log in</button>
								  <button type="reset" class="btn btn-primary">Reset</button>
								</form>
								
							<?php
						}
					?>
				</div>
				<div class="col-md-8" style="background-color:#eee;height:100%;">
					<div style="padding: 0px 27px 20px 25px;">
						<h3>Welcome to my website <?php echo $bb->Parse(":D"); ?></h3>
						<p>This website is a project I sometimes work on; in my free time. I use this website to exercise my HTML5 skills once every month or two. I initially made this website in the summer of 2012 just after my first encounter with PHP and server side scripting. slowly I am adding new features over time.</p>
						<p>A small problem I have encountered recently is that my backend PHP code uses Functions and I have now learnt OOP through JAVA*. I am gradually replacing the functions with classes</p>
						<p>My friend <a href='/Admin'>Bilal</a> is also working on a site of his own and it is not finished as well, he works more on the designing while I look into the functionality, go give his site a peak at <a target='_blank' href='http://hello-world.cu.cc/'>http://hello-world.cu.cc/</a></p>
						<h6>*I made a Game in JAVA using OOP. Check in out <a href='//github.com/redomar/JavaGame'>JavaGame</a><h6>
					</div>
					<div style="padding: 0px 27px 20px 25px;">
						<?php /*
							$posts = get_posts();
							$i = 0;
							foreach($posts AS $post){
								if($i == 0) {
									$contents = $bb->Parse($post['contents']);
									
									if(category_exists('name', $post['name']) === false){
										$post['name'] = 'Uncategorized';
									}
									$output[] = '<div class=\'posts\'><h3><a href=\'blog_posts.php?id=' . $post['post_id'] . '\'>' . $post['title'] . '</a></h3><div class=\'center\'>' . $contents .
									'</div><table class=\'post_table\'><tr><td>Posted on:</td><td>' . date('d M y - H:i', strtotime($post['date_posted'])) . '</td>
									<td>Posted by:</td><td><a href=\'/' . $post['user'] . '\'>' . $post['user'] . '</a></td></tr><tr>
									<td>Category :</td><td><a href=\'category.php?id=' . $post['category_id'] . '\'>' . $post['name'] .'</a></td>
									</tr></table></div>';
									
									$post = implode('', $output);
									echo $post;
								}
								$i++;
							}
						*/	
						?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>