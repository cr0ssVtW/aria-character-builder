<?php

class PlayerController
{
    private $player;

    public function __construct($model) {
        $this->player = $model;
    }

    public function updateSkill($skillName, $value) {
    	if (is_string($value)) {
    		$value = (int)$value;
    	}
    	$this->player->set_skill($skillName, $value);
    }
}

?>