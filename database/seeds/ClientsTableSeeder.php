<?php

use Faker\Factory;
use App\Model\Client;
use Illuminate\Database\Seeder;
// use Symfony\Component\Finder\Finder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::truncate();

        $faker = Factory::create('ru_RU');

        factory(Client::class, 100)->create();

        //$imagesPath = config('sleeping_owl.imagesUploadDirectory', 'images/uploads');
        //$uploads = public_path($imagesPath);

        //$filesObj = Finder::create()->files()->in($uploads);
        // $files    = [];
        // foreach ($filesObj as $file) {
        //     $files[] = $file->getFilename();
        // }

        // $countries = Country::lists('id')->all();
        // $users     = User::lists('id')->all();

        


        // factory(Client::class, 100)->create()->each(function(Contact $contact) use($faker, $files, $users, $countries, $imagesPath) {
        //     $image = $faker->optional()->randomElement($files);

        //     $contact->author()->associate($faker->randomElement($users));
        //     $contact->country()->associate($faker->randomElement($countries));
        //     $contact->photo = is_null($image) ? $image : ($imagesPath.'/'.$image);

        //     $contact->save();
        // });
    }
}
