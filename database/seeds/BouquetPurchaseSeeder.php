<?php

use Illuminate\Database\Seeder;

class BouquetPurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bouquet_purchase')->truncate();

        $bouquets = App\Model\Bouquet::all();
        $purchases = App\Model\Purchase::all();
        $faker = Faker\Factory::create();

        foreach ($purchases as $purchase) {
            try {
            	$count = $faker->randomElement([1,1,1,1,1,1,1,1,2,2,2,3]);
                $purchase->bouquets()->attach($bouquets->random(), ['count' => $count]);
            } catch (\Exception $e) {
                
            }
        }

        for ($i=0; $i < 200; $i++) { 
        	try {
        		$count = $faker->randomElement([1,1,1,1,1,1,1,1,2,2,2,3]);
                $purchases->random()->bouquets()->attach($bouquets->random(), ['count' => $count]);

        	} catch (\Exception $e) {
        		
        	}
        }
    }
}
