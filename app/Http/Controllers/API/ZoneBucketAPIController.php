<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateZoneBucketAPIRequest;
use App\Http\Requests\API\UpdateZoneBucketAPIRequest;
use App\Models\ZoneBucket;
use App\Repositories\ZoneBucketRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ZoneBucketResource;
use Response;

/**
 * Class ZoneBucketController
 * @package App\Http\Controllers\API
 */

class ZoneBucketAPIController extends AppBaseController
{
    /** @var  ZoneBucketRepository */
    private $zoneBucketRepository;

    public function __construct(ZoneBucketRepository $zoneBucketRepo)
    {
        $this->zoneBucketRepository = $zoneBucketRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/zoneBuckets",
     *      summary="Get a listing of the ZoneBuckets.",
     *      tags={"ZoneBucket"},
     *      description="Get all ZoneBuckets",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/ZoneBucket")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $zoneBuckets = $this->zoneBucketRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ZoneBucketResource::collection($zoneBuckets), 'Zone Buckets retrieved successfully');
    }

    /**
     * @param CreateZoneBucketAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/zoneBuckets",
     *      summary="Store a newly created ZoneBucket in storage",
     *      tags={"ZoneBucket"},
     *      description="Store ZoneBucket",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ZoneBucket that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ZoneBucket")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/ZoneBucket"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateZoneBucketAPIRequest $request)
    {
        $input = $request->all();

        $zoneBucket = $this->zoneBucketRepository->create($input);

        return $this->sendResponse(new ZoneBucketResource($zoneBucket), 'Zone Bucket saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/zoneBuckets/{id}",
     *      summary="Display the specified ZoneBucket",
     *      tags={"ZoneBucket"},
     *      description="Get ZoneBucket",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ZoneBucket",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/ZoneBucket"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var ZoneBucket $zoneBucket */
        $zoneBucket = $this->zoneBucketRepository->find($id);

        if (empty($zoneBucket)) {
            return $this->sendError('Zone Bucket not found');
        }

        return $this->sendResponse(new ZoneBucketResource($zoneBucket), 'Zone Bucket retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateZoneBucketAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/zoneBuckets/{id}",
     *      summary="Update the specified ZoneBucket in storage",
     *      tags={"ZoneBucket"},
     *      description="Update ZoneBucket",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ZoneBucket",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ZoneBucket that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ZoneBucket")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/ZoneBucket"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateZoneBucketAPIRequest $request)
    {
        $input = $request->all();

        /** @var ZoneBucket $zoneBucket */
        $zoneBucket = $this->zoneBucketRepository->find($id);

        if (empty($zoneBucket)) {
            return $this->sendError('Zone Bucket not found');
        }

        $zoneBucket = $this->zoneBucketRepository->update($input, $id);

        return $this->sendResponse(new ZoneBucketResource($zoneBucket), 'ZoneBucket updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/zoneBuckets/{id}",
     *      summary="Remove the specified ZoneBucket from storage",
     *      tags={"ZoneBucket"},
     *      description="Delete ZoneBucket",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ZoneBucket",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var ZoneBucket $zoneBucket */
        $zoneBucket = $this->zoneBucketRepository->find($id);

        if (empty($zoneBucket)) {
            return $this->sendError('Zone Bucket not found');
        }

        $zoneBucket->delete();

        return $this->sendSuccess('Zone Bucket deleted successfully');
    }
/**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/current-zone-buckets",
     *      summary="Get a listing of the ZoneBuckets.",
     *      tags={"Mobile-Api"},
     *      security = {{"Bearer": {}}},
     *      description="Get all ZoneBuckets",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/ZoneBucket")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    

    public function currentUserZoneBuckets()
    {
        $buckets= ZoneBucket::where('zone_id',auth()->user()->zone_id)->get();
        return $this->sendResponse($buckets, 'Transactions retrieved successfully');
    }
}
