<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DrawingRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;


class DrawingCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;


    public function setup()
    {
        CRUD::setModel(\App\Models\Drawing::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/drawing');
        CRUD::setEntityNameStrings('drawing', 'drawings');
    }


    protected function setupListOperation()
    {
        CRUD::column('id');
        CRUD::column('project_id');
        CRUD::column('spare_id');
        CRUD::column('count');
        CRUD::column('files');
        CRUD::column('description');
        CRUD::column('created_at');
        CRUD::column('updated_at');
        CRUD::column('deleted_at');


    }


    protected function setupCreateOperation()
    {
        CRUD::setValidation(DrawingRequest::class);

        CRUD::field('project_id')->type('select2')->model('App\Models\Project');
        CRUD::field('description');
        CRUD::addField([
            'name' => 'testimonials',
            'label' => trans('messages.spares'),
            'type' => 'repeatable',
            'fields' => [
                [
                    'name' => 'spare_id',
                    'type' => 'select2',
                    'model' => 'App\Models\Spare',
                    'label' => trans('messages.spare'),
                    'wrapper' => ['class' => 'form-group col-md-4'],
                ],
                [
                    'name' => 'count',
                    'type' => 'number',
                    'label' => trans('messages.count'),
                    'wrapper' => ['class' => 'form-group col-md-4'],
                ],
                [
                    'name' => 'files',
                    'type' => 'upload_multiple',
                    'upload' => true,
                    'label' => trans('messages.files'),
                    'wrapper' => ['class' => 'form-group col-md-4'],
                ]
            ],
            'new_item_label' => trans('messages.add_group'),
            'init_rows' => 1,
            'min_rows' => 1,
            'max_rows' => 20,
        ]);


    }


    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
