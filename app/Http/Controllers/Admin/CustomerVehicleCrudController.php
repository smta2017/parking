<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CustomerVehicleRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CustomerVehicleCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CustomerVehicleCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\CustomerVehicle::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/customer-vehicle');
        CRUD::setEntityNameStrings(trans('backpack::crud.model.vehicle'), trans('backpack::crud.model.vehicles'));
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('id')->label('#');
        CRUD::addColumn([
            'name'      => 'plate_image', // The db column name
            'label'     => trans('backpack::crud.model.plate_image'), // Table column heading
            'type'      => 'image',
            'prefix' => 'storage/',
            // image from a different disk (like s3 bucket)
            // 'disk'   => 'disk-name', 
            // optional width/height if 25px is not ok with you
            'height' => '50px',
            'width'  => '70px',
        ]);
        CRUD::column('plate_number')->label(trans('backpack::crud.model.plate_number'));
        CRUD::column('customer_id')->searchLogic('text')->label(trans('backpack::crud.model.name'));

        $this->crud->addClause('customerVehicle');

        // CRUD::column('vehicle_color');
        // CRUD::column('vehicle_brand');
        // CRUD::column('vehicle_model');
        // CRUD::column('vehicle_model_year');
        // CRUD::column('vehicle_type');
        // CRUD::column('license_number');
        // CRUD::column('license_expiration');


        // ========================================= BUTTONS ==================================================

        CRUD::button('subscribe')->stack('line')->modelFunction('subscribe')->makeFirst();
        CRUD::button('printQr')->stack('line')->modelFunction('printQr')->makeFirst();

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CustomerVehicleRequest::class);

        CRUD::addField([
            'name' => 'Customer',
            'options'   => (function ($query) {
                return $query->where('is_customer', '1')->get();
            })
        ]);

        CRUD::field('plate_number');
        CRUD::addField(
            [   // Upload
                'name'      => 'plate_image',
                'label'     => 'Image',
                'type'      => 'upload',
                'upload'    => true,
                'disk'      => 'public', // if you store files in the /public folder, please omit this; if you store them in /storage or S3, please specify it;
                // optional:
                // 'temporary' => 10 // if using a service, such as S3, that requires you to make temporary URLs this will make a URL that is valid for the number of minutes specified
            ]
        );
        // CRUD::field('plate_image');
        // CRUD::field('vehicle_color');
        // CRUD::field('vehicle_brand');
        // CRUD::field('vehicle_model');
        // CRUD::field('vehicle_model_year');
        // CRUD::field('vehicle_type');
        // CRUD::field('license_number');
        // CRUD::field('license_expiration');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
