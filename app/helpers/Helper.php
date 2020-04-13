<?php

namespace App\Helpers;

class Helper
{
	// Calculate chance by percentage number.
	public static function chance($percent = false)
	{
		if (!empty($percent)) {
			return mt_rand(0, 99) <= (int)$percent;
		}
		return false;
	}
	
	// Generate random number number.
	public static function generate_random_number($start, $end)
	{
		return mt_rand((int)$start, (int)$end);
	}
}
