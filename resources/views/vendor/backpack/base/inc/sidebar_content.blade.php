<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item">
    <a class="nav-link" href="{{ backpack_url('dashboard') }}">
        <i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}
    </a>
</li>


<li class="nav-item nav-dropdown open">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-group"></i> {{__('messages.Authentication')}}</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i>
                <span>{{ trans('backpack::messages.users') }}</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-group"></i>
                <span>{{ trans('backpack::messages.roles') }}</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i
                    class="nav-icon la la-key"></i> <span>{{ trans('backpack::messages.permissions') }}</span></a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('backup') }}'><i
                    class='nav-icon la la-hdd-o'></i> {{ trans('backpack::backup.backup') }}</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('log') }}'><i
                    class='nav-icon la la-terminal'></i>  {{trans('backpack::messages.logs')}} </a></li>

        <li class='nav-item'><a class='nav-link' href='{{ url(config('backpack.base.route_prefix', 'admin').'/language') }}'><i
                    class='nav-icon la la-flag-checkered'></i> {{trans('backpack::messages.languages')}}</a></li>

        <li class='nav-item'><a class='nav-link' href='{{ url(config('backpack.base.route_prefix', 'admin').'/language/texts') }}'><i
                    class='nav-icon la la-language'></i> {{trans('backpack::messages.site-texts')}} </a></li>
    </ul>
</li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('project') }}'><i class='nav-icon la la-question'></i> Projects</a></li>