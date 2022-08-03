<div class="top-nav">
  <div class="container-xxl">
    <div class="row">

      <div class="col-md-3 col-xl-2">
        <div class="top-nav-logo py-3">
          <img src="/asset/img/top-logo.webp" class="float-start me-2 mt-2" alt="" />
          <span>ديوان عام محافظه القاهره</span><br />
          <strong>نظام ساحات الأنتظار</strong>
        </div>
      </div>

      <div class="col-md-3 col-xl-2">
        <div class="text-center py-3">
          <span style="display: inline-block; margin: 0 5px;">
            <strong>التوقيت الأن</strong> <br />
            <span>11:08 AM</span>
          </span>
          <span style="display: inline-block; margin: 0 5px;">
            <strong>تاريخ اليوم</strong> <br />
            <span>02/08/2022</span>
          </span>
        </div>
      </div>

      <div class="col-md-3 col-xl-2">
        <div class="box text-center py-3">
          <h6>أختار ساحه الأنتظار</h6>
          <select class="form-control">
            <option value="">ساحة العبور</option>
            <option value="">ساحة المنتزه</option>
            <option value="">ساحة وسط البلد</option>
          </select>
        </div>
      </div>

      <div class="col-md-3 col-xl-2">
        <div class="demo text-center py-3">
          <span class="back">
            <span class="title">النظام تحت التجربه و الأختبار</span>
          </span>
        </div>
      </div>

      <div class="col-md-4">
        <div class="box text-end py-3">
          <img src="/asset/img/255.webp" alt="" />
          <div class="dropdown" style="display: inline-block;">
            <button class="btn dropdown-toggle" id="top-btn" data-bs-toggle="dropdown">
              الساحات الحديثة
            </button>
            <ul class="dropdown-menu" aria-labelledby="top-btn">
              <li><a class="dropdown-item" href="#">تسجيل خروج</a></li>
            </ul>
          </div>

          <img src="/asset/img/Picture.webp" class="mt-2" alt="" />
        </div>
      </div>

    </div>
  </div><!-- End Container -->
</div><!-- End top nav -->
<div class="main-menu py-2">
            <div class="container-xxl">
                <div class="row">
                    <div class="col-md-7">

                        <ul class="list-inline mb-0">
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
                                <span>دخول</span>
                                <span class="text-success mx-2"><strong>651 <i class="fa-solid fa-angles-down"></i></strong></span>
                            </li>
                            
                            <li class="list-inline-item">
                                <span>خروج</span>
                                <span class="text-danger mx-2"><strong>300 <i class="fa-solid fa-angles-up"></i></strong></span>
                            </li>
                            
                            <li class="list-inline-item">
                                <span>مشغول</span>
                                <span class="text-warning mx-2"><strong>500</strong></span>
                            </li>
                            <li class="list-inline-item">
                                <span>شاغر</span>
                                <span class="text-info mx-2"><strong>500</strong></span>
                            </li>
                            
                            <li class="list-inline-item">
                                <span>نسبه الأشغال</span>
                                <span class="text-danger mx-2"><strong>30%</strong></span>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-5">
                        <ul class="list-inline mb-0">
                            
                            <li class="list-inline-item">
                                <span>عدد الموظفين</span>
                                <span class="text-warning mx-2"><strong>8</strong></span>
                            </li>
                            
                            <li class="list-inline-item">
                                <span>ربح اليوم</span>
                                <span class="text-success mx-2"><strong>1200</strong></span>
                            </li>
                            <li class="list-inline-item">
                                <span>ربح الشهر</span>
                                <span class="text-success mx-2"><strong>1200</strong></span>
                            </li>
                            
                            <li class="list-inline-item">
                                <a href="#" class="custom-btn"><i class="fa-solid fa-video"></i> كاميرات المراقبه</a>
                            </li>
                            
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div><!-- End main-menu -->


<script>
  setInterval(function() {
    var date = new Date();

    var dd = String(date.getDate()).padStart(2, '0');
    var mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = date.getFullYear();
    var ampm = date.getHours() >= 12 ? 'pm' : 'am';
    today = yyyy + '/' + mm + '/' + dd;
    var hour = (date.getHours() % 12) || 12
    $('#clock-wrapper').html(
      today + " | <span style='color:orange'>" + hour + ":" + date.getMinutes() + ' ' + ampm + "</span>"
    );
  }, 500);
</script>