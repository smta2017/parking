@extends('layouts.app')


@section('content')

<div class="add-new-subscriber">
    <div class="container-xxl">
        <div class="row">

            <div class="col-md-8">
                @if($errors)
                <ul style="color: red;">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif

                @if(session('success'))
                <h1 style="color:green ;">{{session('success')}}</h1>
                @endif
                <form action="/admin/subscription" method="POST" class="mt-4">
                    <h6 class="mb-0">أضافه اشتراك جديد</h6>
                    <span style="font-size:12px" class="text-danger">يرجي التركيز و كتابه البيانات بعنايه ودقه عاليه</span>
                    <br />
                    @csrf
                    <input type="hidden" readonly name="customer_id" id="customer_id" value="{{$vehicle->customer->id}}">
                    <div class="row my-4">
                        <div class="col-md-4">
                            <label>أسم المشترك بالكامل <strong class="text-danger">*</strong></label>
                            <input type="text" value="{{$vehicle->customer->name}}" class="form-control" id="name" readonly />
                            <br />
                        </div>
                        <div class="col-md-4">
                            <label>رقم موبايل المشترك <strong class="text-danger">*</strong></label>
                            <input type="number" value="{{$vehicle->customer->phone}}" id="phone" class="form-control" />
                            <br />
                        </div>
                        <div class="col-md-4">
                            <label>رقم موبيل أحتياطي <strong class="text-danger">*</strong></label>
                            <input type="number" value="{{$vehicle->customer->phone2}}" id="phone2" class="form-control" readonly />
                            <br />
                        </div>
                        <div class="col-md-4">
                            <label>عنوان سكن المشترك <strong class="text-danger">*</strong></label>
                            <input type="text" value="{{$vehicle->customer->address}}" id="address" class="form-control" readonly />
                            <br />
                        </div>
                        <div class="col-md-8">
                            <label>العنوان بالتفاصيل <strong class="text-danger">*</strong></label>
                            <input type="text" value="{{$vehicle->customer->address2}}" id="address2" class="form-control" readonly />
                            <br />
                        </div>
                        <hr>
                        <br>
                        <div class="col-md-3">
                            <label>رقم اللوحات المعدنيه <strong class="text-danger">*</strong></label>
                            <select name="vehicle_id" id="vehicles">
                                <option value="{{$vehicle->id}}">{{$vehicle->plate_number}}</option>
                            </select>
                            <br />
                        </div>
                        <div class="col-md-3">
                            <label> نوع الاشتراك<strong class="text-danger">*</strong></label>
                            <select name="plan_id" id="plans">
                                <!-- <option value="-1">اختر الاشتراك</option> -->
                                @foreach ($plans as $plan)
                                <option value="{{$plan->id}}">{{$plan->name .'-'. $plan->price}}</option>
                                @endforeach
                            </select>
                            <br />
                        </div>

                        <div class="col-md-3">
                            <label>اختر الباكية<strong class="text-danger">*</strong></label>
                            <select name="bucket_id" id="plans">
                                <option value="">اختر الباكية</option>

                                @foreach ($zone_buckets as $bucket)
                                    <option value="{{$bucket->id}}">{{$bucket->name}}</option>
                                @endforeach
                            </select>
                            <br />
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-success px-5">حفظ</button>
                            <a href="#" class="btn btn-danger px-5">الغاء</a>
                        </div>
                    </div>
                </form>

                <table id="vhicletbl" class="table table-striped ta-index">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الخطة</th>
                            <th>السعر</th>
                            <th>بداية الاشتراك</th>
                            <th>نهاية الاشتراك</th>
                            <th>الباكية</th>
                            <th>slug</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($subscriptions as $subscription)
                        <tr>
                            <td>{{$subscription->id}}</td>
                            <td>{{$subscription->plan->name}}</td>
                            <td>{{$subscription->plan->price}}</td>
                            <td>{{$subscription->starts_at}}</td>
                            <td>{{$subscription->ends_at}}</td>
                            <td>{{$subscription->SubscriptionBuckets[0]['ZoneBucket']['name']}}</td>
                            <td>{{$subscription->slug}}</td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div><!-- End Col 8 -->

            <div class="col-md-4">
                <img src="/asset/img/Digital-wallet.webp" style="max-width:100%" alt="">
            </div><!-- End Col 4 -->
        </div>
    </div>
</div>


@endsection
@section('after_scripts')
<script>
    console.log('okkk');
    $('#phone').on('change', function(e) {
        $.ajax({
            url: '/admin/get-customer-by-phone',
            type: 'GET',
            data: {
                'phone': $(this).val()
            },
            dataType: 'json',
            success: function(res) {
                if (res.success == true) {
                    $('#customer_id').val(res.data.customer.id);
                    $('#name').val(res.data.customer.name);
                    $('#phone').val(res.data.customer.phone);
                    $('#phone2').val(res.data.customer.phone2);
                    $('#address').val(res.data.customer.address);
                    $('#address2').val(res.data.customer.address2);

                    vehicle = '<option value="">اختر السيارة</option>';
                    $.each(res.data.vehicles, function(k, v) {
                        vehicle += '<option value="' + v.id + '">' + v.plate_number + '</option>';
                    });

                    $('#vehicles').html(vehicle);

                } else {
                    $('#vehicles').html('');
                    alert('لم يستدل على بيانات لهذا الرقم');
                }
                // alert('Data: ' + data);
            },
            error: function(request, error) {
                alert("Request: " + JSON.stringify(request));
            }
        });
    });
</script>
@endsection