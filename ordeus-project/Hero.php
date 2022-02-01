<?php

abstract class Hero{

  public $name;
  public $health;
  public $strength;
  public $defence;
  public $speed;
  public $luck;

  public function __construct($params) {

    foreach ($params as $key => $value) {
      $this->$key = $value;
    }

    $this->set_name();
  }

  //Attack Function.
  //Calculating the damage substracting the defender's defence from the attacker' strength.
  public function attack($attacker_strength, $defender_defence) {

    return (int)($attacker_strength - $defender_defence);
  }

  //Defend Function.
  public function defend($damage) {

    return $damage;
  }
  //Set the name of the hero
  abstract public function set_name();
}

 ?>
