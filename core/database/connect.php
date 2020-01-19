<?php
//error_reporting(0);

$db_host = 'localhost';
$db_user = 'x';
$db_pass = 'x';
$db_data = 'x';

mysql_connect ("$db_host","$db_user","$db_pass") or die ("Error 100: unable to connect to server <br />" . mysql_error());
mysql_select_db ("$db_data") or die ("Error 200: unable to find database <br />" . mysql_error());

?>