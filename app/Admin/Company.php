<?php

use App\Model\Company;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Company::class, function (ModelConfiguration $model) {
    $model->setTitle('Companies');

    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table()->setColumns([
            AdminColumn::link('title')->setLabel('Title')->setWidth('400px'),
            AdminColumn::text('address')->setLabel('Address')->setHtmlAttribute('class', 'text-muted'),
        ]);

        $display->paginate(15);

        return $display;
    });

    // Create And Edit
    $model->onCreateAndEdit(function() {
        return $form = AdminForm::panel()->addBody(
            AdminFormElement::text('title', 'Title')->required()->unique(),
            AdminFormElement::textarea('address', 'Address')->setRows(2),
            AdminFormElement::text('phone', 'Phone')
        );

        return $form;
    });
})
    ->addMenuPage(Company::class, 0)
    ->setIcon('fa fa-bank');