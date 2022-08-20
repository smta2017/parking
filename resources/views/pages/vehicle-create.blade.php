@extends(backpack_view('blank'))


@section('content')

<div class="add-new-subscriber">
    <div class="container-xxl">
        <div class="row">

            <div class="col-md-8">

                <form action="/admin/vehicles" method="POST" enctype="multipart/form-data" class="mt-4">
                    <h6 class="mb-0">أضافه مركبة جديد</h6>
                    <span style="font-size:12px" class="text-danger">يرجي التركيز و كتابه البيانات بعنايه ودقه عاليه</span>
                    <br />
                    @csrf
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
            </div><!-- End Col 8 -->

            <div class="col-md-4">
                <img src="/asset/img/Digital-wallet.webp" style="max-width:100%" alt="">
            </div><!-- End Col 4 -->
        </div>
    </div>
</div>


@endsection