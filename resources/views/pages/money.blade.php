@extends('layouts.app')


@section('content')
@if($errors)

<div class="money my-5">
    <div class="container-xxl">
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif

        @if(session('success'))
        <h1 style="color:green ;">{{session('success')}}</h1>
        @endif


        <div class="row">
            <div class="col-lg-2 col-md-3 mb-3">
                <p class="mb-0"><strong>الأرباح الماليه للشركه</strong></p>
                <span class="text-danger" style="font-size:11px">جميع العمليات و الأرباح الماليه</span>
            </div>

            <div class="col-lg-4 col-md-6 mb-3">
                <div class="input-group">
                    <input type="text" class="form-control form-control-sm rounded-pill" style="font-size:10px" placeholder="ابحث برقم اللوحات المعدنيه / برقم الفاتوره">
                    <button class="input-group-text rounded-pill btn btn-info text-light" id="basic-addon1">ابحث</button>
                </div>
            </div>


            <div class="col-lg-6">
                <ul class="list-inline">
                    <li class="list-inline-item mb-2">
                        <select class="form-select rounded-pill border border-warning px-5">
                            <option value="">اليوم</option>
                            <option value="">1</option>
                            <option value="">2</option>
                            <option value="">3</option>
                        </select>
                    </li>

                    <li class="list-inline-item mb-2">
                        <select class="form-select rounded-pill border border-info px-5">
                            <option value="">يناير</option>
                            <option value="">فبراير</option>
                        </select>
                    </li>

                    <li class="list-inline-item mb-2">
                        <select class="form-select rounded-pill border border-success px-5">
                            <option value="">السنه</option>
                            <option value="">2022</option>
                        </select>
                    </li>

                    <li class="list-inline-item mb-2">
                        <button class="btn btn-info text-light rounded-pill px-5">ابحث</button>
                    </li>

                </ul>
            </div>


        </div>


        <div class="row">
            <div class="col-lg-6" style="overflow: auto;">
                <div class="text-center">
                    <span class="ta-title bg-danger text-light px-5">تفاصيل أرباح الزائرين</span>
                </div>
                <table class="table table-striped ta-index" style="margin-bottom:9px">
                    <thead>
                        <tr class="bg-custom">
                            <th>التاريخ</th>
                            <th>اللوحات المعدنيه</th>
                            <th>رقم اللوحات</th>
                            <th>دخول</th>
                            <th>خروج</th>
                            <th>مده الأنتظار</th>
                            <th>التكلفه</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gests as $transaction)
                        <tr>
                            <td> {{$transaction->checkin}}</td>
                            <td><img src="{{$transaction->plate_img}}" width="40" height="20" alt=""></td>
                            <td><strong class="text-primary">{{$transaction->plate_number}}</strong></td>
                            <td><strong class="text-success">{{$transaction->checkin}}</strong></td>
                            <td><strong class="text-danger">{{$transaction->checkout}}</strong></td>
                            <td><strong class="text-danger">{{$transaction->total_time->days . ' | '. $transaction->total_time->hours}}</strong></td>
                            <td><strong class="text-info">{{$transaction->amount}}</strong></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                

                <ul class="list-inline" style="display:flex;justify-content: space-between;">
                    <li class="list-inline-item mb-3">
                        <span class="bg-warning px-1 py-2">
                            أجمالي المركبات
                            <span style="display:inline-block;font-weight:900;" class="mx-3">{{count($gests)}}</span>
                        </span>
                    </li>
                    <li class="list-inline-item mb-3">
                        <span class="bg-danger text-light px-1 py-2">
                            أجمالي ساعات الأنتظار
                            <br>
                            <span style="display:inline-block;font-weight:900;" class="mx-3">{{(collect($gests)->sum('total_time.days')/24)}} </span>
                        </span>
                    </li>
                    <li class="list-inline-item mb-3">
                        <span class="bg-success text-light px-1 py-2">
                            أجمالي الأرباح الماليه
                            <span style="display:inline-block;font-weight:900;" class="mx-3">{{collect($gests)->sum('amount')}}</span>
                        </span>
                    </li>
                </ul>
            </div>
            <br />

            <div class="col-lg-6">
                <div class="text-center" style="overflow: auto;">
                    <span class="ta-title bg-primary text-light px-5">تفاصيل أرباح المشتركين</span>
                </div>
                <table class="table table-striped ta-index" style="margin-bottom:9px">
                    <thead>
                        <tr class="bg-custom">
                            <th>التاريخ</th>
                            <th>اللوحات المعدنيه</th>
                            <th>رقم اللوحات</th>
                            <th>دخول</th>
                            <th>خروج</th>
                            <th>مده الأنتظار</th>
                            <th>التكلفه</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subscribe as $transaction)
                        <tr>
                            <td> {{$transaction->checkin}}</td>
                            <td><img src="{{$transaction->plate_img}}" width="40" height="20" alt=""></td>
                            <td><strong class="text-primary">{{$transaction->plate_number}}</strong></td>
                            <td><strong class="text-success">{{$transaction->checkin}}</strong></td>
                            <td><strong class="text-danger">{{$transaction->checkout}}</strong></td>
                            <td><strong class="text-danger">{{$transaction->total_time->days . ' | '. $transaction->total_time->hours}}</strong></td>
                            <td><strong class="text-info">{{$transaction->amount}}</strong></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                

               
                <ul class="list-inline" style="display:flex;justify-content: space-between;">
                    <li class="list-inline-item mb-3">
                        <span class="bg-warning px-1 py-2">
                            أجمالي المركبات
                            <span style="display:inline-block;font-weight:900;" class="mx-3">{{count($subscribe)}}</span>
                        </span>
                    </li>
                    <li class="list-inline-item mb-3">
                        <span class="bg-danger text-light px-1 py-2">
                            أجمالي ساعات الأنتظار
                            <br>
                            <span style="display:inline-block;font-weight:900;" class="mx-3">{{(collect($subscribe)->sum('total_time.days')/24)}} </span>
                        </span>
                    </li>
                    <li class="list-inline-item mb-3">
                        <span class="bg-success text-light px-1 py-2">
                            أجمالي الأرباح الماليه
                            <span style="display:inline-block;font-weight:900;" class="mx-3">{{collect($subscribe)->sum('amount')}}</span>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        <br />


        <div class="row">
            <div class="col-lg-6" style="overflow: auto;">
                <div class="text-center">
                    <span class="ta-title bg-warning text-light px-5">تفاصيل أرباح المبيت اليومي</span>
                </div>
                <table class="table table-striped ta-index" style="margin-bottom:9px">
                    <thead>
                        <tr class="bg-custom">
                            <th>التاريخ</th>
                            <th>اللوحات المعدنيه</th>
                            <th>رقم اللوحات</th>
                            <th>دخول</th>
                            <th>خروج</th>
                            <th>مده الأنتظار</th>
                            <th>التكلفه</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($over_night as $transaction)
                        <tr>
                            <td> {{$transaction->checkin}}</td>
                            <td><img src="{{$transaction->plate_img}}" width="40" height="20" alt=""></td>
                            <td><strong class="text-primary">{{$transaction->plate_number}}</strong></td>
                            <td><strong class="text-success">{{$transaction->checkin}}</strong></td>
                            <td><strong class="text-danger">{{$transaction->checkout}}</strong></td>
                            <td><strong class="text-danger">{{$transaction->total_time->days . ' | '. $transaction->total_time->hours}}</strong></td>
                            <td><strong class="text-info">{{$transaction->amount}}</strong></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                

                <ul class="list-inline" style="display:flex;justify-content: space-between;">
                    <li class="list-inline-item mb-3">
                        <span class="bg-warning px-1 py-2">
                            أجمالي المركبات
                            <span style="display:inline-block;font-weight:900;" class="mx-3">{{count($over_night)}}</span>
                        </span>
                    </li>
                    <li class="list-inline-item mb-3">
                        <span class="bg-danger text-light px-1 py-2">
                            أجمالي ساعات الأنتظار
                            <br>
                            <span style="display:inline-block;font-weight:900;" class="mx-3">{{(collect($over_night)->sum('total_time.days')/24)}} </span>
                        </span>
                    </li>
                    <li class="list-inline-item mb-3">
                        <span class="bg-success text-light px-1 py-2">
                            أجمالي الأرباح الماليه
                            <span style="display:inline-block;font-weight:900;" class="mx-3">{{collect($over_night)->sum('amount')}}</span>
                        </span>
                    </li>
                </ul>
            </div>
            <br />

           
        </div>
        <br />
    </div><!-- end container xxl -->
</div>

@endsection

@section('after_scripts')

<script>
    $(document).ready(function() {
        $('#customertbl').DataTable({
            "ordering": true,
            "order": [
                [1, "desc"]
            ],
        });
    });
</script>
@endsection