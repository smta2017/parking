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
                <form action="/admin/subscriptions" method="POST" class="mt-4">
                    <h6 class="mb-0">أضافه اشتراك جديد</h6>
                    <span style="font-size:12px" class="text-danger">يرجي التركيز و كتابه البيانات بعنايه ودقه عاليه</span>
                    <br />
                    <a href="/admin/customers/create" class="btn btn-warning px-5">اضف مشترك جديد + </a>
                    @csrf
                    <input type="hidden" readonly name="customer_id" id="customer_id" value="{{(session()->has('subscriper_customer'))?session('subscriper_customer')['id']:''}}">
                    <div class="row my-4">
                        <div class="col-md-4">
                            <label>أسم المشترك بالكامل <strong class="text-danger">*</strong></label>
                            <input type="text" value="{{(session()->has('subscriper_customer'))?session('subscriper_customer')['name']:''}}" class="form-control" id="name" readonly />
                            <br />
                        </div>
                        <div class="col-md-4">
                            <label>رقم موبايل المشترك <strong class="text-danger">*</strong></label>
                            <input type="number" value="{{(session()->has('subscriper_customer'))?session('subscriper_customer')['phone']:''}}" id="phone" class="form-control" />
                            <br />
                        </div>
                        <div class="col-md-4">
                            <label>رقم موبيل أحتياطي <strong class="text-danger">*</strong></label>
                            <input type="number" value="{{(session()->has('subscriper_customer'))?session('subscriper_customer')['phone2']:''}}" id="phone2" class="form-control" readonly />
                            <br />
                        </div>
                        <div class="col-md-4">
                            <label>عنوان سكن المشترك <strong class="text-danger">*</strong></label>
                            <input type="text" value="{{(session()->has('subscriper_customer'))?session('subscriper_customer')['address']:''}}" id="address" class="form-control" readonly />
                            <br />
                        </div>
                        <div class="col-md-8">
                            <label>العنوان بالتفاصيل <strong class="text-danger">*</strong></label>
                            <input type="text" value="{{(session()->has('subscriper_customer'))?session('subscriper_customer')['address2']:''}}" id="address2" class="form-control" readonly />
                            <br />
                        </div>

                        <hr>
                        <br>
                        <br>


                        <a href="/admin/vehicles/create" class="btn btn-warning px-5">اضف بيانات سيارة جديدة + </a>


                        <div class="col-md-3">
                            <label>رقم اللوحات المعدنيه <strong class="text-danger">*</strong></label>

                            <select name="vehicle_id" id="vehicles">

                            </select>

                            <br />
                        </div>
                        <div class="col-md-3">
                            <label> نوع الاشتراك<strong class="text-danger">*</strong></label>

                            <select name="plan_id" id="plans">
                                <!-- <option value="-1">اختر الاشتراك</option> -->
                                @foreach (\Rinvex\Subscriptions\Models\Plan::get() as $plan)
                                <option value="{{$plan->id}}">{{$plan->name .'-'. $plan->price}}</option>
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