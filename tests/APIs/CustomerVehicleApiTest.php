<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\CustomerVehicle;

class CustomerVehicleApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_customer_vehicle()
    {
        $customerVehicle = CustomerVehicle::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/customer_vehicles', $customerVehicle
        );

        $this->assertApiResponse($customerVehicle);
    }

    /**
     * @test
     */
    public function test_read_customer_vehicle()
    {
        $customerVehicle = CustomerVehicle::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/customer_vehicles/'.$customerVehicle->id
        );

        $this->assertApiResponse($customerVehicle->toArray());
    }

    /**
     * @test
     */
    public function test_update_customer_vehicle()
    {
        $customerVehicle = CustomerVehicle::factory()->create();
        $editedCustomerVehicle = CustomerVehicle::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/customer_vehicles/'.$customerVehicle->id,
            $editedCustomerVehicle
        );

        $this->assertApiResponse($editedCustomerVehicle);
    }

    /**
     * @test
     */
    public function test_delete_customer_vehicle()
    {
        $customerVehicle = CustomerVehicle::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/customer_vehicles/'.$customerVehicle->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/customer_vehicles/'.$customerVehicle->id
        );

        $this->response->assertStatus(404);
    }
}
