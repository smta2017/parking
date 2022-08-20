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


                <form action="/admin/customers" method="POST" class="mt-4">
                    <h6 class="mb-0">أضافه مشترك جديد</h6>
                    <span style="font-size:12px" class="text-danger">يرجي التركيز و كتابه البيانات بعنايه ودقه عاليه</span>
                    <br />
                    @csrf
                    <div class="row my-4">
                        <div class="col-md-4">
                            <label>أسم المشترك بالكامل <strong class="text-danger">*</strong></label>
                            <input type="text" name="name" class="form-control" />
                            <br />
                        </div>
                        <div class="col-md-4">
                            <label>رقم موبايل المشترك <strong class="text-danger">*</strong></label>
                            <input type="number" name="phone" class="form-control" />
                            <br />
                        </div>
                        <div class="col-md-4">
                            <label>رقم موبيل أحتياطي <strong class="text-danger">*</strong></label>
                            <input type="number" name="phone2" class="form-control" />
                            <br />
                        </div>
                        <div class="col-md-4">
                            <label>عنوان سكن المشترك <strong class="text-danger">*</strong></label>
                            <input type="text" name="address" class="form-control" />
                            <br />
                        </div>
                        <div class="col-md-8">
                            <label>العنوان بالتفاصيل <strong class="text-danger">*</strong></label>
                            <input type="text" name="address2" class="form-control" />
                            <br />
                        </div>


                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-success px-5">حفظ</button>
                            <a href="#" class="btn btn-danger px-5">الغاء</a>
                        </div>
                    </div>

                </form>

                <hr>

                <table id="customertbl" class="table table-striped ta-index">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>أسم العميل</th>
                            <th>تليفون</th>
                            <th>الايميل</th>
                            <th>تحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                        <tr>
                            <td>{{$customer->id}}</td>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->phone}}</td>
                            <td>{{$customer->email}}</td>
                            <td><a href="/admin/vehicles/create?customer_id={{$customer->id}}">المركبات</a></td>
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
        $('#customertbl').DataTable({
            "ordering": true,
            "order": [
                [1, "desc"]
            ],
        });
    });
</script>
@endsection