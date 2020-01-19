<?php
	
	$db_host = 'localhost';
	$db_user = 'x';
	$db_pass = 'x';
	$db_data = 'x';

	mysql_connect ("$db_host","$db_user","$db_pass") or die ("Error 100: unable to connect to server <br />" . mysql_error());
	mysql_select_db ("$db_data") or die ("Error 200: unable to find database <br />" . mysql_error());

	if(function_exists($_GET['method'])){
		$_GET['method']();
	}

	/*function getAllUsers(){
		$user_sql = mysql_query("SELECT `user_id`,`username`,`first_name`,`last_name`,`last_login` FROM `users`");
		$users = array();
		while ($user = mysql_fetch_array($user_sql)) {
			$users[] = $user;
		}
		$users = json_encode($users, JSON_PRETTY_PRINT);
		echo '<pre>'.$_GET['jsoncallback'].'('.$users.')</pre>';
	}*/

	function getAllUsers(){
		
		$select = "SELECT `user_id`,`username`,`first_name`,`last_name`,`last_login` FROM `users`";
		$select .=" ORDER BY  `users`.`user_id` ASC";
		$query = mysql_query($select);
		
		while($row = mysql_fetch_assoc($query)){
			$result[] = $row;
		}
		
		$output = json_encode($result);
		echo '<pre>'.pretty_json($output).'</pre>';
	}

	function pretty_json($json) {

	    $result      = '';
	    $pos         = 0;
	    $strLen      = strlen($json);
	    $indentStr   = '  ';
	    $newLine     = "\n";
	    $prevChar    = '';
	    $outOfQuotes = true;

	    for ($i=0; $i<=$strLen; $i++) {

	        // Grab the next character in the string.
	        $char = substr($json, $i, 1);

	        // Are we inside a quoted string?
	        if ($char == '"' && $prevChar != '\\') {
	            $outOfQuotes = !$outOfQuotes;
	        
	        // If this character is the end of an element, 
	        // output a new line and indent the next line.
	        } else if(($char == '}' || $char == ']') && $outOfQuotes) {
	            $result .= $newLine;
	            $pos --;
	            for ($j=0; $j<$pos; $j++) {
	                $result .= $indentStr;
	            }
	        }
	        
	        // Add the character to the result string.
	        $result .= $char;

	        // If the last character was the beginning of an element, 
	        // output a new line and indent the next line.
	        if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes) {
	            $result .= $newLine;
	            if ($char == '{' || $char == '[') {
	                $pos ++;
	            }
	            
	            for ($j = 0; $j < $pos; $j++) {
	                $result .= $indentStr;
	            }
	        }
	        
	        $prevChar = $char;
	    }

	    return $result;
	}
?>