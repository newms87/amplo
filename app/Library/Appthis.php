<?php

namespace App\Library;

class Appthis
{
	/**
	 * @param array $digits
	 */
	public function algorithm($digits = [], $num_teams = 2)
	{
		$numbers = [];
		$teams   = [];

		//Initialize teams
		$team_range = range(0, abs((int)$num_teams - 1));

		foreach ($team_range as $team_index) {
			$teams[$team_index]   = [];
			$numbers[$team_index] = [];
		}
		unset($team);

		//Sort digits to pop off highest numbers at end of array
		sort($digits);

		while ($digits) {
			foreach ($team_range as $team_index) {
				if ($digits) {
					$teams[$team_index][] = array_pop($digits);
				}
			}
		}


		//Create the numbers from the teams
		foreach ($teams as $team_index => $team) {
			$numbers[$team_index] = (int)implode('', $team);
		}

		$total = array_sum($numbers);

		return [
			'numbers' => $numbers,
			'total'   => $total
		];
	}
}
