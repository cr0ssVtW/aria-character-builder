<?php

class Attributes {
	public $attributeMin = 10;
	public $attributeMax = 50;
	public $attributeCount;
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

    public function updateReaminingAttributePoints($remaining) {
    	$this->remainingAttributePoints = $remaining;
    	echo "remaining: " . $this->remainingAttributePoints . "<br>";
    }
    public function validateRemainingAttributePoints($value) {
    	// Set default amount of points used on this count.
    	$defaultUsed = $this->attributeCount * $this->attributeMin;
    	// Get the actual remaining points, due to above default.
    	$tempRemaining = $this->remainingAttributePoints - $defaultUsed;
    	if ()
    	echo "tempRamaining: " . $tempRemaining . "<br>";
    	if ($tempRemaining < $this->attributeMin && $this->acceptAttribute == true) {
    		echo "Whoops, we tried to set too much.";
    		$tempRemaining = $this->remainingAttributePoints - $value;
    		$this->acceptAttribute = false;
    	} else if ($this->acceptAttribute == false) {
    		echo "We can't set anymore. Default to 10 value<br>";
    		$value = 10;
    		$tempRemaining = 0;
    	} else {	
			$tempRemaining = $this->remainingAttributePoints - $value;
			if ($value >= $tempRemaining) { 
				$value = $tempRemaining; 
			}
    	}

    	$this->updateReaminingAttributePoints($tempRemaining);
    	return $value;
    }
	public function validateAttribute($value) {
		$this->attributeCount += 1;
		if (!is_integer($value)) { $value == 0; }
		if ($value > $this->attributeMax) { $value = $this->attributeMax; } // 50
		if ($value < $this->attributeMin) { $value = $this->attributeMin; } // 10
		echo "value: " . $value . "<br>";
		return $this->validateRemainingAttributePoints($value);
	}
	public function set_strength($value) {
		echo "set_strength <br>";
		$this->strength = $this->validateAttribute($value);
	}
	public function set_agility($value) {
		echo "set_agility <br>";
		$this->agility = $this->validateAttribute($value);
	}
	public function set_intelligence($value) {
		echo "set_intelligence <br>";
		$this->intelligence = $this->validateAttribute($value);
	}
	public function set_constitution($value) {
		echo "set_constitution <br>";
		$this->constitution = $this->validateAttribute($value);
	}
	public function set_wisdom($value) {
		echo "set_wisdom <br>";
		$this->wisdom = $this->validateAttribute($value);
	}
	public function set_will($value) {
		echo "set_will <br>";
		$this->will = $this->validateAttribute($value);
	}
}

?>