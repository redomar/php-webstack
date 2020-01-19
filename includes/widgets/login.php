<div class="widget">
	<h2>Login or Register</h2>
	<div class="inner">
		<form action='login.php' method='post'>
			<ul id='login'>
				<li>
					Username:
					<input type='text' name='username' />
				</li>
				<li>
					Password:
					<input type='password' name='password' />
				</li>
				<li>
					Keep me logged in (don't use on public computer):
					<input type='checkbox' name='rememberme' />
				</li>
				<li>
					<input type='submit' value='Log in'>
					<input type='reset' value='Reset'>
				</li>
				<li>
					<a href='register.php'>Register</a>
				</li>
				<li>
					Forgot your <a href='recover.php?mode=username'>Username</a> or <a href='recover.php?mode=password'>Password</a>?
				</li>
			</ul>
		</form>
	</div>
</div>