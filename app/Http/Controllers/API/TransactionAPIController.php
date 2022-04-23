<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTransactionAPIRequest;
use App\Http\Requests\API\UpdateTransactionAPIRequest;
use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\CheckInResource;
use App\Http\Resources\CheckOutResource;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\TransactionsChartResource;
use Response;

/**
 * Class TransactionController
 * @package App\Http\Controllers\API
 */

class TransactionAPIController extends AppBaseController
{
    /** @var  TransactionRepository */
    private $transactionRepository;

    public function __construct(TransactionRepository $transactionRepo)
    {
        $this->transactionRepository = $transactionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/transactions",
     *      summary="Get a listing of the Transactions.",
     *      tags={"Transaction"},
     *      security = {{"Bearer": {}}},
     *      description="Get all Transactions",
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
     *                  @SWG\Items(ref="#/definitions/Transaction")
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
        $transactions = $this->transactionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(TransactionResource::collection($transactions), 'Transactions retrieved successfully');
    }

    /**
     * @param CreateTransactionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/transactions",
     *      summary="Store a newly created Transaction in storage",
     *      tags={"Transaction"},
     *      description="Store Transaction",
     *      security = {{"Bearer": {}}},
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Transaction that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Transaction")
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
     *                  ref="#/definitions/Transaction"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTransactionAPIRequest $request)
    {
        $input = $request->all();

        $transaction = $this->transactionRepository->create($input);

        return $this->sendResponse(new TransactionResource($transaction), 'Transaction saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/transactions/{id}",
     *      summary="Display the specified Transaction",
     *      tags={"Transaction"},
     *      security = {{"Bearer": {}}},
     *      description="Get Transaction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Transaction",
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
     *                  ref="#/definitions/Transaction"
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
        /** @var Transaction $transaction */
        $transaction = $this->transactionRepository->find($id);

        if (empty($transaction)) {
            return $this->sendError('Transaction not found');
        }

        return $this->sendResponse(new TransactionResource($transaction), 'Transaction retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTransactionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/transactions/{id}",
     *      summary="Update the specified Transaction in storage",
     *      tags={"Transaction"},
     *      description="Update Transaction",
     *      security = {{"Bearer": {}}},
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Transaction",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Transaction that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Transaction")
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
     *                  ref="#/definitions/Transaction"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTransactionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Transaction $transaction */
        $transaction = $this->transactionRepository->find($id);

        if (empty($transaction)) {
            return $this->sendError('Transaction not found');
        }

        $transaction = $this->transactionRepository->update($input, $id);

        return $this->sendResponse(new TransactionResource($transaction), 'Transaction updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/transactions/{id}",
     *      summary="Remove the specified Transaction from storage",
     *      tags={"Transaction"},
     *      description="Delete Transaction",
     *      security = {{"Bearer": {}}},
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Transaction",
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
        /** @var Transaction $transaction */
        $transaction = $this->transactionRepository->find($id);

        if (empty($transaction)) {
            return $this->sendError('Transaction not found');
        }

        $transaction->delete();

        return $this->sendSuccess('Transaction deleted successfully');
    }


    /**
     * @param CreateTransactionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/transactions/checkin",
     *      summary="Store a newly created Transaction in storage",
     *      tags={"Mobile-Api"},
     *      description="Store Transaction",
     *      security = {{"Bearer": {}}},
     *      produces={"application/json"},
     *     
     *      @SWG\Parameter(
     *          name="plate_img",
     *          description="plate photo",
     *          type="file",
     *          required=true,
     *          in="formData"
     *      ),
     *      @SWG\Parameter(
     *             name="plate_number",
     *             description="plate_number",
     *             default="sameh",           
     *             type="string",
     *             required=true,
     *             in="query"
     *      ),
     *         @SWG\Parameter(
     *             name="driver_name",
     *             description="driver_name",
     *             default="sameh",           
     *             type="string",
     *             required=false,
     *             in="query"
     *      ),
     *         @SWG\Parameter(
     *             name="mobile",
     *             description="mobile",
     *             default="+20125655445",           
     *             type="string",
     *             required=false,
     *             in="query"
     *      ),
     * 
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
     *                  ref="#/definitions/CheckIn"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function checkIn(CreateTransactionAPIRequest $request)
    {
        $transaction = $this->transactionRepository->setCheckIn($request);
        return $this->sendResponse(new CheckInResource($transaction), 'CheckIn saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Post(
     *      path="/transactions/checkout/{qr_code}",
     *      summary="Set checkout for Transaction",
     *      tags={"Mobile-Api"},
     *      security = {{"Bearer": {}}},
     *      description="Get Transaction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="qr_code",
     *          description="qr code of Transaction",
     *          type="string",
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
     *                  ref="#/definitions/CheckOut"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function checkOut($qr_code)
    {
        $transaction = $this->transactionRepository->setCheckOut($qr_code);

        return $this->sendResponse(new CheckOutResource($transaction), 'CheckOut saved successfully');
    }

    public function getTransactionCart()
    {
        $transaction = $this->transactionRepository->getTransactionCart();

        return $this->sendResponse(TransactionsChartResource::collection($transaction), 'Successfully');
    }

    public  function getLatestTransactions()
    {

        // $zone_id = \Auth::guard('backpack')->user()->zone_id;
        $zone_id = session('session_zone_id');

        // return \phpinfo();
        $transaction = $this->transactionRepository->latestTransactions();

        // return $transaction;
        return $this->sendResponse(CheckOutResource::collection($transaction), 'Successfully');
    }
}
