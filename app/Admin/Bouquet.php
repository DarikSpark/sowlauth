<?php

use App\Model\Bouquet;
use App\Model\Sort;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Bouquet::class, function (ModelConfiguration $model) {
    $model->setTitle('Букеты');

    $model->setMessageOndelete('<i class="fa fa-comment-o fa-lg"></i> Букет успешно удален');

    // Display
    $model->onDisplay(function () {
        // $display = AdminDisplay::datatables()->setHtmlAttribute('class', 'table-primary');
        // $display = AdminDisplay::table()->paginate(10);

        // $display->setHtmlAttribute('class', 'table-info table-hover');
        
        $display = AdminDisplay::table()->setColumns([
            $photo = AdminColumn::image('image')
                ->setLabel('Фото')
                ->setHtmlAttribute('class', 'hidden-sm hidden-xs')
                ->setWidth('100px'),
            AdminColumn::link('name')->setLabel('Название букета'),
            AdminColumn::text('description')->setLabel('Описание')->setHtmlAttribute('class', 'text-muted'),
            AdminColumn::text('price')->setLabel('Цена')->setHtmlAttribute('class', 'text-muted'),
            AdminColumn::text('active')->setLabel('Active')->setHtmlAttribute('class', 'text-muted'),
            AdminColumn::text('count')->setLabel('Количество')->setHtmlAttribute('class', 'text-muted'),
            AdminColumn::lists('sorts.sort')->setLabel('Сорта'),
            
        ]);

        // $display->setOrder([[1, 'asc']]);
        $display->paginate(10);

        return $display;
    });

    // Create And Edit
    $model->onCreateAndEdit(function() {
        return $form = AdminForm::panel()->addBody(
            AdminFormElement::text('name', 'Название букета'),          
            AdminFormElement::text('description', 'Описание'),
            AdminFormElement::text('image', 'Изображение'),
            AdminFormElement::text('price', 'Цена'),
            AdminFormElement::text('active', 'Active'),
            AdminFormElement::multiselect('sorts', 'Сорта')->setModelForOptions(new Sort)->setDisplay('sort')            
            // AdminFormElement::text('user_id')->setDefaultValue(auth()->user()->id)

        );

        return $form;
    });
})
    ->addMenuPage(Bouquet::class, 10)
    ->setIcon('fa fa-bank');