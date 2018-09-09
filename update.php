<?php
include "includes/controllers/PlayerController.php";
include "includes/models/Player.php";
include "includes/views/PlayerView.php";

	$player = new Player(); // model
	$playerController = new PlayerController($player);
	$playerView = new PlayerView($playerController, $player);
	echo "Test";
	
?>