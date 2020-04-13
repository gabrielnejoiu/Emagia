<?php

namespace App\Characters;

use App\Helpers\Helper;

class BasicCharacter
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
		$this->generate_stats();
		$this->name = 'Character';
	}
	
	public function generate_stats()
	{
		$this->stats = [
			'health' => Helper::generate_random_number($this->defaultStatsRanges['health_min'],$this->defaultStatsRanges['health_max']),
			'strength' => Helper::generate_random_number($this->defaultStatsRanges['strength_min'],$this->defaultStatsRanges['strength_max']),
			'defence' => Helper::generate_random_number($this->defaultStatsRanges['defence_min'],$this->defaultStatsRanges['defence_max']),
			'luck' => Helper::generate_random_number($this->defaultStatsRanges['health_min'],$this->defaultStatsRanges['health_max']), // Percentage value
			'speed' => Helper::generate_random_number($this->defaultStatsRanges['speed_min'],$this->defaultStatsRanges['speed_max'])
		];
	}
	
	// Prepare data for view;
	public function showStats()
	{
		$output = '<ul>';
		foreach ($this->stats as $title => $value) {
			$output .= '<li><strong>' . ucfirst($title) . '</strong>: ' . $value . '</li>';
		}
		$output .= '</ul>';
		
		return $output;
	}
	
}
