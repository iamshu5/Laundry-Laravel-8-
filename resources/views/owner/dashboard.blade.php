@include('partials.header', ['title' => 'Dashboard'])

<section class="dashboard-owner">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
                <a href="{{ url('owner/transaksi/data-transaksi') }}" class=" px-3 card border-left-primary shadow h-100 py-2 text-decoration-none">
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
        </div>
    </div>
</section> {{-- End Dashboard Admin --}}

@include('partials.footer')
