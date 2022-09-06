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

                <form action="/admin/vehicles" method="POST" enctype="multipart/form-data" class="mt-4">
                    <h6 class="mb-0">أضافه مركبة جديد</h6>
                    <span style="font-size:12px" class="text-danger">يرجي التركيز و كتابه البيانات بعنايه ودقه عاليه</span>
                    <br />
                    @csrf
                    <input type="hidden" name="customer_id" value="{{$customer_id}}">
                    <div class="row my-4">
                        <div class="col-md-3">
                            <label>احرف اللوحات المعدنيه <strong class="text-danger">*</strong></label>
                            <input type="text" name="plate_char" class="form-control" placeholder="حروف" />
                            <br />
                        </div>

                        <div class="col-md-3">
                            <label>رقم اللوحات المعدنيه <strong class="text-danger">*</strong></label>
                            <input type="number" name="plate_number" class="form-control" placeholder="ارقام" />
                            <br />
                        </div>
                        <div class="col-md-3">
                            <label>صوره رخصه المركبه <strong class="text-danger">*</strong></label>
                            <input type="file" name="plate_image" class="form-control" />
                            <br />
                        </div>


                        <!-- <div class="col-md-3">
                            <label>أسم ساحه الأنتظار <strong class="text-danger">*</strong></label>
                            <select class="form-control">
                                <option value="">بنها</option>
                                <option value="">القاهرة</option>
                                <option value="">العبور</option>
                            </select>
                            <br />
                        </div> -->


                        <div class="col-12 text-center">
                            <button class="btn btn-success px-5">حفظ</button>
                            <a href="#" class="btn btn-danger px-5">الغاء</a>
                        </div>
                    </div>

                </form>


                <table id="vhicletbl" class="table table-striped ta-index">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>رقم اللوحات</th>
                            <th>الماركة</th>
                            <th>النوع</th>
                            <th>اشتراك</th>
                            <th>QR</th>
                            <th>تحكم</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($vehicles as $vehicle)
                        <tr>
                            <td>{{$vehicle->id}}</td>
                            <td>{{$vehicle->plate_number}}</td>
                            <td>{{$vehicle->vehicle_brand}}</td>
                            <td>{{$vehicle->vehicle_model}}</td>
                            <td><a href="/admin/subscription/create?vehicle_id={{$vehicle->id}}">اشتراك</a></td>
                            <td><a href="/client-qr/{{$vehicle->id}}" target="_blanck" >QR</a></td>
                            <td>
                                <a href="#">تعديل</a> -
                                <a href="#">حذف</a>
                            </td>
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
    $(document).ready(function() {
        $('#vhicletbl').DataTable({
            "ordering": true,
            "order": [
                [1, "desc"]
            ],
        });
    });
</script>
@endsection