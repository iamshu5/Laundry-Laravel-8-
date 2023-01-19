@include('partials.header', ['title' => 'Dashboard'])

<section class="dashboard-kasir">
    <div class="container-fluid">
        <h6 class="font-weight-bold text-center">*Nama Outlet = "{{ auth()->user()->outlet->nama_outlet }}"</h6>
        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
                <a href="{{ url('kasir/transaksi/data-transaksi') }}" class=" px-3 card border-left-primary shadow h-100 py-2 text-decoration-none">
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
                <a href="{{ url('kasir/member/data-member') }}" class=" px-3 card border-left-info shadow h-100 py-2 text-decoration-none">
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

        </div>
    </div>
</section> {{-- End Dashboard Admin --}}

@include('partials.footer')
