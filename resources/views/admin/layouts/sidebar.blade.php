<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/diagnosa" class="brand-link">
        <img src="/dist/img/DiabExpert-Logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8;">
        <span class="brand-text font-weight-bold">DiabExpert</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Menu Diagnosa -->
                <li class="nav-item">
                    <a href="/diagnosa" class="nav-link {{ Request::is('diagnosa*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-stethoscope"></i>
                        <p>Diagnosa</p>
                    </a>
                </li>

                <!-- Admin Menu -->
                @if (auth()->check() && auth()->user()->role == 'admin')
                <li class="nav-item">
                    <a href="/admin/pasien" class="nav-link {{ Request::is('admin/pasien*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Pasien</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/penyakit" class="nav-link {{ Request::is('admin/penyakit*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-disease"></i>
                        <p>Penyakit</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/gejala" class="nav-link {{ Request::is('admin/gejala*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Gejala</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/user" class="nav-link {{ Request::is('admin/user*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>User</p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
