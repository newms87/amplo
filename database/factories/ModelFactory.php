<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
	static $password;

	return [
		'name'           => $faker->name,
		'email'          => $faker->unique()->safeEmail,
		'password'       => $password ?: $password = bcrypt('secret'),
		'remember_token' => str_random(10),
	];
});

//Generates random conversions for publishers
$factory->define(App\Models\Conversion::class, function (Faker\Generator $faker) {
	static $publisher_ids;

	if (!$publisher_ids) {
		$publishers = App\Models\Publisher::all();

		foreach ($publishers as $publisher) {
			$publisher_ids[] = $publisher->id;
		}
	}

	//Converted chance is 6%
	$converted = $faker->boolean(6);

	//Impression date is anywhere starting 3 years ago until now
	$created_at = $faker->dateTimeBetween('-1 years');
	$updated_at = clone $created_at;

	if ($converted) {
		//Converted date is within 1 hour of impression timestamp
		$minutes = random_int(1, 60);
		$updated_at->add(new DateInterval('PT' . $minutes . 'M'));
	}

	//By Default 'Other', unless it is in the platform map list
	$platform = 'Other';

	$platform_map = [
		'/iphone/i'                => 'iPhone',
		'/ipad/i'                  => 'iPad',
		'/android/i'               => 'Android',
		//Faker does not produce Android user agent strings, so we are kinda faking the faker here
		//calling chrome mobile safari as Android, to populate data for android
		'/chrome.*mobile safari/i' => 'Android',
	];

	foreach ($platform_map as $regex => $label) {
		if (preg_match($regex, $faker->userAgent)) {
			$platform = $label;
			break;
		}
	}

	return [
		'publisher_id' => $faker->randomElement($publisher_ids),
		'ip'           => $faker->ipv4,
		'user_agent'   => $faker->userAgent,
		'platform'     => $platform,
		'country'      => $faker->country,
		'converted'    => $converted,
		'created_at'   => $created_at,
		'updated_at'   => $updated_at,
		'date'         => $created_at,
	];
});
