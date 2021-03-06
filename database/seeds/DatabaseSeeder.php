<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ClientsTableSeeder::class);
        $this->call(BouquetsSeeder::class);
        $this->call(SortsSeeder::class);
        $this->call(BouquetSortSeeder::class);
        $this->call(PurchasesSeeder::class);        
        $this->call(BouquetPurchaseSeeder::class);


        $this->call(CountriesSeeder::class);
        $this->call(CompaniesSeeder::class);
        $this->call(ContactsSeeder::class);
        $this->call(CompanyContactSeeder::class);
        $this->call(PagesSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(PostsSeeder::class);
        $this->call(FormsSeeder::class);
    }

}
