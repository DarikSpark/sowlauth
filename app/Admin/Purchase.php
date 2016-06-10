<?php

use App\Model\Purchase;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Purchase::class, function (ModelConfiguration $model) {
    $model->setTitle('Заказы');

    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns([
            AdminColumn::link('client.fullName')->setLabel('ФИО клиента'),
            AdminColumn::text('address')->setLabel('Адрес')->setHtmlAttribute('class', 'text-muted'),
            AdminColumn::text('note')->setLabel('Комментарий')->setHtmlAttribute('class', 'text-muted'),
        ]);

        $display->paginate(10);

        return $display;
    });

    // Create And Edit
    $model->onCreateAndEdit(function() {
        return $form = AdminForm::panel()->addBody(
            AdminFormElement::select('client_id', 'Имя клиента')->setModelForOptions(new App\Model\Client)->setDisplay('fullName'),
            AdminFormElement::select('user_id', 'Имя менеджера')->setModelForOptions(new App\User)->setDisplay('fullName'),
            AdminFormElement::select('city_id', 'Город'),         
            AdminFormElement::text('status_bargain', 'Статус заказа'),
            AdminFormElement::text('gpslong', 'Долгота'),
            AdminFormElement::text('gpslat', 'Широта'),
            AdminFormElement::textarea('address', 'Адрес')->setRows(2),
            AdminFormElement::textarea('note', 'Адрес')->setRows(3),
            AdminFormElement::date('delivery_date', 'Дата доставки')->setFormat('d.m.Y'),
            AdminFormElement::textarea('address', 'Адрес')->setRows(2)
        );

        return $form;
    });
})
    ->addMenuPage(Purchase::class, 0)
    ->setIcon('fa fa-bank');