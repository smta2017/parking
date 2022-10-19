<?php namespace Tests\Repositories;

use App\Models\ZoneBucket;
use App\Repositories\ZoneBucketRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ZoneBucketRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ZoneBucketRepository
     */
    protected $zoneBucketRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->zoneBucketRepo = \App::make(ZoneBucketRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_zone_bucket()
    {
        $zoneBucket = ZoneBucket::factory()->make()->toArray();

        $createdZoneBucket = $this->zoneBucketRepo->create($zoneBucket);

        $createdZoneBucket = $createdZoneBucket->toArray();
        $this->assertArrayHasKey('id', $createdZoneBucket);
        $this->assertNotNull($createdZoneBucket['id'], 'Created ZoneBucket must have id specified');
        $this->assertNotNull(ZoneBucket::find($createdZoneBucket['id']), 'ZoneBucket with given id must be in DB');
        $this->assertModelData($zoneBucket, $createdZoneBucket);
    }

    /**
     * @test read
     */
    public function test_read_zone_bucket()
    {
        $zoneBucket = ZoneBucket::factory()->create();

        $dbZoneBucket = $this->zoneBucketRepo->find($zoneBucket->id);

        $dbZoneBucket = $dbZoneBucket->toArray();
        $this->assertModelData($zoneBucket->toArray(), $dbZoneBucket);
    }

    /**
     * @test update
     */
    public function test_update_zone_bucket()
    {
        $zoneBucket = ZoneBucket::factory()->create();
        $fakeZoneBucket = ZoneBucket::factory()->make()->toArray();

        $updatedZoneBucket = $this->zoneBucketRepo->update($fakeZoneBucket, $zoneBucket->id);

        $this->assertModelData($fakeZoneBucket, $updatedZoneBucket->toArray());
        $dbZoneBucket = $this->zoneBucketRepo->find($zoneBucket->id);
        $this->assertModelData($fakeZoneBucket, $dbZoneBucket->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_zone_bucket()
    {
        $zoneBucket = ZoneBucket::factory()->create();

        $resp = $this->zoneBucketRepo->delete($zoneBucket->id);

        $this->assertTrue($resp);
        $this->assertNull(ZoneBucket::find($zoneBucket->id), 'ZoneBucket should not exist in DB');
    }
}
