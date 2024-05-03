<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('layouts.index') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('layouts.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>


    <!-- Nav Item - Pages Collapse Menu -->

    <li class="nav-item menu-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser"
            aria-expanded="true" aria-controls="collapseUser">
            <i class="fas fa-fw fa-cog"></i>
            <span>User</span>
        </a>
        <div id="collapseUser" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('users.index') }}">List User</a>
                <a class="collapse-item" href="{{ route('users.create') }}">Create User</a>
            </div>
        </div>
    </li>

    <li class="nav-item menu-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRole"
            aria-expanded="true" aria-controls="collapseRole">
            <i class="fas fa-fw fa-cog"></i>
            <span>Role</span>
        </a>
        <div id="collapseRole" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('roles.index') }}">List Role</a>
                <a class="collapse-item" href="{{ route('roles.create') }}">Create Role</a>
            </div>
        </div>
    </li>


    <li class="nav-item menu-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePermission"
            aria-expanded="true" aria-controls="collapsePermission">
            <i class="fas fa-fw fa-cog"></i>
            <span>Permission</span>
        </a>
        <div id="collapsePermission" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('permissions.index') }}">List Permission
                    <a class="collapse-item" href="{{ route('permissions.create') }}">Create Permission</a>
            </div>
        </div>
    </li>

    <li class="nav-item menu-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct"
            aria-expanded="true" aria-controls="collapseProduct">
            <i class="fas fa-fw fa-list"></i>
            <span>Post</span>
        </a>
        <div id="collapseProduct" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('posts.index') }}">List Post</a>
                <a class="collapse-item" href="{{ route('posts.create') }}">Create Post</a>

            </div>
        </div>
    </li>
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
