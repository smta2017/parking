<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>الرئيسية</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-+qdLaIRZfNu4cVPK/PxJJEy0B0f3Ugv8i482AKY7gwXwhaCroABd086ybrVKTa0q" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/asset/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="stylesheet" href="/asset/css/style.css">
</head>

<body>

    <?php

    use App\Http\Controllers\API\TransactionAPIController;
    use App\Models\User;
    use App\Repositories\TransactionRepository;
    use Illuminate\Container\Container;

    $transaction = new TransactionAPIController(new TransactionRepository(new Container()));
    // $transactions = json_decode(json_encode($transaction->getLatestTransactions()))->original->data;
    $dashboardInfo = $transaction->getDashboardInfo();

    $sayes_count = User::whereZoneId(session('session_zone_id'))->count();


    ?>
    <div class="show-img">
        <div class="data text-center">
            <div>
                <i class="fa-solid fa-xmark fa-3x text-light" style="cursor: pointer"></i>
                <br />
                <img src="/asset/img/ph-10.webp" alt="" />
            </div>
        </div>
    </div>

    <aside>
        <div class="over-lay"></div>
        <div class="logo text-center">
            <img src="/asset/img/logo-2.webp" alt="" />
        </div>
        <ul class="list-inline text-center my-3 top-icon">
            <li class="list-inline-item"><a href="/admin"><i class="fa-solid fa-fw fa-house"></i></a></li>
            <li class="list-inline-item"><a href="#"><i class="fa-solid fa-fw fa-bell"></i></a></li>
            <li class="list-inline-item"><a href="#"><i class="fa-solid fa-fw fa-bell"></i></a></li>
        </ul>

        <h6 class="title"><i class="fa-solid fa-fw fa-calculator"></i> الأشتراكات و المشتركين</h6>
        <ul class="list-unstyled my-2 px-2 list">
            <!-- <li class="my-1"><a href="/admin/subscription/create"><i class="fa-solid fa-fw fa-users"></i> اضافة أشتراك</a></li> -->
            <li class="my-1"><a href="/admin/customers/create"><i class="fa-solid fa-fw fa-user"></i>المشتركين</a></li>
            <!-- <li class="my-1"><a href="/admin/vehicles/create"><i class="fa-solid fa-fw fa-car"></i> اضافة سيارة</a></li> -->
            <li class="my-1"><a href="subscribers.html"><i class="fa-solid fa-fw fa-trash-can"></i> حذف مشترك</a></li>
            <li class="my-1"><a href="subscribers.html"><i class="fa-solid fa-fw fa-arrows-rotate"></i> تجديد عضويه</a></li>
            <li class="my-1"><a href="subscribers.html"><i class="fa-solid fa-fw fa-ban"></i> حظر دخول</a></li>
            <li class="my-1"><a href="subscribers.html"><i class="fa-solid fa-fw fa-flag"></i> أعاده تفعيل</a></li>
        </ul>

        <h6 class="title"><i class="fa-solid fa-fw fa-users"></i> الموظفين و العاملين</h6>
        <ul class="list-unstyled my-2 px-2 list">
            <li class="my-1"><a href="/admin/sayess/create"><i class="fa-solid fa-fw fa-user-plus"></i> أنشاء ملف موظف جديد</a></li>
            <li class="my-1"><a data-bs-toggle="modal" data-bs-target="#employee-data" href="#"><i class="fa-solid fa-fw fa-file"></i> ملفات العاملين</a></li>
        </ul>

        <h6 class="title">
            <a href="/admin/money">
                <i class="fa-solid fa-fw fa-hand-holding-dollar"></i> الأرباح و الماليات
            </a>
        </h6>
        <ul class="list-unstyled my-2 px-2 list">
            <li class="my-1"><a href="profit.html"><i class="fa-solid fa-fw fa-cloud-arrow-up"></i> توريد الأرباح</a></li>
            <li class="my-1"><a href="profit2.html"><i class="fa-solid fa-fw fa-money-bill-transfer"></i> توريدات متأخره</a></li>
        </ul>

        <h6 class="title"><i class="fa-solid fa-fw fa-hand-holding-dollar"></i> التقارير و الأحصائيات</h6>
    </aside>
    <!--  -->

    <div class="top-nav">
        <div class="container-xxl">
            <div class="row">

                <div class="col-md-3 col-xl-2">
                    <div class="top-nav-logo py-3">
                        <img src="/asset/img/top-logo.webp" class="float-start me-2" alt="" />
                        <span style="margin-top:12px;display:inline-block;">ديوان عام محافظه القاهره</span><br />
                        <strong>نظام ساحات الأنتظار</strong>
                    </div>
                </div>

                <div class="col-md-3 col-xl-2">
                    <div class="text-center py-3 date-time">
                        <span>
                            <span style="color:#FEBE0A;">التوقيت الأن</span> <br />
                            <span id="clock-wrapper"></span>
                            <?php $tenant_zones = \Auth::guard()->user()->Tenant->TenantZones ?>

                        </span>
                        <span>
                            <span style="color:#FEBE0A;">تاريخ اليوم</span> <br />
                            <span id="date-wrapper"></span>
                        </span>
                    </div>
                </div>

                <div class="col-md-3 col-xl-2 text-center">
                    <div class="box py-3 select">
                        <h6 style="color:#FEBE0A;"> {{session('session_zone_id')}} أختار ساحه الأنتظار</h6>
                        <form method="GET" action="/admin/change-zone">
                            <select class="form-control p-0" name="change_zone_id" onchange='if(this.value != 0) { this.form.submit(); }'>
                                @foreach ($tenant_zones as $tenant_zone)
                                @foreach($tenant_zone->ParentZone->Zones as $zone)
                                <option @if($zone->id == session('session_zone_id')) selected @endif value="{{$zone->id}}"> {{$zone->id}}-{{$zone->name}} </option>
                                @endforeach
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
                <div class="col-md-3 col-xl-2">
                    <span class="back">
                        النظام تحت التجربه و الأختبار
                    </span>
                </div>
                <div class="col-md-4">
                    <div class="box text-end py-3 last-box">
                        <img src="/asset/img/255.webp" alt="" />
                        <a href="{{ backpack_url('logout') }}"><i class="ft-power"></i><span style="color:white"> {{\Auth::guard()->user()->Tenant->id}} - {{\Auth::guard()->user()->Tenant->company_name}} -</span> {{ trans('backpack::base.logout') }}</a>


                        <img src="https://static.wixstatic.com/media/c24732_da6335432f4740f68474c87a3b32d1ff~mv2.png/v1/fill/w_120,h_34,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/Picture1sssss_edited_edited.png" class="mt-2" alt="" />
                    </div>
                </div>

            </div>
        </div><!-- End Container -->
    </div><!-- End top nav -->

    <div class="main-menu py-2">
        <div class="container-xxl">
            <div class="row">
                <div class="col-md-7">

                    <ul class="list-inline mt-1 mb-0">
                        <li class="list-inline-item">
                            <span class="toggle-menu text-light">
                                <i class="fa-solid fa-bars"></i>
                            </span>
                        </li>
                        <li class="list-inline-item">
                            <img src="/asset/img/logo3.webp" alt="" />
                        </li>

                        <li class="list-inline-item">
                            <span>حاله الساحه</span>
                            <span class="text-success mx-2"><strong>مفتوح</strong></span>
                        </li>
                        <li class="list-inline-item">
                            <span class="text-warning mx-2"><strong>{{$dashboardInfo['current_day_checkIn_count']}}</strong></span>

                            <span>دخول</span>
                            <img src="https://static.wixstatic.com/media/c24732_4f40eda3c755417f92e165dcdcf77564~mv2.gif" alt="Green-animated-arrow-right.gif" style="width:9px;height:9px;object-fit:cover;transform:rotate(90deg)" />
                        </li>

                        <li class="list-inline-item">
                            <span class="text-warning mx-2"><strong>{{$dashboardInfo['current_day_checkOut_count']}}</strong></span>

                            <span>خروج</span>
                            <img src="https://static.wixstatic.com/media/c24732_4f40eda3c755417f92e165dcdcf77564~mv2.gif" alt="Green-animated-arrow-right.gif" style="width:9px;height:9px;object-fit:cover;filter:invert(1);transform:rotate(270deg)" />
                            <!-- <span class="text-danger mx-2"><strong>300 <i class="fa-solid fa-angles-up"></i></strong></span> -->
                        </li>

                        <li class="list-inline-item">
                            <span>مشغول</span>
                            <span class="text-warning mx-2"><strong>{{$dashboardInfo['total_reserved']}}</strong></span>
                        </li>
                        <li class="list-inline-item">
                            <span>شاغر</span>
                            <span class="text-info mx-2"><strong>{{$dashboardInfo['available']}}</strong></span>
                        </li>

                        <li class="list-inline-item">
                            <span>نسبه الأشغال</span>
                            <span class="text-danger mx-2"><strong>{{$dashboardInfo['reserved_persntage']}}%</strong></span>
                        </li>
                        <li class="list-inline-item">
                            <span>الساحة</span>
                            <span class="text-danger mx-2"><strong>@if(session('session_zone_id')){{ \App\Models\Zone::find(session('session_zone_id'))['name']}} @endif</strong></span>
                        </li>
                    </ul>
                </div>

                <div class="col-md-5 text-end">
                    <ul class="list-inline mb-0">

                        <li class="list-inline-item">
                            <span>عدد الموظفين</span>
                            <span class="text-warning mx-2"><strong>{{$sayes_count}}</strong></span>
                        </li>

                        <li class="list-inline-item">
                            <span>ربح اليوم</span>
                            <span class="text-success mx-2"><strong>{{$dashboardInfo['current_day_collected']}}</strong></span>
                        </li>
                        <li class="list-inline-item">
                            <span>ربح الشهر</span>
                            <span class="text-success mx-2"><strong>{{$dashboardInfo['current_day_collected']}}</strong></span>
                        </li>

                        <li class="list-inline-item">
                            <a href="#" class="custom-btn"><i class="fa-solid fa-video"></i> كاميرات المراقبه</a>
                        </li>


                    </ul>
                </div>
            </div>
        </div>
    </div><!-- End main-menu -->
    @yield('content')


    <!-- Model employee-data -->
    <div class="modal fade" id="employee-data" style="z-index: 9999999999999;" tabindex="-1" aria-labelledby="employee-dataModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="mb-3">
                        <input type="number" class="form-control text-center rounded-pill" placeholder="أكتب هنا رقم الباكيه" />
                    </div>
                    <div class="mb-2">
                        <img src="/asset/img/mv2.gif" width="480" height="270" alt="">
                        <button class="btn btn-info text-light px-5" style="width: 100%;"><i class="fa-solid fa-camera"></i> التقط الصوره</button>
                    </div>
                    <button class="btn btn-success rounded-pill px-5"><i class="fa-solid fa-print"></i> أطبع التذكره</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Model employee-data -->
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="/asset/js/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="/asset/js/main.js"></script>
    
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    @yield('after_scripts')

</body>

</html>