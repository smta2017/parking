<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Zone;

class ZoneApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_zone()
    {
        $zone = Zone::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/zones', $zone
        );

        $this->assertApiResponse($zone);
    }

    /**
     * @test
     */
    public function test_read_zone()
    {
        $zone = Zone::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/zones/'.$zone->id
        );

        $this->assertApiResponse($zone->toArray());
    }

    /**
     * @test
     */
    public function test_update_zone()
    {
        $zone = Zone::factory()->create();
        $editedZone = Zone::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/zones/'.$zone->id,
            $editedZone
        );

        $this->assertApiResponse($editedZone);
    }

    /**
     * @test
     */
    public function test_delete_zone()
    {
        $zone = Zone::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/zones/'.$zone->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/zones/'.$zone->id
        );

        $this->response->assertStatus(404);
    }
}
