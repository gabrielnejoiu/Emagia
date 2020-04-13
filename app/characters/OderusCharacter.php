<?php

namespace App\Characters;

use App\Helpers\Helper;

class OderusCharacter extends BasicCharacter
{
	public $defaultStatsRanges = [
		'health_min' => 70,
		'health_max' => 100,
		'strength_min' => 70,
		'strength_max' => 80,
		'defence_min' => 45,
		'defence_max' => 55,
		'luck_min' => 10, // Percentage value.
		'luck_max' => 30, // Percentage value.
		'speed_min' => 40,
		'speed_max' => 50
	];
	public $skills = [
		'rapid_strike' => 10, // Percentage value.
		'magic_shield' => 20 // Percentage value.
	];
	
	public $name; // Character Name.
	
	public function __construct()
	{
		parent::__construct();
		$this->name = 'Oderus';
	}
}
