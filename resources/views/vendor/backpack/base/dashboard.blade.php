@extends(backpack_view('blank'))


@php
$widgets['before_content'][] = [
'type' => 'progress',
'wrapperClass' => 'col-sm-6 col-lg-6',
'class' => 'card text-white bg-danger mb-2',
'value' => $dashboardInfo['current_day_collected'],
'description' => __("dashboard.collected_day"),
'progress' => 57, // integer,
'icon' => 'icon-credit-card',
'progressClass' => 'danger'
];

$widgets['before_content'][] = [
'type' => 'progress',
'wrapperClass' => 'col-sm-6 col-lg-3',
'class' => 'card text-white bg-danger mb-2',
'value' => $dashboardInfo['total_reserved'],
'description' => __("dashboard.totalReserved"),
'progress' => 57, // integer,
'icon' => 'la la-battery-full',
'progressClass' => 'blue-grey'
];

$widgets['before_content'][] = [
'type' => 'progress',
'wrapperClass' => 'col-sm-6 col-lg-3',
'class' => 'card text-white bg-danger mb-2',
'value' => $dashboardInfo['available'],
'description' => __("dashboard.available"),
'progress' => 57, // integer,
'icon' => 'la la-battery-empty',
'progressClass' => 'blue-grey'
];

$widgets['before_content'][] = [
'type' => 'progress',
'wrapperClass' => 'col-sm-6 col-lg-3',
'class' => 'card text-white bg-darck mb-2',
'value' => $dashboardInfo['current_day_checkIn_count'],
'description' => __("dashboard.current_day_checkIn_count"),
'progress' => 57, // integer,
'icon' => 'icon-arrow-down',
'progressClass' => 'info'
];

$widgets['before_content'][] = [
'type' => 'progress',
'wrapperClass' => 'col-sm-6 col-lg-3',
'class' => 'card text-white bg-primary mb-2',
'value' => $dashboardInfo['current_day_checkOut_count'],
'description' => __("dashboard.current_day_checkOut_count"),
'progress' => 57, // integer,
'icon' => 'icon-arrow-up',
'progressClass' => 'warning'
];

$widgets['before_content'][] = [
'type' => 'progress',
'wrapperClass' => 'col-sm-6 col-lg-3',
'class' => 'card text-white bg-danger mb-2',
'value' => $dashboardInfo['reserved_persntage'].'%',
'description' => __("dashboard.reserved_persntage") ,
'progress' => $dashboardInfo['reserved_persntage'], // integer,
'icon' => 'icon-hourglass',
'progressClass' => 'success'
];

$widgets['before_content'][] = [
'type' => 'progress',
'wrapperClass' => 'col-sm-6 col-lg-3',
'class' => 'card text-white bg-danger mb-2',
'value' => $dashboardInfo['capacity'],
'description' => __("dashboard.capacity"),
'progress' => 57, // integer,
'icon' => 'la la-car',
'progressClass' => 'primary'
];

@endphp

@section('content')

<!-- Recent Transactions -->
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{__("dashboard.recent_transactions")}}</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <!-- <li><a class="btn btn-sm btn-danger box-shadow-2 round btn-min-width pull-right" href="invoice-summary.html" target="_blank">Invoice Summary</a></li> -->
                    </ul>
                </div>
            </div>
            <div class="card-content">
                <div class="table-responsive">
                    <table id="recent-orders" class="table table-hover table-xl mb-0">
                        <thead>
                            <tr>
                                <th class="border-top-0">{{__("dashboard.user")}}</th>
                                <th class="border-top-0">{{__("dashboard.plate_number")}}</th>
                                <th class="border-top-0">{{__("dashboard.checkin")}}</th>
                                <th class="border-top-0">{{__("dashboard.checkout")}}</th>
                                <th class="border-top-0">{{__("dashboard.status")}}</th>
                                <th class="border-top-0">{{__("dashboard.reservation")}}</th>
                                <th class="border-top-0">{{__("dashboard.amount")}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                            <tr>
                                <td class="text-truncate">
                                    <span style="font-size: 3px;">{{$transaction->zone}}</span>
                                    <i class="la la-dot-circle-o success font-medium-1 mr-1"></i><span style="font-size: 12px;"> {{$transaction->created_by->name}}</span>
                                </td>
                                <td class="text-truncate"><a href="#">{{$transaction->plate_number}}</a></td>
                                <td>{{$transaction->checkin}}</td>
                                <td>{{$transaction->checkout}}</td>
                                <td>
                                    @if ($transaction->checkout)
                                    <button type="button" class="btn btn-sm btn-outline-success round">{{__("dashboard.checkout")}}</button>
                                    @else
                                    <button type="button" class="btn btn-sm btn-outline-danger round">{{__("dashboard.checkin")}}</button>
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

<!-- Products sell and New Orders -->
<div class="row match-height">
    <div class="col-xl-12 col-12" id="ecommerceChartView">
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
    <!-- <div class="col-12 col-md-4">
            <div class="card">
              <div class="card-content">
                <div class="earning-chart position-relative">
                  <div class="chart-title position-absolute mt-2 ml-2">
                    <h1 class="display-4">$1,596</h1>
                    <span class="text-muted">Total Earning</span>
                  </div>
                  <canvas id="earning-chart" class="height-450"></canvas>
                  <div class="chart-stats position-absolute position-bottom-0 position-right-0 mb-2 mr-3">
                    <a href="#" class="btn round btn-danger mr-1 btn-glow">Statistics <i class="ft-bar-chart"></i></a>
                    <span class="text-muted">for the <a href="#" class="danger darken-2">last year.</a></span>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
</div>
<!--/ Products sell and New Orders -->

@endsection

<script>

</script>