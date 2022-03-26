@if (backpack_auth()->check())
<!-- Left side column. contains the sidebar -->
<div class="{{ config('backpack.base.sidebar_class') }}" data-scroll-to-active="true">
  <!-- sidebar: style can be found in sidebar.less -->
  <div class="main-menu-content">

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

      <!-- <li class="nav-title">{{ trans('backpack::base.administration') }}</li> -->
      <!-- ================================================ -->
      <!-- ==== Recommended place for admin menu items ==== -->
      <!-- ================================================ -->

      @include(backpack_view('inc.sidebar_content'))

      <!-- ======================================= -->
      <!-- <li class="divider"></li> -->
      <!-- <li class="nav-title">Entries</li> -->
    </ul>
  </div>
  <!-- /.sidebar -->
</div>
@endif