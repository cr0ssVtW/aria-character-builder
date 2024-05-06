<?php

class PlayerView
{
    private $player;
    private $playerController;

    public function __construct($controller,$model) {
        $this->playerController = $controller;
        $this->player = $model;
    }

    public function returnHome() {
        return '<p><a href="index.php" class="text-info">Clear Build</a></p>';
    }

    public function createInput($skillName) {
        echo "<label>" . ucfirst($skillName) . ":</label> <input class='form-control' name='" . $skillName . "' value='" . (!empty($this->player->$skillName) ? $this->player->$skillName : $this->player->skillMin) . "' placeholder='0'>";
    }

    public function displaySkills() {
        $skills = $this->player->getUsedSkills();
        foreach ($skills as $key => $value) {
            echo "<ul>";
            echo "<li><label>" . ucfirst($key) . ":</label> $value</li>";
            echo "</ul>";
        }
    }

    public function createAttribute($attributeName) {
        return "<input class='attribute-size' name='" . $attributeName . "' value='" . (!empty($this->player->$attributeName) ? $this->player->$attributeName : 10) . "' placeholder='10'> <label>" . ucfirst($attributeName) . ":</label><br />";
    }

    // Attributes
    public function getHealth() {
        return $this->player->calculate_Health();
    }

    public function getMana() {
        return $this->player->calculate_Mana();
    }

    public function getStamina() {
        return $this->player->calculate_Stamina();
    }

    public function getAttackSpeed() {
        return $this->player->calculate_AttackSpeedBonus();
    }

    public function getMagicResist() {
        return $this->player->calculate_Magic_Resist();
    }

    public function getStunResist() {
        return $this->player->calculate_Stun_Resist();
    }

    // Skills
    public function getPower() {
        return $this->player->calculate_Power();
    }
    public function getAttackPower() {
        return $this->player->calculate_AttackPower();
    }
}

?>