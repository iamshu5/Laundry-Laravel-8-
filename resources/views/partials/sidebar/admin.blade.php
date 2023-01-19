            <hr class="sidebar-divider">
            <!-- MASTERDATA LAUNDRY -->
            <div class="sidebar-heading">MASTERDATA LAUNDRY</div>

            <li class="nav-item {{ $title === 'Data Outlet' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/admin/outlet/data-outlet') }}">
                    <i class="fas fa-store"></i>
                    <span>Data Outlet</span></a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">MASTERDATA TRANSAKSI</div>
            <li class="nav-item {{ $title === 'Data Transaksi' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/admin/transaksi/data-transaksi') }}">
                    <i class="fa-solid fa-cash-register"></i>
                    <span>Data Transaksi</span></a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">MASTERDATA MEMBER & PAKET</div>

            <li class="nav-item {{ $title === 'Data Paket' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/admin/paket/data-paket') }}">
                    <i class="fa-solid fa-boxes-stacked"></i>
                    <span>Data Paket</span></a>
            </li>

            <li class="nav-item {{ $title === 'Data Member' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/admin/member/data-member') }}">
                    <i class="fa-solid fa-users"></i>
                    <span>Data Member</span></a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">MASTERDATA USER</div>
            <li class="nav-item {{ $title === 'Data User' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/admin/user/data-user') }}">
                    <i class="fas fa-user-alt"></i>
                    <span>Data User</span></a>
            </li>