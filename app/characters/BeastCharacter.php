<?php

namespace App\Characters;

use App\Helpers\Helper;

class BeastCharacter extends BasicCharacter
{
	
	public $defaultStatsRanges = [
		'health_min'   => 60,
		'health_max'   => 90,
		'strength_min' => 60,
		'strength_max' => 90,
		'defence_min'  => 40,
		'defence_max'  => 60,
		'luck_min'     => 25, // Percentage value.
		'luck_max'     => 40, // Percentage value.
		'speed_min'    => 40,
		'speed_max'    => 60,
	];
	public $name;
	
	public function __construct()
	{
		parent::__construct();
		$this->name = 'Beast';
	}
	
}
