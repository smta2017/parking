@extends('layouts.app')


@section('content')

<div class="content my-3">
    <div class="container-xxl">

        <div class="row">
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-3">
                        <div style="font-size: 14px;"><strong>العمليات داخل ساحه الأنتظار</strong></div>
                        <span class="text-danger" style="font-size:10px">عمليات الدخول و الخروج لجميع المركبات</span>
                    </div>
                    <!-- <div class="col-md-7">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="ابحث-برقم اللوحات المعدنيه / برقم الفاتوره" />
                            <button class="input-group-text btn btn-info text-light" id="basic-addon1">ابحث</button>
                        </div>
                    </div>
                    <div class="col-md-2 mb-1 text-center">
                        <div class="dropdown">
                            <button style="font-size:13px" class="btn btn-warning dropdown-toggle rounded-pill" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                ترتيب حسب
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="#">اسم الموظف</a></li>
                                <li><a class="dropdown-item" href="#">نوع العملية</a></li>
                                <li><a class="dropdown-item" href="#">حالة المركبة</a></li>
                            </ul>
                        </div>
                    </div> -->

                </div>
            </div>
        </div><!-- End Row -->


        <div class="row">
            <div class="col-lg-7" style="overflow: auto;">
                <table id="maintbl" class="table table-striped ta-index">
                    <thead>

                        <tr>
                            <th>رقم الفاتوره</th>
                            <th>أسم الموظف</th>
                            <th>اللوحات المعدنيه</th>
                            <th>رقم اللوحات</th>
                            <th>دخول</th>
                            <th>خروج</th>
                            <th>الحاله</th>
                            <th>الباكيه</th>
                            <th>مده الأنتظار</th>
                            <th>التكلفه</th>
                        </tr>
                    </thead>
                    @foreach ($transactions as $transaction)

                    <tr>
                        <td> {{ \session('session_zone_id') }} - {{$transaction->id}}</td>
                        <td>{{$transaction->created_by->name}}</td>
                        <td><img src="{{$transaction->plate_img}}" width="40" height="20" alt=""></td>
                        <td><strong class="text-primary">{{$transaction->plate_number}}</strong></td>
                        <td><strong class="text-success">{{$transaction->checkin}}</strong></td>
                        <td><strong class="text-danger">{{$transaction->checkout}}</strong></td>
                        <td><strong class="text-info">
                                @if ($transaction->checkout==null)
                                <img src="https://static.wixstatic.com/media/c24732_4f40eda3c755417f92e165dcdcf77564~mv2.gif" alt="Green-animated-arrow-right.gif" style="width:9px;height:9px;object-fit:cover;transform:rotate(90deg)" />
                                قيد الانتظار
                                @else
                                <img src="https://static.wixstatic.com/media/c24732_4f40eda3c755417f92e165dcdcf77564~mv2.gif" alt="Green-animated-arrow-right.gif" style="width:9px;height:9px;object-fit:cover;filter:invert(1);transform:rotate(270deg)" />
                                خرج
                                @endif
                            </strong></td>
                        <td>17</td>
                        <td><strong class="text-danger">{{$transaction->total_time->days . ' | '. $transaction->total_time->hours}}</strong></td>
                        <td><strong class="text-info">
                                @if ($transaction->type==1)
                                {{$transaction->amount}}
                                @elseif ($transaction->type==2)
                                اشتراك
                                @elseif ($transaction->type==3)
                                {{$transaction->amount}}
                                <br>
                                مبيت
                                @endif
                            </strong></td>
                    </tr>
                    @endforeach



                </table>

                <!-- <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav> -->
            </div>

            <div class="col-lg-5">
                <div class="row">
                    <div class="col-md-6 col-xl-4">
                        <div class="box-index bg-warning p-1 rounded-3 mb-5">
                            <div class="title text-center">المركبات المنتظره</div>
                            <div class="data-number">
                                505
                                <i class="fa-solid fa-fw fa-car"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <div class="box-index bg-success p-1 rounded-3 text-light mb-5">
                            <div class="title text-center">دخول المركبات</div>
                            <div class="data-number">
                                {{$dashboardInfo['current_day_checkIn_count']}}
                                <i class="fa-solid fa-fw fa-circle-down"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <div class="box-index bg-danger p-1 rounded-3 text-light mb-5">
                            <div class="title text-center">خروج المركبات</div>
                            <div class="data-number">
                                {{$dashboardInfo['current_day_checkOut_count']}}
                                <i class="fa-solid fa-fw fa-circle-up"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <div class="box-index bg-info p-1 rounded-3 text-light mb-5">
                            <div class="title text-center">ربح اليوم</div>
                            <div class="data-number">
                                {{$dashboardInfo['current_day_collected']}}
                                <i class="fa-solid fa-fw fa-dollar-sign"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <div class="box-index bg-primary p-1 rounded-3 text-light mb-5">
                            <div class="title text-center">عدد الزائرين</div>
                            <div class="data-number">
                                505
                                <i class="fa-solid fa-fw fa-users"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <div class="box-index bg-secondary p-1 rounded-3 text-light mb-5">
                            <div class="title text-center">عدد المشتركين</div>
                            <div class="data-number">
                                505
                                <i class="fa-solid fa-fw fa-hand-holding-dollar"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <div class="box-index bg-danger p-1 rounded-3 text-light mb-5">
                            <div class="title text-center">أشتراكات منتهيه</div>
                            <div class="data-number">
                                505
                                <i class="fa-solid fa-fw fa-circle-dollar-to-slot"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <div class="box-index bg-dark p-1 rounded-3 text-light mb-5">
                            <div class="title text-center">المبيت</div>
                            <div class="data-number">
                                {{$dashboardInfo['current_day_overnight']}}
                                <i class="fa-solid fa-fw fa-ban"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4">
                        <div class="box-index bg-primary p-1 rounded-3 text-light mb-5">
                            <div class="title text-center">اشتراكات </div>
                            <div class="data-number">
                                {{$dashboardInfo['current_day_subscribe']}}
                                <i class="fa-solid fa-fw fa-calendar-check"></i>
                            </div>
                        </div>
                    </div>

                </div><!-- End Row -->
            </div>
        </div><!-- End Row -->


        <div class="row" style="margin-top: 50px;">
            <div class="col-lg-7" style="overflow: auto;">
                <div><strong>عمليات موظفين ساحه الأنتظار</strong></div>
                <span class="text-danger" style="font-size:11px">جميع عمليات الموظفين العاملين الأن</span>
                <table id="sayesstbl" class="table table-striped ta-index">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>أسم الموظف</th>
                            <th>رقم الموبيل</th>
                            <th style="max-width: 100px;">email </th>
                            <th>رقم الرخصه</th>
                            <th>ساحه الأنتظار</th>
                            <th>الحاله</th>
                            <th>حضور</th>
                            <th>حاله الماكينه</th>
                            <th>المبالغ المحصله</th>
                        </tr>
                    </thead>


                    @foreach ($sayes as $saye)

                    <tr>
                        <td>
                            <img src="https://static.wixstatic.com/media/c24732_22df1e21acfd4661af5a6479422b50e5~mv2.gif" style="width:28px;height:28px;object-fit:cover" />
                            <img src="/asset/img/face.webp" width="30" height="30" alt="">
                        </td>
                        <td>{{$saye->name}}</td>
                        <td><strong class="text-primary">{{$saye->phone}}</strong></td>
                        <td><strong class="text-primary">{{$saye->email}}</strong></td>
                        <td><strong class="text-primary">00</strong></td>
                        <td><strong class="text-primary">{{$saye->Zone->name}}</strong></td>
                        <td><strong class="text-primary">في الخدمه</strong></td>
                        <td><strong class="text-success">11 : 25 AM</strong></td>
                        <td><strong class="text-primary">متصل</strong></td>
                        <td><strong class="text-primary">10 جنيهات</strong></td>
                    </tr>
                    @endforeach

                </table>

                <!-- <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav> -->
            </div>

            <div class="col-lg-5">
                <div class="in-map">
                    <div><strong>خريطه عمليات ساحه الأنتظار</strong></div>
                    <p class="text-danger" style="font-size: 11px;">عمليات ساحات الأنتظار الفرعيه</p>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d55027.07928071342!2d31.153401963256975!3d30.45898651056513!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145875f6592ee989%3A0xa0f7a3872335c0ce!2sBanha%2C%20Qism%20Banha%2C%20Banha%2C%20Al%20Qalyubia%20Governorate!5e0!3m2!1sen!2seg!4v1659446164105!5m2!1sen!2seg" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div><!-- End Row -->


    </div>
</div>

@endsection

@section('after_scripts')

<script>
    $(document).ready(function() {
        $('#maintbl').DataTable({
            "ordering": true,
            "order": [
                [1, "desc"]
            ],
        });
        $('#sayesstbl').DataTable({
            "ordering": true,
            "order": [
                [1, "desc"]
            ],
        });
    });

    setInterval(function() {
        var date = new Date();

        var dd = String(date.getDate()).padStart(2, '0');
        var mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = date.getFullYear();
        var ampm = date.getHours() >= 12 ? 'pm' : 'am';
        today = yyyy + '/' + mm + '/' + dd;
        var hour = (date.getHours() % 12) || 12
        $('#clock-wrapper').html(
            hour + ":" + date.getMinutes() + ' - ' + ampm
        );
        $('#date-wrapper').html(
            today
        );
    }, 500);
</script>

@endsection