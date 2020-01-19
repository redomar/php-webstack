
 <?php

include 'core/init.php';

$ips = $_SERVER['REMOTE_ADDR'];
$ipp = $_SERVER['REMOTE_PORT'];

$click = new Clicks($ips, $ipp);


print_r($ips);
print_r(":");
print_r($ipp);
 
 ?>