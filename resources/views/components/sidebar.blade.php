<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    {{-- <i class="nav-icon fas fa-edit"></i> --}}

    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Hemanshi</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="/admin/index" class="nav-link {{ (request()->is('admin/index'))?'active':''}} ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if(Auth::user()->hasAnyPermission(['write category','edit category','delete category']))
                <li class="nav-item">
                    <a href="/category" class="nav-link {{ (request()->is('category'))?'active':''}} ">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Category
                        </p>
                    </a>
                </li>
                @endif
                @if(Auth::user()->hasAnyPermission(['write post','edit post','delete post','publish post']))
                <li class="nav-item">
                    <a href="/posts" class="nav-link {{(request()->is('posts'))?'active':''}}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Manage Post
                        </p>
                    </a>
                </li>
                @endif
                @if(Auth::user()->hasAnyPermission(['write user','edit user','delete user']))
                <li class="nav-item">
                    <a href="/user" class="nav-link {{(request()->is('user'))?'active':''}}">
                        <i class="nav-icon fas fa-solid fa-user"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
                @endif
                @if(Auth::user()->hasAnyPermission(['write role','edit role','delete role']))
                <li class="nav-item">
                    <a href="/role" class="nav-link {{(request()->is('role'))?'active':''}}">
                        <i class="nav-icon fas fa-solid fa-file"></i>
                        <p>
                            Roles
                        </p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
