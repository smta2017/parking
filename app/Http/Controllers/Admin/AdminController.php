<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;

use App\Http\Controllers\API\TransactionAPIController;
use App\Repositories\TransactionRepository;
use Illuminate\Container\Container;
use Illuminate\Http\Request;

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
        $this->dashboardData();
        return view(backpack_view('dashboard'), $this->data);
    }

    public function newDashboard()
    {
        $this->dashboardData();
        return view('pages.newdashboard', $this->data);
    }


    public function dashboardData()
    {
        $this->data['title'] = trans('backpack::base.dashboard'); // set the page title
        $this->data['breadcrumbs'] = [
            trans('backpack::crud.admin')     => backpack_url('dashboard'),
            trans('backpack::base.dashboard') => false,
        ];


        $default_user_zone = auth()->user()->Tenant->TenantZones[0]->ParentZone->Zones[0]->id;
        session(['session_zone_id' => $default_user_zone]);

        $transaction = new TransactionAPIController(new TransactionRepository(new Container()));
        $transactions = json_decode(json_encode($transaction->getLatestTransactions()))->original->data;
        // \dd( $transactions);
        $this->data['transactions'] = $transactions;
        $this->data['dashboardInfo'] = $transaction->getDashboardInfo();
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

    public function changeZone(Request $request)
    {
        session(['session_zone_id' => $request->change_zone_id]);

        return redirect()->back();

        // return  session('session_zone_id');
    }
}
