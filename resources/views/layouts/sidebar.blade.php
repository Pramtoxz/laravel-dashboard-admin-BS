<aside class="navbar navbar-vertical navbar-expand-lg" >
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand">
            <a href="#">App Saya</a>
        </h1>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-home fs-2"></i>
                        </span>
                        <span class="nav-link-title">
                            Home
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="confirmLogout(event)">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-settings-bolt"></i>
                        </span>
                        <span class="nav-link-title">
                            Logout
                        </span>
                    </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
        </div>
    </div>
</aside>