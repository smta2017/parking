<?php namespace Tests\Repositories;

use App\Models\CustomerVehicle;
use App\Repositories\CustomerVehicleRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CustomerVehicleRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var CustomerVehicleRepository
     */
    protected $customerVehicleRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->customerVehicleRepo = \App::make(CustomerVehicleRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_customer_vehicle()
    {
        $customerVehicle = CustomerVehicle::factory()->make()->toArray();

        $createdCustomerVehicle = $this->customerVehicleRepo->create($customerVehicle);

        $createdCustomerVehicle = $createdCustomerVehicle->toArray();
        $this->assertArrayHasKey('id', $createdCustomerVehicle);
        $this->assertNotNull($createdCustomerVehicle['id'], 'Created CustomerVehicle must have id specified');
        $this->assertNotNull(CustomerVehicle::find($createdCustomerVehicle['id']), 'CustomerVehicle with given id must be in DB');
        $this->assertModelData($customerVehicle, $createdCustomerVehicle);
    }

    /**
     * @test read
     */
    public function test_read_customer_vehicle()
    {
        $customerVehicle = CustomerVehicle::factory()->create();

        $dbCustomerVehicle = $this->customerVehicleRepo->find($customerVehicle->id);

        $dbCustomerVehicle = $dbCustomerVehicle->toArray();
        $this->assertModelData($customerVehicle->toArray(), $dbCustomerVehicle);
    }

    /**
     * @test update
     */
    public function test_update_customer_vehicle()
    {
        $customerVehicle = CustomerVehicle::factory()->create();
        $fakeCustomerVehicle = CustomerVehicle::factory()->make()->toArray();

        $updatedCustomerVehicle = $this->customerVehicleRepo->update($fakeCustomerVehicle, $customerVehicle->id);

        $this->assertModelData($fakeCustomerVehicle, $updatedCustomerVehicle->toArray());
        $dbCustomerVehicle = $this->customerVehicleRepo->find($customerVehicle->id);
        $this->assertModelData($fakeCustomerVehicle, $dbCustomerVehicle->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_customer_vehicle()
    {
        $customerVehicle = CustomerVehicle::factory()->create();

        $resp = $this->customerVehicleRepo->delete($customerVehicle->id);

        $this->assertTrue($resp);
        $this->assertNull(CustomerVehicle::find($customerVehicle->id), 'CustomerVehicle should not exist in DB');
    }
}
