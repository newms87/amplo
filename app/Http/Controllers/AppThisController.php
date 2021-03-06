<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use App\Models\Conversion;
use App\Library\Appthis;

class AppThisController extends Controller
{
	public function report()
	{
		return view('appthis.report');
	}

	public function getPublisherStats()
	{
		return Publisher::all();
	}

	public function getStatsByDay()
	{
		return (new Conversion)->getStatsByDay($_GET);
	}

	public function getPerformanceData()
	{
		return (new Conversion)->getPerformanceData($_GET);
	}

	public function getCountries()
	{
		return (new Conversion)->getCountries();
	}

	public function getPublishers()
	{
		return (new Publisher)->get();
	}

	public function generateImpressions()
	{
		$impressions = @$_GET['impressions'] ?: 10000;

		factory(\App\Models\Conversion::class, (int)$impressions)->create();

		return ['success' => "Generated $impressions impressions"];
	}

	public function runAlgorithm()
	{
		$digits = (array)@explode(',', preg_replace("/[\\s]/", '', $_GET['digits']));
		$teams = (int)@$_GET['teams'];

		return (new Appthis)->algorithmOptimized($digits, $teams);
	}
}
