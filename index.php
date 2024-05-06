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
					<?php echo $playerView->returnHome(); ?>
						<fieldset>
						<div class="row">
							<div class="col-sm-1 form-spread">
								<?php $playerView->createInput("alchemy"); ?>
								<?php $playerView->createInput("animalLore"); ?>
								<?php $playerView->createInput("animalTaming"); ?>
								<?php $playerView->createInput("archery"); ?>
								<?php $playerView->createInput("bashing"); ?>
								<?php $playerView->createInput("beastmastery"); ?>
								<?php $playerView->createInput("blacksmithing"); ?>
								<?php $playerView->createInput("blocking"); ?>
							</div>
							<div class="col-sm-1 form-spread">
								<?php $playerView->createInput("brawling"); ?>
								<?php $playerView->createInput("carpentry"); ?>
								<?php $playerView->createInput("channeling"); ?>
								<?php $playerView->createInput("cooking"); ?>
								<?php $playerView->createInput("evocation"); ?>
								<?php $playerView->createInput("fabrication"); ?>
								<?php $playerView->createInput("fishing"); ?>
								<?php $playerView->createInput("healing"); ?>
							</div>
							<div class="col-sm-1 form-spread">
								<?php $playerView->createInput("heavyArmor"); ?>
								<?php $playerView->createInput("hiding"); ?>
								<?php $playerView->createInput("inscription"); ?>
								<?php $playerView->createInput("lancing"); ?>
								<?php $playerView->createInput("lightArmor"); ?>
								<?php $playerView->createInput("lockpicking"); ?>
								<?php $playerView->createInput("lumberjack"); ?>
								<?php $playerView->createInput("magicAffinity"); ?>
							</div>
							<div class="col-sm-1 form-spread">
								<?php $playerView->createInput("manifestation"); ?>
								<?php $playerView->createInput("mining"); ?>
								<?php $playerView->createInput("piercing"); ?>
								<?php $playerView->createInput("slashing"); ?>
								<?php $playerView->createInput("stealth"); ?>
								<?php $playerView->createInput("treasureHunting"); ?>
								<?php $playerView->createInput("vigor"); ?>
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
						    	<p><b>Remaining:</b> <?php echo $player->remainingSkillPoints; ?></p>
						    </div>
						    <div>
								<?php echo $playerView->displaySkills(); ?>
							</div>
					    </div>
					    <div class="col-sm">
					    	<div class="attributeHeader">
					      		<h3>Attributes</h3>
					      		<p><b>Remaining:</b> <?php echo $player->remainingAttributePoints; ?></p>
				      		</div>
				      		<div>
								<?php echo $playerView->createAttribute("strength"); ?>
								<?php echo $playerView->createAttribute("agility"); ?>
								<?php echo $playerView->createAttribute("intelligence"); ?>
								<?php echo $playerView->createAttribute("constitution"); ?>
								<?php echo $playerView->createAttribute("wisdom"); ?>
								<?php echo $playerView->createAttribute("will"); ?>
							</div>
					    </div>
						<div class="col-sm">
							<div class="bonusHeader">
					      		<h3>Results:</h3>
				      		</div>
				      		<div>
					      		<span title="Health is determined by Constitution."><b>Health:</b> <?php echo $playerView->getHealth(); ?></span><br>
					      		<span title="Mana is determined by Intelligence."><b>Mana:</b> <?php echo $playerView->getMana(); ?></span><br>
					      		<span title="Stamina is determined by Agility."><b>Stamina:</b> <?php echo $playerView->getStamina(); ?></span><br>
					      		<span title="Magical Power generated from Magical Affinity, intelligence modifier, and other bonues."><b>Power Bonus:</b> <?php echo $playerView->getPower(); ?>%</span><br>
					      		<span title="Chance to take half damage from Magical spells/abilities."><b>Magic Resist Chance:</b> <?php echo $playerView->getMagicResist(); ?>%</span><br>
					      		<span title="Chance to resist Hamstring, Stuns, Mortal Strike, etc."><b>Effect Resist Chance:</b> <?php echo $playerView->getStunResist(); ?>%</span><br>
					      		<span title="Base weapon damage modifier. Determined by Strength and Vigor."><b>Attack Rating Mod:</b> <?php echo $playerView->getAttackPower(); ?></span><br>
					      		<span title="Bonus to attack speed is determined by Agility. Every 15 points reduces attack speed by 0.25 seconds."><b>Attack Speed Bonus:</b> <?php echo $playerView->getAttackSpeed(); ?></span><br>
					      	</div>
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