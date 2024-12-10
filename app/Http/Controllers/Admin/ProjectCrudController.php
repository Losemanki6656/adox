<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;


class ProjectCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;
    use BulkDeleteOperation;


    public function setup()
    {
        CRUD::setModel(Project::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/project');
        CRUD::setEntityNameStrings(trans('messages.project'), trans('messages.projects'));
    }


    protected function setupListOperation()
    {
        CRUD::column('id');
        CRUD::column('name')->label(trans('messages.name'));
        CRUD::column('client_name')->label(trans('messages.client_name'));
        CRUD::column('phone')->type('phone')->label(trans('messages.phone'));
        CRUD::column('amount')->type('number')->label(trans('messages.amount'));
        CRUD::column('created_at')->label(trans('messages.created_at'));

    }


    public function setupShowOperation()
    {
        CRUD::set('show.setFromDb', false);
        CRUD::column('name')->label(trans('messages.name'));
        CRUD::column('client_name')->label(trans('messages.client_name'));
        CRUD::column('phone')->label(trans('messages.phone'))->type('phone');
        CRUD::column('amount')->type('number')->label(trans('messages.amount'));
        CRUD::column('created_at')->label(trans('messages.created_at'));
    }


    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }


    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProjectRequest::class);

        CRUD::addField([
            'name' => 'coordinate',
            'label' => trans('messages.coordinate'),
            'type' => 'map'
        ]);

        CRUD::field('name')->label(trans('messages.name'))->wrapper(['class' => 'form-group col-md-6']);
        CRUD::field('client_name')->label(trans('messages.client_name'))->wrapper(['class' => 'form-group col-md-6']);

        CRUD::field('phone')
            ->type('phone')
            ->label(trans('messages.phone'))
            ->wrapper(['class' => 'form-group col-md-6']);

        CRUD::field('amount')->label(trans('messages.amount'))->wrapper(['class' => 'form-group col-md-6']);

    }
}
