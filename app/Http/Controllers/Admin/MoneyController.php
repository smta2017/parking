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

    public function index(Request $request)
    {

        // return \session('session_zone_id');
        $this->data['gests'] = json_decode(json_encode(CheckOutResource::collection($this->transactionRepository->moneyTransactions($request,1))));
        $this->data['subscribe'] = json_decode(json_encode(CheckOutResource::collection($this->transactionRepository->moneyTransactions($request,2))));
        $this->data['over_night'] = json_decode(json_encode(CheckOutResource::collection($this->transactionRepository->moneyTransactions($request,3))));
        $this->data['sayess_collect'] = $this->transactionRepository->sayesCollect();
        
        // $this->data['sayess_collect'] = ($this->transactionRepository->sayesCollect());

        return \view('pages.money', $this->data);
    }
}
