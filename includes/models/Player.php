<?php
include "Skills.php";

class Player extends Skills {
	public $skillCap;
	public $remainingSkillPoints;
	public $attributeCap;
	public $remainingAttributePoints;

	public function __construct() {
        $this->skillCap = 600;
        $this->remainingSkillPoints = 600;
        $this->attributeCap = 150;
        $this->remainingAttributePoints = 150;
        $this->acceptAttribute = true;
        $this->attributeCount = 0;
    }

	function GetAllVars() {
        return array_keys(get_class_vars(get_class($this))); // $this
    }

    function set_skill($skillName, $value) {
    	$function = "set_" . $skillName;
    	$this->$function($value);
    }
}

?>