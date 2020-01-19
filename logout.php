<?php
session_start();
session_destroy();
setcookie('User_id', $login, time()-(7*24*60*60));
header('Location: home.php');
?>