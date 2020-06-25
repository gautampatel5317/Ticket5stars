<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-center" style="height: 90px;">
        <img style="width: 100%;height:100%;" src="{{ \URL::to('images/site_logos.png') }}" alt="Ticket5Star" class="brand-image">
        <span class="brand-text font-weight-light"><img style="width: 156px;height:86px;" src="{{ \URL::to('images/site_logos.png') }}" alt="Ticket5Star"></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route("admin.home") }}" class="nav-link  {{ request()->is('admin') || request()->is('admin') ? 'active' : '' }}">
                        <p>
                            <i class="fas fa-tachometer-alt">
                            </i>
                            <span>{{ trans('global.dashboard') }}</span>
                        </p>
                    </a>
                </li>
                 @can('user_access')
                <li class="nav-item">
                    <a href="{{ route("admin.users.profile") }}" class="nav-link {{ request()->is('admin/profile') || request()->is('admin/profile/*') ? 'active' : '' }}">
                        <i class="fas fa-user">
                        </i>
                        <p>
                            <span>{{ trans('global.profile.title') }}</span>
                        </p>
                    </a>
                </li>
                @endcan
                 <li class="nav-item">
                    <a href="{{ route('admin.video') }}" class="nav-link {{ request()->is('admin/video') || request()->is('admin/video/*') ? 'active' : '' }}">
                        <p>
                            <i class="fas fa-video"></i>
                            <span>{{ trans('Video') }}</span>
                        </p>
                    </a>
                </li>
                 <li class="nav-item">
                    <a href="{{ route('admin.calander') }}" class="nav-link {{ request()->is('admin/calander') || request()->is('admin/calander') ? 'active' : '' }}">
                        <p>
                            <i class="far fa-calendar-times"></i>
                            <span>{{ trans('Calander') }}</span>
                        </p>
                    </a>
                </li>
                  <li class="nav-item">
                    <a href="{{ route('admin.barcode') }}" class="nav-link {{ request()->is('admin/barcode') || request()->is('admin/barcode') ? 'active' : '' }}">
                        <p>
                            <i class="fas fa-barcode"></i>
                            <span>{{ trans('QRCODE') }}</span>
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                <li class="nav-item has-treeview {{ request()->is('admin/permissions*') ? 'menu-open' : '' }} {{ request()->is('admin/roles*') ? 'menu-open' : '' }} {{ request()->is('admin/users*') ? 'menu-open' : '' }} {{ request()->is('admin/experience*') ? 'menu-open' : '' }}" style="cursor: pointer;">
                    <a class="nav-link nav-dropdown-toggle">
                        <i class="fas fa-users">
                        </i>
                        <p>
                            <span>{{ trans('global.userManagement.title') }}</span>
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('permission_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                <i class="fas fa-unlock-alt">
                                </i>
                                <p>
                                    <span>{{ trans('global.permission.title') }}</span>
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('role_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                <i class="fas fa-briefcase">
                                </i>
                                <p>
                                    <span>{{ trans('global.role.title') }}</span>
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('user_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                <i class="fas fa-user">
                                </i>
                                <p>
                                    <span>{{ trans('global.user.title') }}</span>
                                </p>
                            </a>
                        </li>
                        @endcan
                        @can('experience_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.experience.index") }}" class="nav-link {{ request()->is('admin/experience') || request()->is('admin/experience/*') ? 'active' : '' }}">
                                    <i class="fas fa-level-up-alt"></i>
                                    <p><span>{{ trans('global.experience.title') }}</span></p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                <li class="nav-item">
                    <a href="{{ route('admin.emailtemplates.index') }}" class="nav-link {{ request()->is('admin/emailtemplates/*') || request()->is('admin/emailtemplates') ?'active':'' }}">
                        <p>
                            <i class="fas fa-envelope-open-text"></i>
                            <span>{{ trans('Email Templates') }}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.settings.update',[1]) }}" class="nav-link {{ request()->is('admin/settings/1/edit') ? 'active' : '' }}">
                        <p>
                            <i class="fas fa-cogs"></i>
                            <span>{{ trans('Settings') }}</span>
                        </p>
                    </a>
                </li>
                @can('customer_access')
                <li class="nav-item">
                    <a href="{{ route("admin.customers.index") }}" class="nav-link {{ request()->is('admin/customers') || request()->is('admin/customers/*') ? 'active' : '' }}">
                        <i class="fas fa-users-cog"></i>
                        <p>
                            <span>{{ trans('global.customer.title') }}</span>
                        </p>
                    </a>
                </li>
                @endcan
                @can('cms_access')
                <li class="nav-item">
                    <a href="{{ route("admin.cms.index") }}" class="nav-link {{ request()->is('admin/cms') || request()->is('admin/cms/*') ? 'active' : '' }}">
                        <i class="fa fa-file"></i>
                        <p><span>{{ trans('global.pages') }}</span></p>
                    </a>
                </li>
                @endcan

                <li class="nav-item has-treeview {{ request()->is('admin/country*') ? 'menu-open' : '' }} {{ request()->is('admin/state*') ? 'menu-open' : '' }} {{ request()->is('admin/city*') ? 'menu-open' : '' }} {{ request()->is('admin/ingredient*') ? 'menu-open' : '' }}" style="cursor: pointer;">
                    <a class="nav-link nav-dropdown-toggle">
                        <i class="fas fa-users">
                        </i>
                        <p>
                            <span>{{ trans('global.masters') }}</span>
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('country_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.country.index") }}" class="nav-link {{ request()->is('admin/country') || request()->is('admin/country/*') ? 'active' : '' }}">
                                <i class="fa fa-flag"></i>
                                <p><span>{{ trans('global.country.title') }}</span></p>
                            </a>
                        </li>
                        @endcan
                        @can('state_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.state.index") }}" class="nav-link {{ request()->is('admin/state') || request()->is('admin/state/*') ? 'active' : '' }}">
                                <i class="fa fa-city"></i>
                                <p><span>{{ trans('global.state.title') }}</span></p>
                            </a>
                        </li>
                        @endcan
                        @can('city_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.city.index") }}" class="nav-link {{ request()->is('admin/city') || request()->is('admin/city/*') ? 'active' : '' }}">
                                <i class="fa fa-city"></i>
                                <p><span>{{ trans('global.city.title') }}</span></p>
                            </a>
                        </li>
                        @endcan
                        @can('ingredient_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.ingredient.index") }}" class="nav-link {{ request()->is('admin/ingredient') || request()->is('admin/ingredient/*') ? 'active' : '' }}">
                                    <i class="fa fa-exclamation-circle"></i>
                                    <p><span>{{ trans('global.ingredient.title') }}</span></p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-sign-out-alt">
                            </i>
                            <span>{{ trans('global.logout') }}</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>