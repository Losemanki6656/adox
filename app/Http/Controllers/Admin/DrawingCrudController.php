<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DrawingRequest;
use App\Models\Project;
use App\Models\Spare;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;


class DrawingCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;
    use BulkDeleteOperation;


    public function setup()
    {
        CRUD::setModel(\App\Models\Drawing::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/drawing');
        CRUD::setEntityNameStrings(trans('messages.drawing'), trans('messages.drawings'));
        CRUD::enableExportButtons();

        CRUD::addFilter([
            'name' => 'project_filter',
            'type' => 'select2',
            'label' => trans('backpack::base.filter_by_project')
        ], function () {
            return Project::pluck('name', 'id')->toArray();
        }, function ($value) {
            $this->crud->addClause('where', 'project_id', $value);
        });

        CRUD::addFilter([
            'name' => 'spare_filter',
            'type' => 'select2',
            'label' => trans('backpack::base.filter_by_spare')
        ], function () {
            return Spare::pluck('name', 'id')->toArray();
        }, function ($value) {
            $this->crud->addClause('where', 'spare_id', $value);
        });
    }


    protected function setupListOperation()
    {
        CRUD::with(['project', 'spare']);
        CRUD::column('id');
        CRUD::column('project_id')->label(trans('messages.projects'))->type('select');
        CRUD::column('spare_id')->label(trans('messages.spare'))->type('select');
        CRUD::column('count')->label(trans('messages.count'));
        CRUD::column('files')->type('array_count')->label('Files');
        CRUD::column('description')->label(trans('messages.description'));
        CRUD::column('created_at')->label(trans('messages.created_at'));


    }

    protected function setupShowOperation()
    {
        CRUD::with(['project', 'spare']);
        CRUD::column('project_id')->label(trans('messages.projects'))->type('select');
        CRUD::column('spare_id')->label(trans('messages.spare'))->type('select');
        CRUD::column('count')->label(trans('messages.count'));
        CRUD::column('files')->type('upload_multiple')->label('Files');
        CRUD::column('description')->label(trans('messages.description'));
        CRUD::column('created_at')->label(trans('messages.created_at'));


    }


    protected function setupCreateOperation()
    {
        CRUD::setValidation(DrawingRequest::class);

        CRUD::field('project_id')->label(trans('messages.projects'))->type('select2')->model('App\Models\Project');
        CRUD::field('spare_id')->label(trans('messages.spare'))->type('select2')->model('App\Models\Spare')->wrapper(['class' => 'form-group col-md-6']);
        CRUD::field('count')->label(trans('messages.count'))->wrapper(['class' => 'form-group col-md-6']);
        CRUD::addField([
            'name' => 'files',
            'label' => trans('messages.files'),
            'type' => 'upload_multiple',
            'upload' => true,
        ]);
        CRUD::field('description')->label(trans('messages.description'));

    }


    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
