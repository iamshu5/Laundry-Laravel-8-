@include('partials.header', ['title' => 'Dashboard'])

<section class="dashboard-admin">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
                <a href="{{ url('admin/outlet/data-outlet') }}" class=" px-3 card border-left-success shadow h-100 py-2 text-decoration-none">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-0">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    TOTAL OUTLET</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $outlet }} - Outlet</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-store fa-2x text-gray-500"></i>
                                </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <a href="{{ url('admin/transaksi/data-transaksi') }}" class=" px-3 card border-left-primary shadow h-100 py-2 text-decoration-none">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-0">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    TOTAL TRANSAKSI</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $transaksi }} - Transaksi</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-cash-register fa-2x text-gray-500"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <a href="{{ url('admin/paket/data-paket') }}" class=" px-3 card border-left-danger shadow h-100 py-2 text-decoration-none">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-0">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    TOTAL PAKET</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $paket }} - Paket</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-boxes-stacked fa-2x text-gray-500"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <a href="{{ url('admin/member/data-member') }}" class=" px-3 card border-left-info shadow h-100 py-2 text-decoration-none">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-0">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    TOTAL MEMBER</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $member }} - Member</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-users fa-2x text-gray-500"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <a href="{{ url('admin/user/data-user') }}" class=" px-3 card border-left-secondary shadow h-100 py-2 text-decoration-none">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-0">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                    TOTAL USER</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $user }} - User</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-alt fa-2x text-gray-500"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            {{-- CHART BATANG TOTAL TAHUN ALUMNI LULUS --}}
            <div class="panel mb-3 col-md-6">
                <div id="chartTahun"></div>
            </div>

            {{-- CHART PIE SEKOLAH LANJUTAN --}}
            <div class="panel col-md-6">
                <div id="chartSMA"></div>
            </div>
        </div>
    </div>
</section> {{-- End Dashboard Admin --}}

@include('partials.footer')
