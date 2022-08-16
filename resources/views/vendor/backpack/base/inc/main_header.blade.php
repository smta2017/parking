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
                                <span>11:08 AM</span>
                            </span>
                            <span>
                                <span style="color:#FEBE0A;">تاريخ اليوم</span> <br />
                                <span>02/08/2022</span>
                            </span>
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-xl-2 text-center">
                        <div class="box py-3 select">
                            <h6 style="color:#FEBE0A;">أختار ساحه الأنتظار</h6>
                            <select class="form-control p-0">
                                <option value="">ساحة العبور</option>
                                <option value="">ساحة المنتزه</option>
                                <option value="">ساحة وسط البلد</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3 col-xl-2">
                        <span class="back">
                            النظام تحت التجربه و الأختبار
                            <a href="{{ backpack_url('logout') }}">خروج</a> 
                        </span>

                    </div>

                    <div class="col-md-4">
                        <div class="box text-end py-3 last-box">
                            <img src="/asset/img/255.webp" alt="" />
                            <div class="box select2">
                                <select class="form-control">
                                    <option value="">شركه الساحات الحديثه</option>
                                </select>
                            </div>

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
                                <span>دخول</span>
                                <img src="https://static.wixstatic.com/media/c24732_4f40eda3c755417f92e165dcdcf77564~mv2.gif" alt="Green-animated-arrow-right.gif" style="width:9px;height:9px;object-fit:cover;transform:rotate(90deg)" />
                            </li>
                            
                            <li class="list-inline-item">
                                <span>خروج</span>
                                <img src="https://static.wixstatic.com/media/c24732_4f40eda3c755417f92e165dcdcf77564~mv2.gif" alt="Green-animated-arrow-right.gif" style="width:9px;height:9px;object-fit:cover;filter:invert(1);transform:rotate(270deg)" />
                                <!-- <span class="text-danger mx-2"><strong>300 <i class="fa-solid fa-angles-up"></i></strong></span> -->
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

                    <div class="col-md-5 text-end">
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