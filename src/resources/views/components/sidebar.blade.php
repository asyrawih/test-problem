<div>
    <!-- Sidebar outter -->
    <div class="main-sidebar sidebar-style-2">
        <!-- sidebar wrapper -->
        <aside id="sidebar-wrapper">
            <!-- sidebar brand -->
            <div class="sidebar-brand">
                <a href="{{ route('welcome') }}">{{ config('app.name', 'Laravel') }}</a>
            </div>
            <!-- sidebar menu -->
            <ul class="sidebar-menu">
                <!-- menu header -->
                <li class="menu-header">General</li>
                <!-- menu item -->
                <li class="{{ Route::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-fire"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ Route::is('profile') ? 'active' : '' }}">
                    <a href="{{ route('profile') }}">
                        <i class="fas fa-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li class="{{ Route::is('finance') ? 'active' : '' }}">
                    <a href="{{ route('finance') }}">
                    <i class="fas fa-user"></i>
                        <span>Finance</span>
                    </a>
                </li>
                <li class="{{ Route::is('expanse') ? 'active' : '' }}">
                    <a href="{{ route('expanse') }}">
                        <i class="fas fa-user"></i>
                        <span>Expanse</span>
                    </a>
                </li>
            </ul>
        </aside>
    </div>
</div>