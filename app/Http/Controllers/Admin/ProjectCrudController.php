<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Requests\ProjectRequest;
    use App\Models\Project;
    use Backpack\CRUD\app\Http\Controllers\CrudController;
    use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
    use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

    /**
     * Class ProjectCrudController
     * @package App\Http\Controllers\Admin
     * @property-read CrudPanel $crud
     */
    class ProjectCrudController extends CrudController
    {
        use ListOperation;
        use CreateOperation;
        use UpdateOperation;
        use DeleteOperation;
        use ShowOperation;

        /**
         * Configure the CrudPanel object. Apply settings to all operations.
         * @return void
         */
        public function setup()
        {
            CRUD::setModel(Project::class);
            CRUD::setRoute(config('backpack.base.route_prefix') . '/project');
            CRUD::setEntityNameStrings('project', 'projects');
        }

        /**
         * Define what happens when the List operation is loaded.
         * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
         * @return void
         */
        protected function setupListOperation()
        {
            CRUD::column('id');
            CRUD::column('name');
            CRUD::column('client_name');
            CRUD::column('phone');
            CRUD::column('amount');
            CRUD::column('created_at');

            /**
             * Columns can be defined using the fluent syntax or array syntax:
             * - CRUD::column('price')->type('number');
             * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
             */
        }

        /**
         * Define what happens when the Update operation is loaded.
         * @see https://backpackforlaravel.com/docs/crud-operation-update
         * @return void
         */
        protected function setupUpdateOperation()
        {
            $this->setupCreateOperation();
        }

        /**
         * Define what happens when the Create operation is loaded.
         * @see https://backpackforlaravel.com/docs/crud-operation-create
         * @return void
         */
        protected function setupCreateOperation()
        {
            CRUD::setValidation(ProjectRequest::class);

            CRUD::addField([
                'name' => 'coordinate',
                'label' => trans('messages.coordinate'),
                'type' => 'map'
            ]);

            CRUD::field;
            CRUD::field('client_name');

            CRUD::field('phone');
            CRUD::field('amount');

            /**
             * Fields can be defined using the fluent syntax or array syntax:
             * - CRUD::field('price')->type('number');
             * - CRUD::addField(['name' => 'price', 'type' => 'number']));
             */
        }
    }
