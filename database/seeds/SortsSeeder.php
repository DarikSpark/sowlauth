<?php

use Faker\Factory;
use App\Model\Sort;
use Illuminate\Database\Seeder;

class SortsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sort::truncate();

        $faker = Factory::create();

        factory(Sort::class, 100)->create();
    }
}
