$('#username_out').text('Please enter a username');
$('#usernamejs').keyup(function() {
	var username = $(this).val();
	
	$('#username_out').text('Loading...');
	
	if (username != '') {
		$.post('javascript/php/username_data.php', { username: username }, function(data) {
			$('#username_out').text(data);
		});
	} else {
		$('#username_out').text('Please enter a username');
	}
	
});

$('#email_out').text('Please enter a email');
$('#emailjs').keyup(function() {
	var email = $(this).val();
	
	$('#email_out').text('Loading...');
	
	if (email != '') {
		$.post('javascript/php/email.php', { email: email }, function(data) {
			$('#email_out').text(data);
		});
	} else {
		$('#email_out').text('Please enter a email');
	}
	
});

$('#password_out').text('Please enter a password');
$('#password').keyup(function() {
	var password = $(this).val();
	var password_length = $(this).val().length;
	
	if (password == ''){
		$('#password_out').text('Please enter a password');
	} else if (password_length > 6){
		$('#password_out').text('You CAN use this password');
	} else {
		$('#password_out').text('Your Password Has to be more than 6 letters');
	}

});

$('#confirm_out').text('Retype the password')
$('#confirm').keyup(function() {
	var confirm = $(this).val();
	
	$('#confirm_out').text('Loading...'); 
	
	if (confirm == $('#password').val()) {
		$('#confirm_out').text('The Passwords matched perfectly')
	} else {
		$('#confirm_out').text('The Passwords do not match')
	}

});