<?php
include 'core/init.php';
include 'includes/overall/header.php';
?>
<h1> Home Page </h1>
<h4> Welcome to my homepage </h4>

<div class='page_content'>
	<h5>Latest News</h5>
	<p>Sorry for the outage and rapid domain name change, our domain has now changed. I usually update the site during the evening to early morning, expect changes then.</p>
	<p>Please Use the Feedback Page to tell me any bugs you see. <a href="feedback.php">More Details</a></p>
	<p>If you want to leave contact me becuse i am trying to find a way to suspend user account if the user wants to leve. In the mean time if you want to remove your account, email me at <a href='mailto:jaden@redomar.co.cc'>jaden@redomar.co.cc</a>.</p>
	<p> Be sure to check out my friends website @ <a href="http://hello-world.cu.cc">hello-world.cu.cc</a>. </p>


	<h5> Last Updated at: 2nd September 2012 16:37 BST</h5>

	<br/>
	<h4>Current Members (now automated)</h4>

	<?php 

	$user = public_member(1);
	foreach ($user as $key => $username){
		echo "
		
		<a target='_blank' href='/" . strtolower($username['username']) . "'>" . ucfirst(strtolower($username['username'])) . "</a> 
		
		";
	}

	?>

	<!--<a target='_blank' href='/mohamed12'>mohamed12</a>
	<a target='_blank' href='/JadenFuki'>JadenFuki</a>
	<a target='_blank' href='/Admin'>Admin</a>
	<a target='_blank' href='/redomar'>redomar</a>
	<a target='_blank' href='/semeticboy'>semeticboy</a>
	<a target='_blank' href='/abdihafid'>abdihafid</a>-->

	<br/>
		<div id='devlog'>
		<br/>
		<h4> <a href='devlog.php'>My Devlopement Log</a> </h4>

		</div>
</div>
<?php include 'includes/overall/footer.php'; ?>