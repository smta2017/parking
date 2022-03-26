@extends(backpack_view('blank'))

@php
$widgets['before_content'][] = [
'type' => 'progress',
'class' => 'card text-white bg-danger mb-2',
'value' => \App\Models\Transaction::whereDate('created_at',date('Y/m/d'))->count(),
'description' => 'Today Orders.',
'progress' => 57, // integer,
'icon' => 'icon-list',
'progressClass' => 'info'
];
$widgets['before_content'][] = [
'type' => 'progress',
'class' => 'card text-white bg-primary mb-2',
'value' =>  \App\Models\Transaction::whereNull('out_at')->count(),
'description' => 'Busy.',
'progress' => 57, // integer,
'icon' => 'icon-hourglass',
'progressClass' => 'warning'
];
$widgets['before_content'][] = [
    'type' => 'progress',
'class' => 'card text-white bg-danger mb-2',
'value' => \App\Models\Transaction::whereNotNull('out_at')->whereDate('created_at',date('Y/m/d'))->count(),
'description' => 'Check Out.',
'progress' => 57, // integer,
'icon' => 'icon-arrow-up',
'progressClass' => 'success'
];
$widgets['before_content'][] = [
'type' => 'progress',
'class' => 'card text-white bg-danger mb-2',
'value' => '1290',
'description' => 'Earns.',
'progress' => 57, // integer,
'icon' => 'icon-credit-card',
'progressClass' => 'danger'
];

@endphp

@section('content')
<!-- Products sell and New Orders -->
<div class="row match-height">
    <div class="col-xl-8 col-12" id="ecommerceChartView">
        <div class="card card-shadow">
            <div class="card-header card-header-transparent py-20">

                <ul class="nav nav-pills nav-pills-rounded chart-action float-right btn-group" role="group">
                    <li class="nav-item"><a class="active nav-link" data-toggle="tab" href="#scoreLineToDay">Day</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#scoreLineToWeek">Week</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#scoreLineToMonth">Month</a></li>
                </ul>
            </div>
            <div class="widget-content tab-content bg-white p-20">
                <div class="ct-chart tab-pane active scoreLineShadow" id="scoreLineToDay"></div>
                <div class="ct-chart tab-pane scoreLineShadow" id="scoreLineToWeek"></div>
                <div class="ct-chart tab-pane scoreLineShadow" id="scoreLineToMonth"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">New Orders</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content">
                <div id="new-orders" class="media-list position-relative">
                    <div class="table-responsive">
                        <table id="new-orders-table" class="table table-hover table-xl mb-0">
                            <thead>
                                <tr>
                                    <th class="border-top-0">Product</th>
                                    <th class="border-top-0">Customers</th>
                                    <th class="border-top-0">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-truncate">Galaxy</td>
                                    <td class="text-truncate p-1">
                                        <ul class="list-unstyled users-list m-0">
                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Ryan Schneider" class="avatar avatar-sm pull-up">
                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-14.png" alt="Avatar">
                                            </li>
                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Tiffany Oliver" class="avatar avatar-sm pull-up">
                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-13.png" alt="Avatar">
                                            </li>
                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Joan Reid" class="avatar avatar-sm pull-up">
                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-12.png" alt="Avatar">
                                            </li>
                                        </ul>
                                    </td>
                                    <td class="text-truncate">$7500</td>
                                </tr>
                                <tr>
                                    <td class="text-truncate">Moto Z2</td>
                                    <td class="text-truncate p-1">
                                        <ul class="list-unstyled users-list m-0">
                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Kimberly Simmons" class="avatar avatar-sm pull-up">
                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-8.png" alt="Avatar">
                                            </li>
                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Willie Torres" class="avatar avatar-sm pull-up">
                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-7.png" alt="Avatar">
                                            </li>
                                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Rebecca Jones" class="avatar avatar-sm pull-up">
                                                <img class="media-object rounded-circle" src="../../../app-assets/images/portrait/small/avatar-s-6.png" alt="Avatar">
                                            </li>
                                            <li class="avatar avatar-sm">
                                                <span class="badge badge-info">+1 more</span>
                                            </li>
                                        </ul>
                                    </td>
                                    <td class="text-truncate">$8500</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Products sell and New Orders -->


<?php

use App\Http\Controllers\API\TransactionAPIController;
use App\Repositories\TransactionRepository;
use Illuminate\Container\Container;

$transaction = new TransactionAPIController(new TransactionRepository(new Container()));
$transactions = json_decode(json_encode($transaction->getLatestTransactions()))->original->data;

// dd( $transactions);

?>

<!-- Recent Transactions -->
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Recent Transactions</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a class="btn btn-sm btn-danger box-shadow-2 round btn-min-width pull-right" href="invoice-summary.html" target="_blank">Invoice Summary</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content">
                <div class="table-responsive">
                    <table id="recent-orders" class="table table-hover table-xl mb-0">
                        <thead>
                            <tr>
                                <th class="border-top-0">User</th>
                                <th class="border-top-0">Plate #</th>
                                <th class="border-top-0">Customer</th>
                                <th class="border-top-0">Phone</th>
                                <th class="border-top-0">Status</th>
                                <th class="border-top-0">Reservation</th>
                                <th class="border-top-0">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                            <tr>
                                <td class="text-truncate"><i class="la la-dot-circle-o success font-medium-1 mr-1"></i><span style="font-size: 12px;"> {{$transaction->created_by->name}}</span></td>
                                <td class="text-truncate"><a href="#">{{$transaction->plate_number}}</a></td>
                                <td class="text-truncate">
                                    <!-- <span class="avatar avatar-xs">
                                            <img class="box-shadow-2" src="../../../app-assets/images/portrait/small/avatar-s-4.png" alt="avatar">
                                        </span> -->
                                    <span>{{$transaction->driver_name}}.</span>
                                </td>
                                <td class="text-truncate p-1">
                                    <span>{{$transaction->mobile}}.</span>

                                </td>
                                <td>
                                    @if ($transaction->checkout)
                                    <button type="button" class="btn btn-sm btn-outline-success round">Checked Out</button>
                                    @else
                                    <button type="button" class="btn btn-sm btn-outline-danger round">Checked In</button>
                                    @endif
                                </td>
                                <td>
                                    @if (!$transaction->checkout)
                                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                            <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: {{explode(':',$transaction->total_time->hours)[0]}}%" aria-valuenow="2" aria-valuemin="0" aria-valuemax="25"></div>
                                        </div>
                                        <span style="font-size: 11px;">{{$transaction->checkin_hu}}</span>
                                    @else
                                    <span class="badge badge badge-success">{{$transaction->total_time->hours}}</span>
                                    @endif
                                </td>

                                <td class="text-truncate">
                                @if (!$transaction->checkout)
                                      <i class="la la-clock"></i>
                                    @else
                                        <span>{{round($transaction->amount, 2)}}</span>
                                    @endif
                                    
                                 
                                
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Recent Transactions -->

@endsection

<script>

</script>