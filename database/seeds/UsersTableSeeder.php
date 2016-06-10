<?php

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Role::truncate();
        DB::table('role_user')->truncate();
        Permission::truncate();

        $faker = Faker\Factory::create('ru_RU');
        $lastName = $faker->lastName;
        $secondName = $faker->middleNameMale;
        $firstName = $faker->firstNameMale;

        $adminUser = User::create([
            // 'name' => 'admin',
            'fullName' => $lastName.' '.$firstName.' '.$secondName,
            'lastName' => $lastName,
            'secondName' => $secondName,
            'firstName' => $firstName,  
            'name'     => 'admin',
            'email'    => 'admin@site.com',
            'telephone'    => '+7 (935) 546-78-45',
            'password' => 'password',
        ]);

        $lastName = $faker->lastName;
        $secondName = $faker->middleNameMale;
        $firstName = $faker->firstNameMale;

        $testUser = User::create([
            // 'name' => $faker->userName,
            'fullName' => $lastName.' '.$firstName.' '.$secondName,
            'lastName' => $lastName,
            'secondName' => $secondName,
            'firstName' => $firstName,      
            'name'     => 'manager',
            'email'    => 'manager@site.com',
            'telephone'    => '+7 (935) 546-78-46',
            'password' => 'password',
        ]);

        $adminRole = Role::create([
            'name'  => 'admin',
            'label' => 'Administrator'
        ]);

        $managerRole = Role::create([
            'name'  => 'manager',
            'label' => 'Manager'
        ]);

        $adminUser->roles()->attach($adminRole);
        $adminUser->roles()->attach($managerRole);

        $testUser->roles()->attach($managerRole);

        // factory(User::class, 10)->create();

        for ($i=0; $i < 10; $i++) { 
            try {
                $lastName = $faker->lastName;
                $secondName = $faker->middleNameMale;
                $firstName = $faker->firstNameMale;

                $user = User::create([
                    'name' => $faker->unique()->userName,
                    'fullName' => $lastName.' '.$firstName.' '.$secondName,
                    'lastName' => $lastName,
                    'secondName' => $secondName,
                    'firstName' => $firstName,
                    'email'          => $faker->safeEmail,
                    'telephone'    => $faker->phoneNumber,  
                    'password'       => 'password',
                    // 'remember_token' => str_random(10),
                ]);

                $user->roles()->attach($managerRole);

            } catch (\Exception $e) {
                
            }
        }
    }
}
