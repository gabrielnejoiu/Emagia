<?php

namespace App;

use App\Helpers\Helper;

class EmagiaBattle
{
	public $Oderus;
	public $Beast;
	public $countAttacks;
	public $attacker;
	public $defender;
	public $damage;
	public $skillsUsed = ['defender' => [], 'attacker' => []];
	
	public function __construct($Oderus, $Beast)
	{
		$this->Beast = $Beast;
		$this->Oderus = $Oderus;
		$this->countAttacks = 0;
		$this->set_attacker_and_defender();
	}
	
	public function count_attacks()
	{
		$this->countAttacks++;
	}
	
	public function attack()
	{
		$this->count_attacks();
		if (
			21 === $this->countAttacks ||
			0 === $this->attacker->stats['health'] ||
			0 === $this->defender->stats['health']
		) {
			//end of game
			return false;
		}
		
		// Switch roles attacker and defender.
		if ($this->countAttacks > 1) {
			$attacker = $this->attacker;
			$this->attacker = $this->defender;
			$this->defender = $attacker;
		}
		
		// Calculate defender damage.
		$this->calculate_damage();
		
		return true;
	}
	
	
	// Switch attached and defender turn.
	public function set_attacker_and_defender()
	{
		if ((int)$this->Oderus->stats['speed'] === (int)$this->Beast->stats['speed']) {
			if (
				(int)str_replace('%', '', $this->Oderus->stats['luck']) <
				(int)str_replace('%', '', $this->Beast->stats['luck'])
			) {
				$this->attacker = $this->Beast;
				$this->defender = $this->Oderus;
			} else if (
				(int)str_replace('%', '', $this->Oderus->stats['luck']) >
				(int)str_replace('%', '', $this->Beast->stats['luck'])
			) {
				$this->defender = $this->Beast;
				$this->attacker = $this->Oderus;
			}
		} else if ((int)$this->Oderus->stats['speed'] < (int)$this->Beast->stats['speed']) {
			$this->attacker = $this->Beast;
			$this->defender = $this->Oderus;
		} else if ((int)$this->Oderus->stats['speed'] > (int)$this->Beast->stats['speed']) {
			$this->defender = $this->Beast;
			$this->attacker = $this->Oderus;
		}
	}
	
	public function calculate_damage()
	{
		
		// Reset Skills used.
		$this->skillsUsed = ['defender' => [], 'attacker' => []];
		
		// Check if defender has luck.
		if (Helper::chance(isset($this->defender->luck) ?? false)) {
			// Defender is lucky and no damage is returned.
			$this->damage = 0;
			$this->skillsUsed['defender'][] = 'luck';
			return;
		}
		
		// Calculate normal damage.
		$this->damage = ($this->attacker->stats['strength'] - $this->defender->stats['defence']);
		
		// Check if attacker has rapid strike.
		if (Helper::chance(isset($this->attacker->skills['rapid_strike']) ?? false)) {
			$this->damage = ($this->damage * 2);
			$this->skillsUsed['attacker'][] = 'rapid strike';
		}
		
		// Check if defender has magic shield.
		if (Helper::chance(isset($this->defender->skills['magic_shield']) ?? false)) {
			$this->damage = ($this->damage / 2);
			$this->skillsUsed['defender'][] = 'magic shield';
		}
		
		// Set defender new health.
		$diff = ($this->defender->stats['health'] - $this->damage);
		$this->defender->stats['health'] = ($diff < 0) ? 0 : $diff;
		
	}
	
}
