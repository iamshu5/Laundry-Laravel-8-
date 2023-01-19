    <hr class="sidebar-divider">
            <!-- MASTERDATA LAUNDRY -->
            <div class="sidebar-heading">MASTERDATA TRANSAKSI</div>
            <li class="nav-item {{ $title === 'Data Transaksi' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/kasir/transaksi/data-transaksi') }}">
                    <i class="fa-solid fa-cash-register"></i>
                    <span>Data Transaksi</span></a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">MASTERDATA MEMBER</div>
            <li class="nav-item {{ $title === 'Data Member' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/kasir/member/data-member') }}">
                    <i class="fa-solid fa-users"></i>
                    <span>Data Member</span></a>
            </li>
            <hr class="sidebar-divider">