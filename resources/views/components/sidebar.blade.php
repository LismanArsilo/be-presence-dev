<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">Presence</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">P</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header"">Dashboard</li>
            <li class="nav-item {{ $data->type_menu === 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Master Data Managment</li>
            <li class="nav-item dropdown {{ $data->type_menu === 'user' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>User</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('user') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('view.list.user') }}">List User</a>
                    </li>
                    <li class="{{ Request::is('user/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('view.create.user') }}">Create User</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ $data->type_menu === 'service-unit' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Service Unit</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('service-unit') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('view.list.service-unit') }}">List Service Unit</a>
                    </li>
                    <li class="{{ Request::is('service-unit/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('view.create.service-unit') }}">Create Service Unit</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ $data->type_menu === 'company' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Company</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('company') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('view.list.company') }}">List Company</a>
                    </li>
                    <li class="{{ Request::is('company/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('view.create.company') }}">Create Company</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ $data->type_menu === 'role' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Role</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('role') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('view.list.role') }}">List Role</a>
                    </li>
                    <li class="{{ Request::is('role/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('view.create.role') }}">Create Role</a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">Monitoring Presence</li>
            <li class="nav-item dropdown {{ $data->type_menu === 'attendance' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Attendance</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('attendance') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('view.list.attendance') }}">List Attendance</a>
                    </li>
                    {{-- <li class="{{ Request::is('attendance/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('view.create.attendance') }}">Create Attendance</a>
                    </li> --}}
                </ul>
            </li>
            <li class="nav-item dropdown {{ $data->type_menu === 'permission' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Permission</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('permission') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('view.list.permission') }}">List Permission</a>
                    </li>
                    {{-- <li class="{{ Request::is('attendance/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('view.create.attendance') }}">Create Attendance</a>
                    </li> --}}
                </ul>
            </li>
        </ul>
    </aside>
</div>
