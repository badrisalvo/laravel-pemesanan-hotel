
    <div class="main-header">
        <div class="logo-header" data-background-color="light-blue2">
            <a href="/" class="logo">
    <img src="/img/core-img/persamaan.png" alt="navbar brand" class="navbar-brand" 
         style="height: 60px; position: relative; top: -3px; left: 600%;">


            </a>
            <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <i class="icon-menu"></i>
                </span>
            </button>
            <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="icon-menu"></i>
                </button>
            </div>
        </div>
        <nav class="navbar navbar-header navbar-expand-lg" data-background-color="light-blue2">
            <div class="container-fluid">
                <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Profile
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                                <a class="dropdown-item">
                                    <strong>{{ Auth::user()->name }}</strong><br>
                                    <small>{{ Auth::user()->email }}</small>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Login</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
    </div>
    <div class="sidebar sidebar-style-2">
    <div class="sidebar-background"></div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-info">
                <li class="nav-item active">
                    <a href="/admin/about">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kategori.index') }}">
                        <i class="fas fa-paint-brush"></i>
                        <p>Data Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kamar.index') }}">
                        <i class="fas fa-plus-square"></i>
                        <p>Data Kamar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.pengunjung') }}">
                        <i class="fas fa-pen-square"></i>
                        <p>Data Pengunjung</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('booking.index') }}">
                        <i class="fas fa-th-list"></i>
                        <p>Data Booking</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporan.index')}}">
                        <i class="fas fa-table"></i>
                        <p>Laporan</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

</div>
