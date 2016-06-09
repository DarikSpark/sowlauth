<?php

use App\Model\Sort;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Sort::class, function (ModelConfiguration $model) {
    $model->setTitle('Сорты цветов');

    // Display
    $model->onDisplay(function () {
        // $display = AdminDisplay::datatables()->setHtmlAttribute('class', 'table-primary');
        // $display = AdminDisplay::table()->paginate(10);

        // $display->setHtmlAttribute('class', 'table-info table-hover');
        
        $display = AdminDisplay::table()->setColumns([
            // $photo = AdminColumn::image('image')
            //     ->setLabel('Photo<br/><small>(image)</small>')
            //     ->setHtmlAttribute('class', 'hidden-sm hidden-xs')
            //     ->setWidth('100px'),
            AdminColumn::link('sort')->setLabel('Название сорта'),
            AdminColumn::text('plantation')->setLabel('Плантация')->setHtmlAttribute('class', 'text-muted'),
            AdminColumn::text('length')->setLabel('Длина')->setHtmlAttribute('class', 'text-muted'),
            AdminColumn::text('weight')->setLabel('Вес')->setHtmlAttribute('class', 'text-muted'),
            AdminColumn::text('cost')->setLabel('Цена')->setHtmlAttribute('class', 'text-muted'),
        ]);

        // $display->setOrder([[1, 'asc']]);
        $display->paginate(15);

        return $display;
    });

    // Create And Edit
    $model->onCreateAndEdit(function() {
        return $form = AdminForm::panel()->addBody(
            AdminFormElement::text('sort', 'Название сорта'),          
            AdminFormElement::text('plantation', 'Плантация'),
            AdminFormElement::text('length', 'Длина'),
            AdminFormElement::text('weight', 'Вес'),
            AdminFormElement::text('cost', 'Цена')            
            // AdminFormElement::text('user_id')->setDefaultValue(auth()->user()->id)

        );

        return $form;
    });
})
    ->addMenuPage(Sort::class, 0)
    ->setIcon('fa fa-bank');