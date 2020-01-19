<?php

function pagination($per_page, $page_num){
	
	$query = mysql_query("SELECT COUNT(`id`) FROM `posts`");
	$pages_query = mysql_result($query, 0);
	$pages = ceil($pages_query / $per_page);
	
	$page = (isset($page_num) AND $page_num >0) ? $page_num : 1;
	$start = ($page - 1) * $per_page;
	
	$result = array(
		'per_page' => $per_page,
		'pages' => $pages,
		'pages_query' => $pages_query,
		'page' => $page,
		'start' => $start
	);
	
	return $result;
	
}

function add_post($title, $contents, $category, $user, $keyword){
	$title		= mysql_real_escape_string($title);
	$keyword	= mysql_real_escape_string($keyword);
	$user		= mysql_real_escape_string($user);
	$contents	= mysql_real_escape_string($contents);
	$category	= (int)$category;
	
	date_default_timezone_set('Europe/London');
	$date = date('Y-m-d H:i:s');
	mysql_query("INSERT INTO `posts` SET 
			`cat_id`		= '$category',
			`title`			= '$title',
			`contents`		= '$contents',
			`key_word`		= '$keyword',
			`user`			= '$user',
			`date_posted`	= '$date'");
}

function edit_post($id, $title, $contents, $category, $keyword){
	$id			= (int)$id;
	$title		= mysql_real_escape_string($title);
	$keyword	= mysql_real_escape_string($keyword);
	$contents	= mysql_real_escape_string($contents);
	$category	= (int)$category;
	
	mysql_query("UPDATE `posts` SET 
			`cat_id`		= '$category',
			`title`			= '$title',
			`key_word`		= '$keyword',
			`contents`		= '$contents'
			WHERE `id` = $id");	
}

function add_category($name){
	$name = mysql_real_escape_string($name);
	
	mysql_query("INSERT INTO `categories` SET `name` = '$name'");
}

function delete($table, $id){
	$table 	= mysql_real_escape_string($table);
	$id 	= (int)$id;
	
	mysql_query("DELETE FROM `$table` WHERE `id` = '$id'");
}

function get_posts($id = null, $cat_id = null){
	$posts = array();
	
	$query = "SELECT `posts`.`id` AS `post_id`, `categories`.`id` AS `category_id`, `title`, `contents`, `key_word`, `user`, `date_posted`, `categories`.`name`
		FROM `posts`
		INNER JOIN `categories` ON `categories`.`id` = `posts`.`cat_id`";
		
	if(isset($id) === true){
		$id = (int)$id;
		
		$query .= " WHERE `posts`.`id` = '$id'";
	}
	
	if(isset($cat_id) === true){
		$cat_id = (int)$cat_id;
		
		$query .= " WHERE `categories`.`id` = $cat_id";
	}
		
	$query .= " ORDER BY `post_id` DESC";
	
	$query = mysql_query($query); 
	
	while($row = mysql_fetch_assoc($query)){
		$posts[] = $row;
	}
	
	return $posts;
}

function get_categories($id = null){
	$categories = array();
	
	$query = mysql_query("SELECT `id`, `name` FROM `categories`");
	
	while($row = mysql_fetch_assoc($query)){
		$categories[] = $row;
	}
	
	return $categories;
}

function category_exists($field, $value){
	$field = mysql_real_escape_string($field);
	$value = mysql_real_escape_string($value);
	
	$query = mysql_query("SELECT COUNT(1) FROM `categories` WHERE `$field` = '$value'");
	
	return (mysql_result($query, 0) == 0) ? false : true;
	
}

?>