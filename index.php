<html>
<head>
	<?php 
	include 'includes/header.php';
	include "includes/controllers/PlayerController.php";
	include "includes/models/Player.php";
	include "includes/views/PlayerView.php";

		$player = new Player(); // model
		$playerController = new PlayerController($player);
		$playerView = new PlayerView($playerController, $player);
		foreach($player->GetAllVars() as $skill){
			foreach($_REQUEST as $key => $value ) {
				if ($skill == $key) {
					$playerController->updateSkill($skill, $value);
				}
			}
		}

	?>
</head>

<body class="bg-dark text-white">
	<form id="playerForm" name="playerForm" class="form-horizontal">
	<div class="container-fluid">
		<div class="row">
			<div class="content-left">
				<div class="container">
					<? echo $playerView->returnHome(); ?>
						<fieldset>
						<div class="row">
							<div class="col-sm-1 form-spread">
								<? $playerView->createInput("alchemy"); ?>
								<? $playerView->createInput("animalLore"); ?>
								<? $playerView->createInput("animalTaming"); ?>
								<? $playerView->createInput("archery"); ?>
							</div>
							<div class="col-sm-1 form-spread">
								<? $playerView->createInput("bashing"); ?>
								<? $playerView->createInput("beastmastery"); ?>
								<? $playerView->createInput("blacksmithing"); ?>
								<? $playerView->createInput("blocking"); ?>
							</div>
							<div class="col-sm-1 form-spread">
								<? $playerView->createInput("carpentry"); ?>
								<? $playerView->createInput("channeling"); ?>
								<? $playerView->createInput("cooking"); ?>
								<? $playerView->createInput("evocation"); ?>
							</div>
							<div class="col-sm-1 form-spread">
								<? $playerView->createInput("fabrication"); ?>
								<? $playerView->createInput("fishing"); ?>
								<? $playerView->createInput("healing"); ?>
								<? $playerView->createInput("heavyArmor"); ?>
							</div>
							<div class="col-sm-1 form-spread">
								<? $playerView->createInput("hiding"); ?>
								<? $playerView->createInput("inscription"); ?>
								<? $playerView->createInput("lancing"); ?>
								<? $playerView->createInput("lightArmor"); ?>
							</div>
							<div class="col-sm-1 form-spread">
								<? $playerView->createInput("lumberjack"); ?>
								<? $playerView->createInput("magicAffinity"); ?>
								<? $playerView->createInput("manifestation"); ?>
								<? $playerView->createInput("mining"); ?>
							</div>
							<div class="col-sm-1 form-spread">
								<? $playerView->createInput("piercing"); ?>
								<? $playerView->createInput("slashing"); ?>
								<? $playerView->createInput("stealth"); ?>
								<? $playerView->createInput("treasureHunting"); ?>
							</div>
							<div class="col-sm-1 form-spread">
								<? $playerView->createInput("vigor"); ?>
							</div>
							<input type="hidden" name="action" id="action" value="updateSkill"/>
						</div>
						</fieldset>
					
				</div>
			</div>
			<div class="content-right">
				<div class="container">
					<div class="row">
					    <div class="col-sm">
					    	<div class="skillHeader">
						    	<h3>Skills</h3>
						    	<p><b>Remaining:</b> <? echo $player->remainingSkillPoints; ?></p>
						    </div>
						    <div>
								<? echo $playerView->displaySkills(); ?>
							</div>
					    </div>
					    <div class="col-sm">
					    	<div class="attributeHeader">
					      		<h3>Attributes</h3>
					      		<p><b>Remaining:</b> <? echo $player->remainingAttributePoints; ?></p>
				      		</div>
				      		<div>
								<? echo $playerView->createAttribute("strength"); ?>
								<? echo $playerView->createAttribute("agility"); ?>
								<? echo $playerView->createAttribute("intelligence"); ?>
								<? echo $playerView->createAttribute("constitution"); ?>
								<? echo $playerView->createAttribute("wisdom"); ?>
								<? echo $playerView->createAttribute("will"); ?>
							</div>
					    </div>
						<div class="col-sm">
				      		Health: <? echo $playerView->getHealth(); ?><br>
				      		Mana: <? echo $playerView->getMana(); ?><br>
				      		Stamina: <? echo $playerView->getStamina(); ?><br>
				      		Power Bonus: <? echo $playerView->getPower(); ?>%<br>
				      		Magic Resist Chance: <? echo $playerView->getMagicResist(); ?>%<br>
				      		Stun Resist Chance: <? echo $playerView->getStunResist(); ?>%<br>
				      		Attack Rating Mod: <? echo $playerView->getAttackPower(); ?><br>
					    </div>
			  		</div>
				</div>
			</div>
		</div>
	</div>
	</form>
	
	<?php include 'includes/footer.php'; ?>

	<script language="JavaScript" type="text/javascript">
		function createCookie(name, value) {
			var date = new Date();
			date.setTime(date.getTime()+(30*1000)); // 30 second expiry
			var expires = "; expires="+date.toGMTString();

			document.cookie = name+"="+value+expires+"; path=/; SameSite=None; Secure";
		}
		window.onload = function() {
			if (!document.cookie.split("; ").find((row) => row.startsWith("firstLoad"))) {
				createCookie("firstLoad", "true");
				$( "#playerForm" ).submit();
			}
		}

		$(document).ready(function(e) {
			// Forms
			// User loses focus on an input, lets capture and submit
			$( "input" ).focusin(function(e) {
				this.value = '';
			});

			$( "input" ).focusout(function(e) {
				$( "#playerForm" ).submit();
			});
		});
	</script>
</body>
</html>