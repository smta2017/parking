<nav class="{{ config('backpack.base.header_class') }}">
  <div class="navbar-wrapper">
    <div class="navbar-header">
      <ul class="nav navbar-nav flex-row">
        <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
        <div style="padding:20px 0 0 0; margin-left: 60px; font-weight: bold; width: 230px; font-size: 20px;">
          <span id="clock-wrapper"></span>
        </div>

        <li class="nav-item">
          <a class="navbar-brand" href="index.html">
            {!! config('backpack.base.project_logo') !!}
            <h3 class="brand-text">{{ config('backpack.base.project_name') }}</h3>
            <span>نظام ساحات الانتظار</span>
          </a>
        </li>


        <li class="nav-item d-md-none">
          <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
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