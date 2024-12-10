<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProjectDetailRequest;
use App\Models\ProjectDetail;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class ProjectDetailCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;
    use BulkDeleteOperation;


    public function setup()
    {
        CRUD::setModel(ProjectDetail::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/project-detail');
        CRUD::setEntityNameStrings(trans('messages.project_detail'), trans('messages.project_details'));
    }


    protected function setupListOperation()
    {
        CRUD::with('project');
        CRUD::column('id');
        CRUD::column('project_id')->label(trans('messages.projects'));
        CRUD::column('name')->label(trans('messages.name'));
        CRUD::column('files')->type('array_count')->label('Files');
        CRUD::column('description')->label(trans('messages.description'));
        CRUD::column('created_at');


    }

    public function setupShowOperation()
    {
        CRUD::column('id');
        CRUD::column('project_id')->label(trans('messages.projects'));
        CRUD::column('name')->label(trans('messages.name'));
        CRUD::column('files')->type('upload_multiple')->label('Files');
        CRUD::column('description')->label(trans('messages.description'));
        CRUD::column('created_at');
    }


    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProjectDetailRequest::class);

        CRUD::field('project_id')->type('select2')->model('App\Models\Project')
            ->attribute('name')->entity('project')->label(trans('messages.projects'));

        CRUD::field('name')->label(trans('messages.name'))->wrapper(['class' => 'form-group col-md-6']);

        CRUD::addField([
            'name' => 'files',
            'label' => trans('messages.files'),
            'type' => 'upload_multiple',
            'upload' => true,
        ]);
        CRUD::field('description')->type('textarea')->label(trans('messages.description'));

    }


    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
