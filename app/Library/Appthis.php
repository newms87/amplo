<?php

namespace App\Library;

class Appthis
{
	/**
	 * This algorithm determines the largest possible sum of $num_teams numbers, where
	 * each number is an even distribution of digits in the $digits array.
	 *
	 * The approach is to put the largest numbers first in a round robin, and then keep appending digits
	 * in this way to the number. This will guarantee the largest possible sum.
	 *
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

	public function algorithmOptimized($digits = [], $num_teams = 2)
	{
		//Initialize teams
		$teams = array_fill(0, $num_teams, '');

		//Sort digits to use
		rsort($digits);

		$team_index = 0;

		foreach ($digits as $digit) {
			$teams[$team_index++] .= $digit;

			//Round robin loops until last team, then starts again at the first team (team 0)
			if ($team_index >= count($teams)) {
				$team_index = 0;
			}
		}

		//Create the numbers from the teams
		foreach ($teams as &$team) {
			$team = (int)$team;
		}
		unset($team);

		$total = array_sum($teams);

		return [
			'numbers' => $teams,
			'total'   => $total
		];
	}
}
