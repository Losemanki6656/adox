<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DrawingRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;


class DrawingCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation  { store as traitStore; }
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;


    public function setup()
    {
        CRUD::setModel(\App\Models\Drawing::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/drawing');
        CRUD::setEntityNameStrings(trans('messages.drawing'), trans('messages.drawings'));
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

        CRUD::field('project_id')->label(trans('messages.projects'))->type('select2')->model('App\Models\Project');
        CRUD::field('description')->label(trans('messages.description'));
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
            'init_rows' => 0,
            'min_rows' => 1,
            'max_rows' => 20,
        ]);

    }

    public function store(Request $request)
    {
        $this->crud->validateRequest(DrawingRequest::class);

        $project = $request->project_id;
        $des = $request->description;
        $t = json_decode($request->testimonials);

        foreach ($t as $item) {
            $files = $item->files;
            dd($files);
        }

        dd($t);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
