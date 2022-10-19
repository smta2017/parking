<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ZoneBucket;

class ZoneBucketApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_zone_bucket()
    {
        $zoneBucket = ZoneBucket::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/zone_buckets', $zoneBucket
        );

        $this->assertApiResponse($zoneBucket);
    }

    /**
     * @test
     */
    public function test_read_zone_bucket()
    {
        $zoneBucket = ZoneBucket::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/zone_buckets/'.$zoneBucket->id
        );

        $this->assertApiResponse($zoneBucket->toArray());
    }

    /**
     * @test
     */
    public function test_update_zone_bucket()
    {
        $zoneBucket = ZoneBucket::factory()->create();
        $editedZoneBucket = ZoneBucket::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/zone_buckets/'.$zoneBucket->id,
            $editedZoneBucket
        );

        $this->assertApiResponse($editedZoneBucket);
    }

    /**
     * @test
     */
    public function test_delete_zone_bucket()
    {
        $zoneBucket = ZoneBucket::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/zone_buckets/'.$zoneBucket->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/zone_buckets/'.$zoneBucket->id
        );

        $this->response->assertStatus(404);
    }
}
