<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Conversion extends Model
{
	//Connect to the appthis database
	protected $connection = 'appthis';

	public function publisher()
	{
		return $this->belongsTo('App\Models\Publisher');
	}

	public function save(array $options = [])
	{
		parent::save($options);

		/*
		 * I have chosen to update these data points in real-time for this excersize as this will help
		 * to optimize reading these values for large datasets. A possible better solution would be to use
		 * a caching system and update these values periodically or as needed for reporting. Alternatively,
		 * we could just calculate these data points in real-time during reporting, which will have a performance hit,
		 * but would be guaranteed to be accurate (in case something would have gone wrong otherwise) and is optimal
		 * for storing impression / conversion data as it minimizes database writes.
		 */

		//Update the publisher conversion data for faster reporting
		$publisher = Publisher::find($this->publisher_id);

		if ($publisher) {
			$publisher->impressions++;

			if ($this->converted) {
				$publisher->conversions++;
			}

			$publisher->conversion_rate = $publisher->conversions / $publisher->impressions;

			$publisher->save();
		}
	}

	/**
	 * Retrieves all the unique countries in the conversions table in alphabetical order
	 *
	 * @return array - A list of country names
	 */
	public function getCountries()
	{
		$results = Conversion::select(DB::raw("DISTINCT country"))
			->orderBy('country', 'ASC')
			->get();

		$countries = [];

		foreach ($results as $result) {
			$countries[] = $result->country;
		}

		return $countries;
	}

	/**
	 * Retrieving conversions / impressions by day over a specified date range
	 *
	 * NOTE: I have chosen to avoid using the Laravel Eloquent ORM here as it seems like
	 * the purpose of this portion of the project is to evaluate abilities to write SQL code.
	 *
	 * @param array $filter - can set filter indexes like date_start, date_end. By Default will retrieve records for
	 *                      last 30 days.
	 *
	 * @return array - A list of records from the conversions table with the filter applied.
	 */
	public function getStatsByDay(array $filter = [])
	{
		//By Default the
		$filter += [
			'date_start' => date('Y-m-d', strtotime('-30 days')),
			'date_end'   => date('Y-m-d'),
		];

		$sql = <<<SQL
	SELECT `date`, COUNT(*) as impressions, SUM(converted) as conversions, SUM(converted) / COUNT(*) as conversion_rate 
	FROM conversions
	WHERE `date` BETWEEN :date_start AND :date_end
	GROUP BY `date`
	ORDER BY `date` ASC
SQL;

		return DB::connection($this->connection)->select($sql, $filter);
	}

	/**
	 * Retrieving performance data by platform
	 *
	 * NOTE: I have chosen to avoid using the Laravel Eloquent ORM here as it seems like
	 * the purpose of this portion of the project is to evaluate abilities to write SQL code.
	 *
	 * @param array $filter - can set filter indexes like date_start, date_end. By Default will retrieve records for
	 *                      last 30 days.
	 *
	 * @return array - A list of records from the conversions table with the filter applied.
	 */
	public function getPerformanceData(array $filter = [])
	{
		//By Default the
		$filter += [
			'date_start'   => date('Y-m-d', strtotime('-30 days')),
			'date_end'     => date('Y-m-d'),
			'country'      => null,
			'publisher_id' => null,
		];

		$where = "`date` BETWEEN :date_start AND :date_end";

		if ($filter['country']) {
			$where .= " AND `country` = :country";
		} else {
			unset($filter['country']);
		}

		if ($filter['publisher_id']) {
			$where .= " AND `publisher_id` = :publisher_id";
		} else {
			unset($filter['publisher_id']);
		}

		$sql = <<<SQL
	SELECT `date`,
	SUM(platform='iPhone' AND converted = 1) / SUM(platform='iPhone') as iphone,
	SUM(platform='iPad' AND converted = 1) / SUM(platform='iPad') as ipad,
	SUM(platform='Android' AND converted = 1) / SUM(platform='Android') as android
	FROM conversions
	WHERE $where
	GROUP BY `date`
	ORDER BY `date` ASC
SQL;

		$results = DB::connection($this->connection)->select($sql, $filter);

		$data = [];

		foreach ($results as $result) {
			$row    = [
				$result->date,
				(float)$result->iphone,
				(float)$result->ipad,
				(float)$result->android
			];
			$data[] = $row;
		}

		return $data;
	}
}
