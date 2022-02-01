<?php

include_once('Hero.php');

class Orderus extends Hero {

  private $strikeChance = 10;
  private $shieldChance = 20;

  public function attack($attacker_strength, $defender_defence) {

    $damage = parent::attack($attacker_strength, $defender_defence);
    if ($this->rapid_strike()) {
      echo '<span style="color:lightblue">Rapid Strike <br /> </span>';
      $damage *=2;
    }

    return $damage;
  }

  public function defend($damage) {

    if ($this->magic_shield()) {
      echo '<span style="color:blue">Magic Shield <br /> </span>';
      $damage /=2;
    }

    return $damage;
  }

  //Hero skills.
  //Rapid strike - attaks twice when it's his turn but it has a 10% probability of happenning.
  private function rapid_strike() {

    if(rand(1,100) <= $this->strikeChance) {
      return true;
    } else {
      return false;
    }
  }

    //Magic Shield - Reduces the damage by half and has a 20% probability.
  private function magic_shield() {

    if (rand(1,100) <= $this->shieldChance) {
      return true;
    } else {
      return false;
    }
  }

  public function set_name() {
    $this->name = 'Orderus';
  }
}

 ?>
