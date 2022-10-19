<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CheckOutResource;
use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use Carbon\Carbon;

class MoneyController extends Controller
{
    private $data;
    private $transactionRepository;

    public function __construct(TransactionRepository $transactionRepo)
    {
        $this->transactionRepository = $transactionRepo;
    }

    public function index()
    {

        // return \session('session_zone_id');
        $this->data['gests'] = json_decode(json_encode(CheckOutResource::collection($this->transactionRepository->latestTransactions(['type' => Transaction::GENERAL_TRANSACTION, 'created_at' => '2022-10-08']))));
        $this->data['subscribe'] = json_decode(json_encode(CheckOutResource::collection($this->transactionRepository->latestTransactions(['type' => Transaction::SUBSCRIBE_TRANSACTION, 'created_at' => '2022-10-08']))));
        $this->data['over_night'] = json_decode(json_encode(CheckOutResource::collection($this->transactionRepository->latestTransactions(['type' => Transaction::OVERNIGHT_TRANSACTION, 'created_at' => '2022-10-08']))));

        return \view('pages.money', $this->data);
    }
}
