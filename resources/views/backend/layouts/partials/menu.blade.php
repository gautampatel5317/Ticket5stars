<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
       <a href="#" class="brand-link text-center">
            <img src="{{ \URL::to('/images/site_logo.png') }}" alt="Ticket5Star" class="brand-image">
            <span class="brand-text font-weight-light"><img src="{{ \URL::to('/images/site_logo.png') }}" alt="Ticket5Star"></span>
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
                <li class="nav-item has-treeview {{ request()->is('admin/permissions*') ? 'menu-open' : '' }} {{ request()->is('admin/roles*') ? 'menu-open' : '' }} {{ request()->is('admin/users*') ? 'menu-open' : '' }}">
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
                    </ul>
                </li>
                @endcan
                @can('product_access')
                <li class="nav-item">
                    <a href="{{ route("admin.products.index") }}" class="nav-link {{ request()->is('admin/products') || request()->is('admin/products/*') ? 'active' : '' }}">
                        <i class="fas fa-cogs">
                        </i>
                        <p>
                            <span>{{ trans('global.product.title') }}</span>
                        </p>
                    </a>
                </li>
                @endcan
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