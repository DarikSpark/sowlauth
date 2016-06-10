<?php

use SleepingOwl\Admin\Navigation\Page;

return [
[
        'title' => "Демо",
        'icon' => 'fa fa-credit-card',
        'pages' => [
            (new Page(\App\Model\Company::class))
                ->setIcon('fa fa-fax')
                ->setPriority(0),
            (new Page(\App\Model\Post::class))
                ->setIcon('fa fa-fax')
                ->setPriority(100),
            (new Page(\App\Model\Country::class))
                ->setIcon('fa fa-fax')
                ->setPriority(200),
            (new Page(\App\Model\Page::class))
                ->setIcon('fa fa-fax')
                ->setPriority(400),
            (new Page(\App\Model\Form::class))
                ->setIcon('fa fa-fax')
                ->setPriority(500),

        ]
    ],
    [
        'title' => "Контакты",
        'icon' => 'fa fa-credit-card',
        'pages' => [
            (new Page(\App\Model\Contact::class))
                ->setIcon('fa fa-fax')
                ->setPriority(0),
            (new Page(\App\Model\Contact2::class))
                ->setIcon('fa fa-fax')
                ->setPriority(100),
            (new Page(\App\Model\Contact3::class))
                ->setIcon('fa fa-fax')
                ->setPriority(200),
            (new Page(\App\Model\Contact4::class))
                ->setIcon('fa fa-fax')
                ->setPriority(400),
        ]
    ],
    [
        'title' => "Контент",
        'icon' => 'fa fa-newspaper-o',
        'pages' => [
            (new Page(\App\Model\News::class))
                ->setIcon('fa fa-newspaper-o')
                ->setPriority(0),
            (new Page(\App\Model\News2::class))
                ->setIcon('fa fa-newspaper-o')
                ->setPriority(10),
            (new Page(\App\Model\News3::class))
                ->setIcon('fa fa-newspaper-o')
                ->setPriority(20),
            (new Page(\App\Model\News4::class))
                ->setIcon('fa fa-newspaper-o')
                ->setPriority(30),
            (new Page(\App\Model\News5::class))
                ->setIcon('fa fa-newspaper-o')
                ->setPriority(40)
        ]
    ]//,
    // [
    //     'title' => 'Допуски',
    //     'icon' => 'fa fa-group',
    //     'pages' => [
    //         (new Page(\App\User::class))
    //             ->setIcon('fa fa-user')
    //             ->setPriority(0),
    //         (new Page(\App\Role::class))
    //             ->setIcon('fa fa-group')
    //             ->setPriority(100)
    //     ]
    // ]
];