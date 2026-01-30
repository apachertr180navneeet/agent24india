@php 
use Illuminate\Support\Str;
$currentRoute = request()->route()->getName();
@endphp

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset('public/dist/img/AdminLTELogo.png') }}" 
             class="brand-image img-circle elevation-3" />
        <span class="brand-text font-weight-light">AgentIndia</span>
    </a>

    <div class="sidebar">

        <!-- User Panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('public/dist/img/user2-160x160.jpg') }}" 
                     class="img-circle elevation-2" />
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name ?? 'User' }}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">

                {{-- Dashboard --}}
                @if(auth()->user()->hasPermissionTo('View Dashboard'))
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @endif


                {{-- MASTER DROPDOWN --}}
                <li class="nav-item 
                    {{ request()->routeIs(
                        'admin.role.*',
                        'admin.category.*',
                        'admin.subcategory.*',
                        'admin.banner.*',
                        'admin.state.*',
                        'admin.district.*',
                        'admin.city.*'
                    ) ? 'menu-open' : '' }}">

                    <a href="#" class="nav-link 
                        {{ request()->routeIs(
                            'admin.role.*',
                            'admin.category.*',
                            'admin.subcategory.*',
                            'admin.banner.*',
                            'admin.state.*',
                            'admin.district.*',
                            'admin.city.*'
                        ) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        @if(auth()->user()->hasPermissionTo('View Role'))
                        <li class="nav-item">
                            <a href="{{ route('admin.role.index') }}" 
                               class="nav-link {{ request()->routeIs('admin.role.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Role</p>
                            </a>
                        </li>
                        @endif

                        @if(auth()->user()->hasPermissionTo('View Category'))
                        <li class="nav-item">
                            <a href="{{ route('admin.category.index') }}" 
                               class="nav-link {{ request()->routeIs('admin.category.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>Category</p>
                            </a>
                        </li>
                        @endif

                        @if(auth()->user()->hasPermissionTo('View Tag'))
                        <li class="nav-item">
                            <a href="{{ route('admin.subcategory.index') }}" 
                               class="nav-link {{ request()->routeIs('admin.subcategory.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tag"></i>
                                <p>Sub Category</p>
                            </a>
                        </li>
                        @endif

                        @if(auth()->user()->hasPermissionTo('View Banner'))
                        <li class="nav-item">
                            <a href="{{ route('admin.banner.index') }}" 
                               class="nav-link {{ request()->routeIs('admin.banner.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-image"></i>
                                <p>Banner</p>
                            </a>
                        </li>
                        @endif

                        @if(auth()->user()->hasPermissionTo('View State'))
                        <li class="nav-item">
                            <a href="{{ route('admin.state.index') }}" 
                               class="nav-link {{ request()->routeIs('admin.state.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-map"></i>
                                <p>State</p>
                            </a>
                        </li>
                        @endif

                        @if(auth()->user()->hasPermissionTo('View District'))
                        <li class="nav-item">
                            <a href="{{ route('admin.district.index') }}" 
                               class="nav-link {{ request()->routeIs('admin.district.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-map-marked"></i>
                                <p>District</p>
                            </a>
                        </li>
                        @endif

                        @if(auth()->user()->hasPermissionTo('View City'))
                        <li class="nav-item">
                            <a href="{{ route('admin.city.index') }}" 
                               class="nav-link {{ request()->routeIs('admin.city.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-city"></i>
                                <p>City</p>
                            </a>
                        </li>
                        @endif

                    </ul>
                </li>


                {{-- Admin Users --}}
                @if(auth()->user()->hasPermissionTo('View User'))
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" 
                       class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-shield"></i>
                        <p>Admin User</p>
                    </a>
                </li>
                @endif


                {{-- Vendors --}}
                @if(auth()->user()->hasPermissionTo('View Vendor'))
                <li class="nav-item">
                    <a href="{{ route('admin.vendors.index') }}" 
                       class="nav-link {{ request()->routeIs('admin.vendors.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Agent</p>
                    </a>
                </li>
                @endif


                {{-- Logout --}}
                <li class="nav-item">
                    <a href="{{ route('admin.logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
