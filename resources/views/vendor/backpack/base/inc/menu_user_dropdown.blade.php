
<li class="dropdown dropdown-user nav-item">
    <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
        <span class="mr-1">Hello,
            <span class="user-name text-bold-700">{{backpack_user()->getAttribute('name')}}</span>
        </span>
        <span class="avatar avatar-online">
            <img src="../../../app-assets/images/portrait/small/avatar-s-19.png" alt="{{ backpack_auth()->user()->name }}"><i></i></span>
    </a>
    <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item {{ config('backpack.base.html_direction') == 'rtl' ? 'dropdown-menu-left' : 'dropdown-menu-right' }}" href="#"><i class="ft-user"></i> Edit Profile</a>
        <a class="dropdown-item" href="#"><i class="ft-mail"></i> My Inbox</a>
        <a class="dropdown-item" href="#"><i class="ft-check-square"></i> Task</a>
        <a class="dropdown-item" href="#"><i class="ft-message-square"></i> Chats</a>
        <div class="dropdown-divider"></div><a class="dropdown-item" href="{{ backpack_url('logout') }}"><i class="ft-power"></i> {{ trans('backpack::base.logout') }}</a>
    </div>
</li>
