<?php

use App\Model\Bouquet;
use App\Model\Sort;
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

        foreach ($bouquets as $bouquet) {
            try {
                $bouquet->sorts()->attach($sorts->random());
            } catch (\Exception $e) {
                
            }
        }

        for ($i=0; $i < 100; $i++) { 
        	try {
        		$bouquets->random()->sorts()->attach($sorts->random());
        	} catch (\Exception $e) {
        		
        	}
        }
    }
}
