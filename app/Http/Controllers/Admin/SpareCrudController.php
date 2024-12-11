<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SpareRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;


class SpareCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use BulkDeleteOperation;


    public function setup()
    {
        CRUD::setModel(\App\Models\Spare::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/spare');
        CRUD::setEntityNameStrings(trans('messages.spare'), trans('messages.spares'));
        CRUD::enableExportButtons();
    }


    protected function setupListOperation()
    {
        CRUD::column('id');
        CRUD::column('name')->label(trans('messages.name'));
        CRUD::addColumn([
            'name' => 'type',
            'label' => trans('messages.type'),
            'type' => 'select_from_array',
            'options' => ['1' => 'кг', '2' => 'шт', '3' => 'кв.м'],
        ]);
        CRUD::column('created_at')->label(trans('messages.created_at'));

    }

    protected function setupShowOperation()
    {
        CRUD::column('name')->label(trans('messages.name'));
        CRUD::addColumn([
            'name' => 'type',
            'label' => trans('messages.type'),
            'type' => 'select_from_array',
            'options' => ['1' => 'кг', '2' => 'шт', '3' => 'кв.м'],
        ]);
        CRUD::column('created_at')->label(trans('messages.created_at'));

    }


    protected function setupCreateOperation()
    {
        CRUD::setValidation(SpareRequest::class);

        CRUD::field('name')->wrapper(['class' => 'form-group col-md-6']);
        CRUD::addField([
            'name' => 'type',
            'label' => trans('messages.type'),
            'type' => 'select_from_array',
            'options' => ['1' => 'кг', '2' => 'шт', '3' => 'кв.м'],
            'allows_null' => false,
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);


    }


    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
