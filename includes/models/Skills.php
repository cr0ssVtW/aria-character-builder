<?php
include "Attributes.php";

class Skills extends Attributes {
	public $skillMin = 0;
	
	public $alchemy;
	public $animalLore;
	public $animalTaming;
	public $archery;
	public $bashing;
	public $beastmastery;
	public $blacksmithing;
	public $blocking;
	public $carpentry;
	public $channeling;
	public $cooking;
	public $evocation;
	public $fabrication;
	public $fishing;
	public $healing;
	public $heavyArmor;
	public $hiding;
	public $inscription;
	public $lancing;
	public $lightArmor;
	public $lumberjack;
	public $magicAffinity;
	public $manifestation;
	public $mining;
	public $piercing;
	public $slashing;
	public $stealth;
	public $treasureHunting;
	public $vigor;

	function GetSkillVars() {
		$class = new Skills();
    	return array_keys(get_class_vars(get_class($class))); // $this
    }

    function getUsedSkills() {
    	$skillList = [
    		'alchemy' 			=> $this->alchemy,
			'animalLore' 		=> $this->animalLore,
			'animalTaming'		=> $this->animalTaming,
			'archery'			=> $this->archery,
			'bashing' 			=> $this->bashing,
			'beastmastery'		=> $this->beastmastery,
			'blacksmithing'		=> $this->blacksmithing,
			'blocking'			=> $this->blocking,
			'carpentry'			=> $this->carpentry,
			'channeling'		=> $this->channeling,
			'cooking'			=> $this->cooking,
			'evocation'			=> $this->evocation,
			'fabrication'		=> $this->fabrication,
			'fishing'			=> $this->fishing,
			'healing'			=> $this->healing,
			'heavyArmor'		=> $this->heavyArmor,
			'hiding'			=> $this->hiding,
			'inscription'		=> $this->inscription,
			'lancing'			=> $this->lancing,
			'lightArmor'		=> $this->lightArmor,
			'lumberjack'		=> $this->lumberjack,
			'magicAffinity'		=> $this->magicAffinity,
			'manifestation'		=> $this->manifestation,
			'mining'			=> $this->mining,
			'piercing'			=> $this->piercing,
			'slashing'			=> $this->slashing,
			'stealth'			=> $this->stealth,
			'treasureHunting'	=> $this->treasureHunting,
			'vigor'				=> $this->vigor
		];
		foreach ($skillList as $key=>$value) {
			if ($value == 0 || $value > 100) {
				unset($skillList[$key]);
			}
		}
		arsort($skillList);

		return $skillList;
    }

    public function updateRemainingSkillPoints($value) {
    	$this->remainingSkillPoints = $this->skillCap -= $value;
    	if ($this->remainingSkillPoints < 0) { $this->remainingSkillPoints = 0; }
    	if ($this->remainingSkillPoints > 600) { $this->remainingSkillPoints = 600; }
    }
	public function validate($value) {
		if (!is_integer($value)) { $value == 0; }
		if (is_integer($value) && $value > 100) { $value = 100; }
		if (is_integer($value) && $value <= 0) { $value = 0; }

		$this->updateRemainingSkillPoints($value);
		return $value;
	}
	public function set_alchemy($value) {
		$this->alchemy = $this->validate($value);
	}
	public function set_animalLore($value) {
		$this->animalLore = $this->validate($value);
	}
	public function set_animalTaming($value) {
		$this->animalTaming = $this->validate($value);
	}
	public function set_archery($value) {
		$this->archery = $this->validate($value);
	}
	public function set_bashing($value) {
		$this->bashing = $this->validate($value);
	}
	public function set_beastmastery($value) {
		$this->beastmastery = $this->validate($value);
	}
	public function set_blacksmithing($value) {
		$this->blacksmithing = $this->validate($value);
	}
	public function set_blocking($value) {
		$this->blocking = $this->validate($value);
	}
	public function set_carpentry($value) {
		$this->carpentry = $this->validate($value);
	}
	public function set_channeling($value) {
		$this->channeling = $this->validate($value);
	}
	public function set_cooking($value) {
		$this->cooking = $this->validate($value);
	}
	public function set_evocation($value) {
		$this->evocation = $this->validate($value);
	}
	public function set_fabrication($value) {
		$this->fabrication = $this->validate($value);
	}
	public function set_fishing($value) {
		$this->fishing = $this->validate($value);
	}
	public function set_healing($value) {
		$this->healing = $this->validate($value);
	}
	public function set_heavyArmor($value) {
		$this->heavyArmor = $this->validate($value);
	}
	public function set_hiding($value) {
		$this->hiding = $this->validate($value);
	}
	public function set_inscription($value) {
		$this->inscription = $this->validate($value);
	}
	public function set_lancing($value) {
		$this->lancing = $this->validate($value);
	}
	public function set_lightArmor($value) {
		$this->lightArmor = $this->validate($value);
	}
	public function set_lumberjack($value) {
		$this->lumberjack = $this->validate($value);
	}
	public function set_magicAffinity($value) {
		$this->magicAffinity = $this->validate($value);
	}
	public function set_manifestation($value) {
		$this->manifestation = $this->validate($value);
	}
	public function set_mining($value) {
		$this->mining = $this->validate($value);
	}
	public function set_piercing($value) {
		$this->piercing = $this->validate($value);
	}
	public function set_slashing($value) {
		$this->slashing = $this->validate($value);
	}
	public function set_stealth($value) {
		$this->stealth = $this->validate($value);
	}
	public function set_treasureHunting($value) {
		$this->treasureHunting = $this->validate($value);
	}
	public function set_vigor($value) {
		$this->vigor = $this->validate($value);
	}

	// Calculate skill bonuses

	public function calculate_Power() {
		$powerBase = 0;
		$powerBonus = 0;
		$magicAffinityBonus = $this->magicAffinity / 5;

		$power = floor(($powerBase + $powerBonus + $magicAffinityBonus) * $this->get_IntMod());

		return $power;
	}

	public function calculate_AttackPower() {
		$baseWeaponAttack = 1; // Fist damage = 1, otherwise need weapon information here
		$attackMod = 0; // Determine attack mod from weapon and buff
		$attack = $baseWeaponAttack * ($this->get_StrMod() + ($this->vigor / 80) + $attackMod);

		return $attack;
	}

}



?>