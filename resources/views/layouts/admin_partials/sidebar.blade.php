@php
    $data = DB::table('settings')->first();
@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ url($data->logo) }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Ecommerce</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('backend') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.home') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Category
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('category.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('subcategory.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sub Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('childcategory.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Child Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('brand.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Brand</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('warehouse.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Warehouse</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Settings
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('seo.setting') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>SEO Setting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('website.setting') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Website Management</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('page.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Page Create</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('smtp.setting') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>SMTP Setting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('brand.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Payment Getway</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.password.change') }}" class="nav-link">
                        <i class="nav-icon far fa-circle text-info"></i>
                        <p>Password Chagnge</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="dropdown-item" href="{{ route('admin.logout') }}">
                        <i class="nav-icon far fa-circle text-info"></i>
                        {{ __('Logout') }}
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
