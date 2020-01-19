<?php

class Clicks{

	public function __construct($ips, $ipp){
	
		$skip_ips = array("92.236.170.154","92.236.173.237");
		$ip_check = null;
		
		
		foreach ($skip_ips as $skip_ip){
			if($ips === $skip_ip){
				$ip_check = true;
			} else {
				$ip_check = false;
			}
		}
		
		if($ip_check === false || isset($ip_check) === false){
			//$this->clicked($ips, $ipp);
		}
	}

	private function clicked($ips, $ipp){
		date_default_timezone_set('Europe/London');
		$date = date('Y-m-d H:i:s');
		
		mysql_query("INSERT INTO `clicks` SET
				`click_ip`		= '$ips',
				`click_port`	= '$ipp',
				`click_date`	= '$date'");
		return true;
	}
}
?>