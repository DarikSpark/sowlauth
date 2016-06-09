<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name'           => $faker->name,
        'email'          => $faker->safeEmail,
        'password'       => str_random(10),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Model\News::class, function (Faker\Generator $faker) {
    return [
        'title'     => $faker->unique()->sentence(4),
        'date'      => $faker->dateTimeThisCentury,
        'published' => $faker->boolean(),
        'text'      => $faker->paragraph(5),
    ];
});

$factory->define(App\Model\Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(5),
        'text'  => $faker->paragraph(5),
    ];
});

$factory->define(App\Model\Page::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(5),
        'text'  => $faker->paragraph(5),
    ];
});

$factory->define(App\Model\Company::class, function (Faker\Generator $faker) {
    return [
        'title'   => $faker->unique()->company,
        'address' => $faker->streetAddress,
        'phone'   => $faker->phoneNumber,
    ];
});

$factory->define(App\Model\Country::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->unique()->country,
    ];
});

$factory->define(App\Model\Client::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('ru_RU');
    // $fakerEn = Faker\Factory::create();

    $carier = array(
            'Директор',
            'Менеджер по закупкам',
            'Акционер',
            'Флорист',
        );

    return [        
        'statusClient' => $faker->numberBetween($min = 1, $max = 5),
        'lastName' => $faker->lastName,
        'secondName' => $faker->middleNameMale,
        'firstName' => $faker->firstNameMale,
        'sex' => $faker->numberBetween($min = 0, $max = 1),
        'company' => $faker->company,
        'carier' => $carier[$faker->numberBetween($min = 0, $max = 3)],
        'telephone' => $faker->phoneNumber,
        'email' => $faker->email,
        'city' => $faker->city,
        'web' => $faker->freeEmailDomain,
        'skype' => $faker->userName,
        'address' => $faker->streetAddress,
        'verificity' => $faker->numberBetween($min = 0, $max = 1),
        'active' => $faker->numberBetween($min = 0, $max = 1),
        'birthday' => $faker->date($format = 'Y-m-d', $max = '-18 years'),
    ];
});

$factory->define(App\Model\Bouquet::class, function (Faker\Generator $faker) {
    // $faker = Faker\Factory::create();
    // $fakerEn = Faker\Factory::create();

    $description = array(
            'Наиболее популярный букет из 101 розы длинной 50 см и диаметром 5 см',
            'Букет из 51 розы длинной 40 см и диаметром 4 см',
            'Прекрасный букет к 8 марта из 101 розы в красивом оформлении',
            'Отличный подарок любимой женщине. 51 роза красного и белого цвета длиной 60 см',
        );

    return [
        'name' => $faker->unique()->firstNameFemale,
        'description' => $description[$faker->numberBetween($min=0, $max=3)],
        'image' => $faker->imageUrl($width = 400, $height = 400, $category = 'abstract'),
        'price' => $faker->numberBetween($min = 1500, $max = 5000),
        'active' => $faker->numberBetween($min = 0, $max = 1),
    ];
});

$factory->define(App\Model\Sort::class, function (Faker\Generator $faker) {
    // $faker = Faker\Factory::create('ru_RU');
    // $fakerEn = Faker\Factory::create();
    $length = $faker->randomElement([30, 40, 50, 60, 70, 80, 90]);

    return [        
        'sort' => $faker->unique()->firstNameFemale.' '.$length,
        'plantation' => $faker->city,
        'length' => $length,
        'weight' => $faker->numberBetween($min = 30, $max = 50),
        'cost' => $faker->numberBetween($min = 5, $max = 50),
    ];
}); 


$factory->define(App\Model\Form::class, function (Faker\Generator $faker) {
    return [
        'title'     => $faker->sentence(4),
        'textaddon' => $faker->sentence(2),
        'checkbox'  => $faker->boolean(),
        'date'      => $faker->date(),
        'time'      => $faker->time(),
        'timestamp' => $faker->dateTime,
        'select'    => $faker->optional()->randomElement([1, 2, 3]),
        'textarea'  => $faker->paragraph(5),
        'ckeditor'  => $faker->paragraph(5),
    ];
});

$factory->define(App\Model\Contact::class, function (Faker\Generator $faker) {
    return [
        'firstName'  => $faker->firstName,
        'lastName'   => $faker->lastName,
        'birthday'   => $faker->dateTimeThisCentury,
        'phone'      => $faker->phoneNumber,
        'address'    => $faker->address,
        'comment'    => $faker->paragraph(5),
        'height'     => $faker->randomNumber(2, true) + 100
    ];
});