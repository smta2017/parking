<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<!-- <li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li> -->

<li class=" nav-item"><a href="{{ backpack_url('dashboard') }}"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">{{__('dashboard.dashboard')}}</span><span class="badge badge badge-info badge-pill float-right mr-2">3</span></a>

</li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('transaction') }}'><i class='nav-icon la la-list'></i> {{__('dashboard.transactions')}}</a></li>
<li class=" navigation-header">

    <span data-i18n="nav.category.layouts"><strong>{{__('dashboard.roles')}}</strong> </span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>

</li>
<!-- Users, Roles, Permissions -->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> {{__('dashboard.authentication')}}</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item "><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>{{__('dashboard.users')}}</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>{{__('dashboard.roles')}}</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>{{__('dashboard.permissions')}}</span></a></li>
    </ul>
</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('plan-subscription') }}'><i class='nav-icon la la-question'></i> {{__('dashboard.plan_subscriptions')}}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('client') }}'><i class='nav-icon la la-question'></i> {{__('dashboard.clients')}}</a></li>