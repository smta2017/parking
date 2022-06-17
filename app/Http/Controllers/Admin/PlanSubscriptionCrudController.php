<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PlanSubscriptionRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PlanSubscriptionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PlanSubscriptionCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
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
        CRUD::setEntityNameStrings('plan subscription', 'plan subscriptions');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // CRUD::column('id');

        $this->crud->addColumn([
            'name'         => 'Subscriber.name', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => 'name', // Table column heading
        ]);
        $this->crud->addColumn([
            'name'         => 'Subscriber.phone', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => 'phone', // Table column heading
        ]);
        CRUD::column('starts_at')->type('datetime')->format('Y-M-D');
        CRUD::column('ends_at')->type('datetime')->format('Y-M-D');

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

        CRUD::field('id');
        CRUD::field('subscriber_type');
        CRUD::field('subscriber_id');
        CRUD::field('plan_id');
        CRUD::field('slug');
        CRUD::field('name');
        CRUD::field('description');
        CRUD::field('trial_ends_at');
        CRUD::field('starts_at');
        CRUD::field('ends_at');
        CRUD::field('cancels_at');
        CRUD::field('canceled_at');
        CRUD::field('timezone');
        CRUD::field('created_at');
        CRUD::field('updated_at');
        CRUD::field('deleted_at');

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
