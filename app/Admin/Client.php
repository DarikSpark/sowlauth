<?php

use App\Model\Client;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Client::class, function (ModelConfiguration $model) {
    $model->setTitle('Клиенты');

    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns([
            AdminColumn::link('firstName')->setLabel('Firstname')->setWidth('400px'),
            AdminColumn::text('address')->setLabel('Address')->setHtmlAttribute('class', 'text-muted'),
        ]);

        $display->paginate(15);

        return $display;
    });

    // Create And Edit
    $model->onCreateAndEdit(function() {
        return $form = AdminForm::panel()->addBody(
            AdminFormElement::text('statusClient', 'Статус клиента'),          
            AdminFormElement::text('lastName', 'Фамилия'),
            AdminFormElement::text('firstName', 'Имя'),
            AdminFormElement::text('secondName', 'Отчество'),
            AdminFormElement::date('birthday', 'День рождения')->setFormat('d.m.Y'),
            AdminFormElement::text('sex', 'Пол'),
            AdminFormElement::text('company', 'Компания'),
            AdminFormElement::text('carier', 'Должность'),
            AdminFormElement::text('telephone', 'Телефон'),
            AdminFormElement::text('email', 'E-mail'),
            AdminFormElement::text('city', 'Город'),
            AdminFormElement::text('skype', 'Skype'),
            AdminFormElement::textarea('address', 'Адрес')->setRows(2),
            AdminFormElement::text('verificity', 'Достоверность'),
            AdminFormElement::text('active', 'Active')            
            // AdminFormElement::text('user_id')->setDefaultValue(auth()->user()->id)

        );

        return $form;
    });
})
    ->addMenuPage(Client::class, 10)
    ->setIcon('fa fa-bank');