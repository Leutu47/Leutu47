<?php

class Battle {

  private $orderus;
  private $beast;
  private $turns;
  private $currentattacker;
  private $currentdefender;
  private $damage;

  public function __construct(Hero $orderus, Hero $beast) {

    $this->orderus = $orderus;
    $this->beast = $beast;
    $this->turns = 20; //Maximum numer of rounds.
  }

  public function battle() {

    ob_start();

    $this->init();

    while( ($this->turns > 0) && ($this->orderus->health > 0) && ($this->beast->health > 0) ) {
      $flag = $this->fight();

      //Decreasing the number of turns remaining
      $this->turns --;

      echo "Round: ".(20 - $this->turns) . '<br />';
      echo "<strong>".$this->currentdefender->name."</strong> has attacked. <br />";
      if ($flag) {
        echo $this->currentattacker->name . ' got lucky. <br />';
      }

      echo "<span style='color:green'>Orderus</span> health: ".$this->orderus->health . '<br />';
      echo "<span style='color:red'>Beast</span> health: ".$this->beast->health . '<br />';
      echo "Damage: " .$this->damage . '<br />';
      echo "**************************<br />";
    }

    ob_end_flush();
  }

  //Function used to identify who is attacking first.
  private function init() {

    if ($this->orderus->speed == $this->beast->speed) {
      $this->currentattacker = ($this->orderus->luck > $this->beast->luck) ? $this->orderus : $this->beast;
    } else {
      $this->currentattacker = ($this->orderus->speed > $this->beast->speed) ? $this->orderus : $this->beast;
    }

    $this->currentdefender = $this->get_opposite($this->orderus, $this->beast, $this->currentattacker);
  }

  //Fight function sets the attack and the defence.
  //It also changes the state of the battle (who attacks and who defends).
  private function fight() {

    $flag = false;
    if ( !$this->check_probability($this->currentdefender->luck) ) {
      $this->attack();
      $this->defend();

      $this->health_substracting($this->damage);
    } else {
      $flag = true;
    }

    $this->currentdefender = $this->currentattacker;
    $this->currentattacker = $this->get_opposite($this->orderus, $this->beast, $this->currentattacker);

    return $flag;
  }

  private function attack() {

    $this->damage = $this->currentattacker->attack($this->currentattacker->strength, $this->currentdefender->defence);

  }

  private function defend() {

    $this->damage = $this->currentdefender->defend($this->damage);

  }

  //Updates the current health of the fighter by substracting the damage taken from his health.
  private function health_substracting($damage) {

    $this->currentdefender->health -= $damage;
  }

  //Checking the probability of having an attack.
  private function check_probability($chance) {

    if (rand(1,100) <= $chance) {
      return true;
    } else {
      return false;
    }
  }


  private function get_opposite($attacker, $defender, $currentattacker) {

    if ($currentattacker->name == $attacker->name)
    return $defender;
    elseif ($currentattacker->name == $defender->name)
      return $attacker;
      else return $currentattacker;

    }
  }

 ?>
