<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCustomerVehicleAPIRequest;
use App\Http\Requests\API\UpdateCustomerVehicleAPIRequest;
use App\Models\CustomerVehicle;
use App\Repositories\CustomerVehicleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\CustomerVehicleResource;
use Response;

/**
 * Class CustomerVehicleController
 * @package App\Http\Controllers\API
 */

class CustomerVehicleAPIController extends AppBaseController
{
    /** @var  CustomerVehicleRepository */
    private $customerVehicleRepository;

    public function __construct(CustomerVehicleRepository $customerVehicleRepo)
    {
        $this->customerVehicleRepository = $customerVehicleRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/customerVehicles",
     *      summary="Get a listing of the CustomerVehicles.",
     *      tags={"CustomerVehicle"},
     *      security = {{"Bearer": {}}},
     *      description="Get all CustomerVehicles",
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
     *                  @SWG\Items(ref="#/definitions/CustomerVehicle")
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
        $customerVehicles = $this->customerVehicleRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(CustomerVehicleResource::collection($customerVehicles), 'Customer Vehicles retrieved successfully');
    }

    /**
     * @param CreateCustomerVehicleAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/customerVehicles",
     *      summary="Store a newly created CustomerVehicle in storage",
     *      tags={"CustomerVehicle"},
     *      security = {{"Bearer": {}}},
     *      description="Store CustomerVehicle",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="CustomerVehicle that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CustomerVehicle")
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
     *                  ref="#/definitions/CustomerVehicle"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCustomerVehicleAPIRequest $request)
    {
        $input = $request->all();

        $customerVehicle = $this->customerVehicleRepository->create($input);

        return $this->sendResponse(new CustomerVehicleResource($customerVehicle), 'Customer Vehicle saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/customerVehicles/{id}",
     *      summary="Display the specified CustomerVehicle",
     *      tags={"CustomerVehicle"},
     *      security = {{"Bearer": {}}},
     *      description="Get CustomerVehicle",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CustomerVehicle",
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
     *                  ref="#/definitions/CustomerVehicle"
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
        /** @var CustomerVehicle $customerVehicle */
        $customerVehicle = $this->customerVehicleRepository->find($id);

        if (empty($customerVehicle)) {
            return $this->sendError('Customer Vehicle not found');
        }

        return $this->sendResponse(new CustomerVehicleResource($customerVehicle), 'Customer Vehicle retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateCustomerVehicleAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/customerVehicles/{id}",
     *      summary="Update the specified CustomerVehicle in storage",
     *      tags={"CustomerVehicle"},
     *      security = {{"Bearer": {}}},
     *      description="Update CustomerVehicle",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CustomerVehicle",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="CustomerVehicle that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CustomerVehicle")
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
     *                  ref="#/definitions/CustomerVehicle"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCustomerVehicleAPIRequest $request)
    {
        $input = $request->all();

        /** @var CustomerVehicle $customerVehicle */
        $customerVehicle = $this->customerVehicleRepository->find($id);

        if (empty($customerVehicle)) {
            return $this->sendError('Customer Vehicle not found');
        }

        $customerVehicle = $this->customerVehicleRepository->update($input, $id);

        return $this->sendResponse(new CustomerVehicleResource($customerVehicle), 'CustomerVehicle updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/customerVehicles/{id}",
     *      summary="Remove the specified CustomerVehicle from storage",
     *      tags={"CustomerVehicle"},
     *      security = {{"Bearer": {}}},
     *      description="Delete CustomerVehicle",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CustomerVehicle",
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
        /** @var CustomerVehicle $customerVehicle */
        $customerVehicle = $this->customerVehicleRepository->find($id);

        if (empty($customerVehicle)) {
            return $this->sendError('Customer Vehicle not found');
        }

        $customerVehicle->delete();

        return $this->sendSuccess('Customer Vehicle deleted successfully');
    }
}
