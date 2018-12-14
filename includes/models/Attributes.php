<?php

class Attributes {
	public $attributeMin = 10;
	public $attributeMax = 50;
	public $hasUsedDefault = false;
	public $acceptAttribute;

	public $strength;
	public $agility;
	public $intelligence;
	public $constitution;
	public $wisdom;
	public $will;

	function GetAttributeVars() {
		$class = new Attributes();
    	return array_keys(get_class_vars(get_class($class))); // $this
    }

    function getAttributes() {
    	$attList = [
    		'strength'			=> $this->strength,
    		'agility' 			=> $this->agility,
    		'intelligence'		=> $this->intelligence,
			'constitution' 		=> $this->constitution,
			'wisdom'			=> $this->wisdom,
			'will' 				=> $this->will
		];
		arsort($attList);
		return $attList;
    }

    public function updateRemainingAttributePoints($remaining) {
    	$this->remainingAttributePoints = $remaining;
    	$this->hasUsedDefault = true; // set one time use on first attribute update
    	//echo "remaining: " . $this->remainingAttributePoints . "<br>";
    }
    public function validateRemainingAttributePoints($value) {
    	// Set default amount of points used on this stat update. Always will be 60 likely. 
    	$defaultUsed = 6 * $this->attributeMin;
    	//echo "defaultUsed: " . $defaultUsed . "<br>";
    	// Get the actual remaining points. 150 - default (60) - this value input subtracted by attributeMinimum per attribute
    	if (($value - $this->attributeMin) > $this->remainingAttributePoints) { 
    		//echo "too much <br>";
			$value = $this->attributeMin + $this->remainingAttributePoints;
		}
    	if ($this->hasUsedDefault == false) {
    		$tempRemaining = ($this->remainingAttributePoints - $defaultUsed) - ($value - $this->attributeMin);
    	} else {
    		$tempRemaining = ($this->remainingAttributePoints) - ($value - $this->attributeMin);
    	}
    	//echo "tempRemaining: " . $tempRemaining . "<br>";
    	
    	
    	if ($tempRemaining < $this->attributeMin && $this->acceptAttribute == true) {
    		//echo "Whoops, we tried to set too much.<br>";
    		// $tempRemaining = $this->remainingAttributePoints - $value;
    		$this->acceptAttribute = false;
    	} 

    	$this->updateRemainingAttributePoints($tempRemaining);

    	return $value;
    }
	public function validateAttribute($value) {
		if (!is_integer($value)) { $value == 0; }
		if ($value > $this->attributeMax) { $value = $this->attributeMax; } // 50
		if ($value < $this->attributeMin) { $value = $this->attributeMin; } // 10
		//echo "value: " . $value . "<br>";
		return $this->validateRemainingAttributePoints($value);
	}
	public function set_strength($value) {
		//echo "<b>set_strength</b> <br>";
		$this->strength = $this->validateAttribute($value);
	}
	public function set_agility($value) {
		//echo "<b>set_agility</b> <br>";
		$this->agility = $this->validateAttribute($value);
	}
	public function set_intelligence($value) {
		//echo "<b>set_intelligence</b> <br>";
		$this->intelligence = $this->validateAttribute($value);
	}
	public function set_constitution($value) {
		//echo "<b>set_constitution</b> <br>";
		$this->constitution = $this->validateAttribute($value);
	}
	public function set_wisdom($value) {
		//echo "<b>set_wisdom</b> <br>";
		$this->wisdom = $this->validateAttribute($value);
	}
	public function set_will($value) {
		//echo "<b>set_will</b> <br>";
		$this->will = $this->validateAttribute($value);
	}

	// Global Mods

	public function get_IntMod() {
		$baseMod = 1;
		if ($this->intelligence > 10) {
			return $baseMod + ( ($this->intelligence - 10) * 0.00625);
		}

		return $baseMod;
	}

	public function get_StrMod() {
		$mod = 0;
		if ($this->strength > 10) {
			$mod = ($this->strength * 2.5) / 100;
		}

		return $mod;
	}

	// Calculations
	public function calculate_Health() {
		$baseHP = 150;
		$conHpBonus = 0;
		if ($this->constitution > 40) {
			$conHpBonus = ($conHpBonus+350) + (($this->constitution - 40) * 5);
		} 
		else if ($this->constitution > 30) {
			$conHpBonus = ($conHpBonus+250) + (($this->constitution - 30) * 10);
		}
		else if ($this->constitution > 20) {
			$conHpBonus = ($conHpBonus+100) + (($this->constitution - 20) * 15);
		}
		else if ($this->constitution > 10) {
			$conHpBonus = ($this->constitution-10) * 10;
		}

		return $baseHP + $conHpBonus;
	}

	public function calculate_Mana() {
		$mana = floor($this->intelligence * 2.5);

		return $mana;
	}

	public function calculate_Stamina() {
		$baseStamina = 0;
		$stamina = floor($baseStamina + ($this->agility * 2));

		return $stamina;
	}

	public function calculate_Magic_Resist() {
		$resistChance = (0.5 * (($this->wisdom) - $this->attributeMin) / ($this->attributeMax - $this->attributeMin)) * 100;

		return $resistChance;
	}

	public function calculate_Stun_Resist() {
		$resistChance = (0.5 * (($this->will) - $this->attributeMin) / ($this->attributeMax - $this->attributeMin)) * 100;

		return $resistChance;
	}

	public function calculate_Evasion() {

	}


}

?>