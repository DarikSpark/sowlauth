<?php

use App\Model\Bouquet;
use App\Model\Sort;
use Faker\Factory;
use Illuminate\Database\Seeder;

class BouquetSortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bouquet_sort')->truncate();

        $bouquets = Bouquet::all();
        $sorts = Sort::all();
        $faker = Factory::create();

        foreach ($bouquets as $bouquet) {
            try {
                $count = $faker->numberBetween($min = 1, $max = 51);
                $bouquet->sorts()->attach($sorts->random(), ['count' => $count]);
                
                // $count = $bouquet->count + $count;
                $bouquet->count = $count;
                $bouquet->save();
            } catch (\Exception $e) {
                
            }
        }

        for ($i=0; $i < 100; $i++) { 
        	try {
                $count = $faker->numberBetween($min = 1, $max = 51);
                $bouquet = $bouquets->random();
        		$bouquet->sorts()->attach($sorts->random());
                $count = $bouquet->count + $count;
                $bouquet->count = $count;
                $bouquet->save();

        	} catch (\Exception $e) {
        		
        	}
        }
    }
}
