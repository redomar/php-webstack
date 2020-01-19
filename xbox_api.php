<?php
include 'core/init.php';
include 'includes/overall/header.php';
$title = 'Xbox';
?>
<h1>Xbox Api</h1>
<p>testing phase</p>

<?php 

if(isset($_GET['gamertag']) === true && empty($_GET['gamertag']) === false){
	$gamertag = htmlentities($_GET['gamertag']);//get the gamertag from the url
	$profileUrl = 'https://www.xboxleaders.com/api/profile.json?gamertag='.$gamertag.'';// the  API url
	//$GamesUrl = 'https://www.xboxleaders.com/api/1.0/games.json?gamertag='.$gamertag.'';// the games API url
	$GamesUrl = 'https://www.xboxleaders.com/api/games.json?gamertag='.$gamertag.'';

	// Get information about me
	$info = file_get_contents($profileUrl);
	$info2 = file_get_contents($GamesUrl);

	// To JSON
	$json = json_decode($info);
	$json2 = json_decode($info2);
	
	
	// this time it does not output the JSON directly to the page
	
	$data = $json->data;
	$data2 = $json2->Data->PlayedGames;
	$data3 = $json2->data->games;
	$Tier = $data->tier;
	$IsOnline = $data->online;
	
	if($json->data->online == null){
		$IsOnline = "Unknown";
	} elseif($json->data->online == false){
		$IsOnline = "Offline";
	} elseif($json->data->online == true){
		$IsOnline = "Online";
	}
	
	$OnlineStatus = $data->presence;
	
	$error = $json->error;
	
	if (isset($error) === false){
	// output to page
	echo "Showing results for ".$data->gamertag."</br></br>";
	echo "<img src='".$data->avatar->full."'/></br></br>";
	echo "This user is a Xbox ".$Tier." Member</br>";
	echo "Gamerscore: ".$data->gamerscore." | Reputation: ".$data->reputation."/20</br>";
	echo "This user is ".$IsOnline."</br></br>";
	echo "Status: ".$OnlineStatus."</br>";
	
	/*foreach ($data3 AS $game){
		$time = (int)$game->lastplayed;
		if (empty($time) === false){
			echo "<div id='game'>Played <strong>".html_entity_decode($game->title)."</strong>";
			echo " Last played at <strong>".date('jS F Y | h:ia', $time)."</strong></br><img src='" . $game->artwork->small. "'/></div>";
		} else {
			echo "Played <strong>".$game->Title."</strong></br>";
		}
	}*/

	echo "<br/>";

	if($json2->status === "success"){
		echo '<br/><h3><b>Previously played Games</b></h3>';
		echo '<div style="border:1px solid black;width: 630px;">';
		foreach ($json2->data->games as $value => $game) {
			if($value < 10){
				$time = (int)$game->lastplayed;
				if($game->isapp == false){
					echo "<div id='game'>Played <strong>".html_entity_decode($game->title)."</strong>";
					echo " Last played at <strong>".date('jS F Y | h:ia', $time)."</strong></br><img src='" . $game->artwork->small. "'/></div>";
				}
			}
		}

		echo '</div><br/><br/><h3><b>Previously played Apps</b></h3>';
		echo '<div style="border:1px solid black;width: 630px;">';
		foreach ($json2->data->games as $value => $game) {
			if($value < 5){
				$time = (int)$game->lastplayed;
				if($game->isapp == true){
					echo "<div id='game'>Played <strong>".html_entity_decode($game->title)."</strong>";
					echo " Last played at <strong>".date('jS F Y | h:ia', $time)."</strong></br><img src='" . $game->artwork->small. "'/></div>";
				}
			}
		}

		echo '</div>';
	} elseif ($json2->status === "error") {
		echo "Error status: <br/>".$json2->data->code.":".$json2->data->message;
		$intError = (int)$json2->data->code;
		if($intError == 301){
			echo "<br/><br/>Please try again later";
		}
		exit();
	} else {
		echo "Error status: undetected";
		exit();
	}
	
	echo "</br></br><a href='xbox-user.php'>Return</a>";
	} else {
		echo "ERROR ".$error->code."</br>";
		echo $error->message."</br></br><a href='xbox-user.php'>Return</a>";
	}
	
	
	
	
	//stop script
	exit();
	
	
	
}

?>

<form action="" method="get">
	<label for="gamertag">Your Gamer tag:</label>
	<input name="gamertag" id="gamertag" type="text" /></br>
	<input type="submit" />
</form>

<?php include 'includes/overall/footer.php' ?>