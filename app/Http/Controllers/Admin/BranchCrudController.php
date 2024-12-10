<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BranchRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;


class BranchCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;


    public function setup()
    {
        CRUD::setModel(\App\Models\Branch::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/branch');
        CRUD::setEntityNameStrings(trans('messages.branch'), trans('messages.branches'));
    }


    protected function setupListOperation()
    {
        CRUD::column('id');
        CRUD::column('name')->label(trans('messages.name'));
        CRUD::column('phone')->label(trans('messages.phone'));
        CRUD::column('director')->label(trans('messages.director'));
        CRUD::column('address')->label(trans('messages.address'));
        CRUD::column('created_at')->label(trans('messages.created_at'));


    }


    protected function setupCreateOperation()
    {
        CRUD::setValidation(BranchRequest::class);

        CRUD::field('name')->label(trans('messages.name'))->wrapper(['class' => 'form-group col-md-6']);
        CRUD::field('phone')->type('phone')->label(trans('messages.phone'))->wrapper(['class' => 'form-group col-md-6']);
        CRUD::field('director')->label(trans('messages.director'))->wrapper(['class' => 'form-group col-md-6']);

        CRUD::addField([
            'name' => 'address',
            'label' => trans('messages.address'),
            'type' => 'text',
            'wrapper' => ['class' => 'form-group col-md-6']
        ]);


    }


    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
