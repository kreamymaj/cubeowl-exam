<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            <a href="{{ route('profile.show') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div> --}}

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">
                    <i class='bx bxs-dashboard'></i>
                    <p>
                        {{ __(' Dashboard') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('products') }}" class="nav-link">
                    <i class='bx bxl-product-hunt'></i>
                    <p>
                        {{ __('Products') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('stores') }}" class="nav-link">
                    <i class='bx bx-store-alt'></i>
                    <p>
                        {{ __('Stores') }}
                    </p>
                </a>
            </li>

          
            <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link">
                    <i class='bx bxs-user-account'></i>
                    <p>
                        {{ __('Users') }}
                    </p>
                </a>
            </li>

           

            <li class="nav-item">
                <a href="{{ route('trash') }}" class="nav-link">
                    <i class='bx bx-trash'></i>
                    <p>
                        {{ __('Trash') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('history') }}" class="nav-link">
                    <i class='bx bx-history'></i>
                    <p>
                        {{ __('Activity Logs') }}
                    </p>
                </a>
            </li>
            
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->