<?php

use Faker\Factory;
use App\Model\Bouquet;
use Illuminate\Database\Seeder;

class BouquetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bouquet::truncate();

        $faker = Factory::create();

        factory(Bouquet::class, 100)->create();
    }
}
