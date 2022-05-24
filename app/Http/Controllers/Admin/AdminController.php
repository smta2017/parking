<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;

use App\Http\Controllers\API\TransactionAPIController;
use App\Repositories\TransactionRepository;
use Illuminate\Container\Container;

class AdminController extends Controller
{
    protected $data = []; // the information we send to the view

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(backpack_middleware());
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $this->data['title'] = trans('backpack::base.dashboard'); // set the page title
        $this->data['breadcrumbs'] = [
            trans('backpack::crud.admin')     => backpack_url('dashboard'),
            trans('backpack::base.dashboard') => false,
        ];


        session(['session_zone_id' => 1]);

        $transaction = new TransactionAPIController(new TransactionRepository(new Container()));
        $transactions = json_decode(json_encode($transaction->getLatestTransactions()))->original->data;
        $this->data['transactions'] = $transactions;

    //    return $today_profit= $transaction->getDashboardInfo();
        // $check_in_count=;
        // $check_out_count=;

        // $this->data['today_profit'] = $today_profit;


        // return $today_profit;
        // $this->data['check_in_count'] = $check_in_count;
        // $this->data['check_out_count'] = $check_out_count;
        return view(backpack_view('dashboard'), $this->data);
    }

    /**
     * Redirect to the dashboard.
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function redirect()
    {
        // The '/admin' route is not to be used as a page, because it breaks the menu's active state.
        return redirect(backpack_url('dashboard'));
    }
}
