<?php

use App\Model\Company;
use App\Model\Country;
use App\Model\Contact2;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Contact2::class, function (ModelConfiguration $model) {
    $model->setTitle('Контакты v.2')->setAlias('contacts2');

    $model->setMessageOndelete('<i class="fa fa-comment-o fa-lg"></i> Контакт успешно удален');

    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table();
        $display->with('country', 'companies');
        $display->setFilters([
            AdminDisplayFilter::related('country_id')->setModel(Country::class),
            AdminDisplayFilter::field('country.title')->setOperator(\SleepingOwl\Admin\Display\Filter\FilterBase::CONTAINS)
        ]);

        $display->setColumns([
            AdminColumn::image('photo')->setLabel('Photo')
                ->setWidth('100px'),
            AdminColumn::link('fullName')->setLabel('Name')
                ->setWidth('200px'),
            AdminColumn::datetime('birthday')->setLabel('Birthday')->setFormat('d.m.Y')
                ->setWidth('150px')
                ->setHtmlAttribute('class', 'text-center'),
            AdminColumn::text('country.title')->setLabel('Country')->append(AdminColumn::filter('country_id')),
            AdminColumn::lists('companies.title')->setLabel('Companies'),
        ]);

        return $display;
    });

    // Create And Edit
    $model->onCreateAndEdit(function($id = null) {
        $form = AdminForm::panel();

        $form->setItems(
            AdminFormElement::columns()
                ->addColumn(function() {
                    return [
                        AdminFormElement::text('firstName', 'First Name')
                            ->required('Please, type first name'),

                        AdminFormElement::text('lastName', 'Last Name')
                            ->required()
                            ->addValidationMessage('required', 'You need to set last name'),

                        AdminFormElement::text('phone', 'Phone'),
                        AdminFormElement::text('address', 'Address'),
                    ];
                })->addColumn(function() {
                    return [
                        AdminFormElement::image('photo', 'Photo'),
                        AdminFormElement::date('birthday', 'Birthday')->setFormat('d.m.Y'),
                    ];
                })->addColumn(function() {
                    return [
                        AdminFormElement::select('country_id', 'Country')->setModelForOptions(new Country)->setDisplay('title'),
                        AdminFormElement::multiselect('companies', 'Companies')->setModelForOptions(new Company)->setDisplay('title'),
                        AdminFormElement::wysiwyg('comment', 'Comment', 'simplemde')->disableFilter(),
                    ];
                })
        );

        $form->getButtons()
            ->setSaveButtonText('Save contact')
            ->hideCancelButton();

        return $form;
    });
});
