<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PlanSubscriptionRequest;
use App\Models\CustomerVehicle;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Client\Request;
use PhpParser\Node\Stmt\Label;

/**
 * Class PlanSubscriptionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PlanSubscriptionCrudController extends CrudController
{

    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    // use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\PlanSubscription::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/plan-subscription');
        CRUD::setEntityNameStrings(trans('backpack::crud.model.subscribe'), trans('backpack::crud.model.subscribes'));
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
            'name'      => 'Subscriber.plate_image', // The db column name
            'label'     => trans('backpack::crud.model.plate_image'), // Table column heading
            'type'      => 'image',
            'prefix' => 'storage/',
            // image from a different disk (like s3 bucket)
            // 'disk'   => 'disk-name', 
            // optional width/height if 25px is not ok with you
            'height' => '50px',
            'width'  => '70px',
        ]);

        // $this->crud->addColumn([
        //     // 1-n relationship
        //     'label'     => trans('backpack::crud.model.plate_image'), // Table column heading
        //     'type'      => 'select',
        //     'name'      => 'subscriber_id', // the column that contains the ID of that connected entity;
        //     'entity'    => 'Subscriber', // the method that defines the relationship in your Model
        //     'attribute' => 'plate_image', // foreign key attribute that is shown to user
        //     'model'     => "App\Models\PlanSubscription", // foreign key model
        //     'key' => 'pate_image',
        // ]);

        ############------  FINE  -----###########
        $this->crud->addColumn([
            // 1-n relationship
            'label'     => trans('backpack::crud.model.plate_number'), // Table column heading
            'type'      => 'select',
            'name'      => 'subscriber_id', // the column that contains the ID of that connected entity;
            'entity'    => 'Subscriber', // the method that defines the relationship in your Model
            'attribute' => 'plate_number', // foreign key attribute that is shown to user
            'model'     => "App\Models\PlanSubscription", // foreign key model
        ]);
        ############------  FINE  -----###########



        $this->crud->addColumn([
            'name'         => 'Vehicle.Customer.name', // name of relationship method in the model
            'label'        => trans('backpack::crud.model.customer'), // Table column heading
        ]);

        CRUD::column('starts_at')->label(trans('backpack::crud.model.starts'))->type('datetime')->format('Y-M-D');
        CRUD::column('ends_at')->label(trans('backpack::crud.model.ends'))->type('datetime')->format('Y-M-D');


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
        CRUD::setValidation(PlanSubscriptionRequest::class);

        // CRUD::field('id');
        // CRUD::field('subscriber_type');
        // CRUD::field('Subscriber');


        CRUD::addField([
            'label'     => "Subscriber",
            'type'      => 'select',
            'name'      => 'subscriber_id', // the db column for the foreign key
            'entity'    => 'Vehicle',

        ]);

        // // CRUD::field('plan_id');
        // CRUD::field('plan_id')->type('hidlden')->value(1);
        // CRUD::field('subscriber_type')->typel('hidden')->value('App\Models\CustomerVehicle');

        // CRUD::field('slug')->type('hidden')->value(CRUD::field('subscriber_id'));
        // CRUD::field('name')->type('hidden')->value('test');
        // CRUD::field('description');
        // CRUD::field('trial_ends_at');
        // CRUD::field('starts_at');
        // CRUD::field('ends_at');
        // CRUD::field('cancels_at');
        // CRUD::field('canceled_at');
        // CRUD::field('timezone');
        // CRUD::field('created_at');
        // CRUD::field('updated_at');
        // CRUD::field('deleted_at');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }


    public function store(PlanSubscriptionRequest $request)
    {
        $vehicle_id = $request["subscriber_id"];

        $plan = app('rinvex.subscriptions.plan')->find(1);

        $vehicle = CustomerVehicle::findOrFail($vehicle_id);

        $new_subscription = $vehicle->newSubscription($vehicle["plate_number"] . "-" . $vehicle['name'] . '-' . $plan['name'], $plan);

        return \response()->redirectTo(CRUD::getRoute());
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
