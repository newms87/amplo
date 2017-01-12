<?php

use Illuminate\Database\Seeder;

class ConversionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    factory(App\Models\Conversion::class, 10000)->create();
    }
}
