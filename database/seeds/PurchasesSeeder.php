<?php

use App\Model\Purchase;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PurchasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Purchase::truncate();

        // DB::table('bouquet_sort')->truncate();

        $clients = App\Model\Client::all();
        $users = App\User::all();
        // $sorts = Sort::all();

        $faker = Factory::create('ru_RU');

        // foreach ($bouquets as $bouquet) {
        //     try {
        //         $count = $faker->numberBetween($min = 1, $max = 51);
        //         $bouquet->sorts()->attach($sorts->random(), ['count' => $count]);
                
        //         // $count = $bouquet->count + $count;
        //         $bouquet->count = $count;
        //         $bouquet->save();
        //     } catch (\Exception $e) {
                
        //     }
        // }

        for ($i=0; $i < 100; $i++) { 
        	try {

        		$purchase = Purchase::create();

	        	$purchase->user_id = $users->random()->id;
		        $purchase->client_id = $clients->random()->id;
		        $purchase->city_id = $faker->numberBetween($min = 1, $max = 50);
		        $purchase->status_bargain = $faker->numberBetween($min = 1, $max = 5);
		        $purchase->gpslong = $faker->numberBetween($min = 37405473, $max = 37785875)/1000000;
		        $purchase->gpslat = $faker->numberBetween($min = 55619746, $max = 55866095)/1000000;
		        $purchase->address = $faker->streetAddress;
		        $purchase->note = $faker->randomElement([
		        	'Заказ привезти вечером',
		        	'Удобно если привезут в офис к утру',
		        	'Желательно уведомить за 2 часа до доставки',
		        	'Хотелось бы получить заказ между 12 и 14 часов',
		        	'Желательно наличие вазы к букету',
		        	'Позвонить, когда будет проверена информация о наличии',
		        	]);
		        $purchase->delivery_date = $faker->dateTimeBetween($startDate = '-1 years', $endDate = '+1 month', $timezone = date_default_timezone_get());

		        $purchase->save();

        	} catch (\Exception $e) {
        		
        	}
        }
		
    }
}
