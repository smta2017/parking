<?php namespace Tests\Repositories;

use App\Models\Zone;
use App\Repositories\ZoneRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ZoneRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ZoneRepository
     */
    protected $zoneRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->zoneRepo = \App::make(ZoneRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_zone()
    {
        $zone = Zone::factory()->make()->toArray();

        $createdZone = $this->zoneRepo->create($zone);

        $createdZone = $createdZone->toArray();
        $this->assertArrayHasKey('id', $createdZone);
        $this->assertNotNull($createdZone['id'], 'Created Zone must have id specified');
        $this->assertNotNull(Zone::find($createdZone['id']), 'Zone with given id must be in DB');
        $this->assertModelData($zone, $createdZone);
    }

    /**
     * @test read
     */
    public function test_read_zone()
    {
        $zone = Zone::factory()->create();

        $dbZone = $this->zoneRepo->find($zone->id);

        $dbZone = $dbZone->toArray();
        $this->assertModelData($zone->toArray(), $dbZone);
    }

    /**
     * @test update
     */
    public function test_update_zone()
    {
        $zone = Zone::factory()->create();
        $fakeZone = Zone::factory()->make()->toArray();

        $updatedZone = $this->zoneRepo->update($fakeZone, $zone->id);

        $this->assertModelData($fakeZone, $updatedZone->toArray());
        $dbZone = $this->zoneRepo->find($zone->id);
        $this->assertModelData($fakeZone, $dbZone->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_zone()
    {
        $zone = Zone::factory()->create();

        $resp = $this->zoneRepo->delete($zone->id);

        $this->assertTrue($resp);
        $this->assertNull(Zone::find($zone->id), 'Zone should not exist in DB');
    }
}
