</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-gradient-info text-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto font-weight-bold">
            <span>&copy; Laundry Ilham || 2022 </span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

{{-- Logout Modal --}}
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Logout!</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Yakin {{ auth()->user()->nama_user }} ingin Logout?</div>
            <div class="modal-footer">
                <a class="btn btn-primary" href="{{ url('/logout') }}">Logout aja</a>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Gajadi deh</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.1.slim.js"
    integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk=" crossorigin="anonymous"></script>

{{-- <script src="{{ url('assets/admin/js/sweetalert.min.js') }}"></script> --}}
<script src="{{ url('assets/admin/js/7fdd60d3a4.js') }}"></script>
<script src="{{ url('assets/admin/js/jquery-3.6.1.slim.js') }}"></script>
<script src="{{ url('assets/admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ url('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ url('assets/admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<script src="{{ url('assets/admin/js/sb-admin-2.min.js') }}"></script>

{{-- <!-- Page level plugins -->
<script src="{{ url('assets/admin/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ url('assets/admin/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ url('assets/admin/js/demo/chart-pie-demo.js') }}"></script> --}}



<script>
    // Alert Delete Data
    // function confirmDelete(url) {
    //     const isConfirm = confirm('Apakah Anda yakin ingin MENGHAPUS DATA ini?');
    //     if (!isConfirm) return false;
    //     location.href = url;
    // }

    // Menghitung Detik
    function fixNumClock(num) {
        return num < 10 ? '0' + num : num;
    }

    // Membaca Nama Bulan dengan Alpabhet
    function monthNumToString(num) {
        switch (num) {
            case 1:
                return 'Januari';
            case 2:
                return 'Februari';
            case 3:
                return 'Maret';
            case 4:
                return 'April';
            case 5:
                return 'Mei';
            case 6:
                return 'Juni';
            case 7:
                return 'Juli';
            case 8:
                return 'Agustus';
            case 9:
                return 'September';
            case 10:
                return 'Oktober';
            case 11:
                return 'November';
            case 12:
                return 'Desember';
        }
    }

    function initClock() {
        setInterval(() => {
            const dateInstance = new Date();
            const year = dateInstance.getFullYear();
            const month = monthNumToString((dateInstance.getMonth() < 12 ? dateInstance.getMonth() + 1 :
                dateInstance.getMonth()));
            const date = fixNumClock(dateInstance.getDate());
            const hours = fixNumClock(dateInstance.getHours());
            const minutes = fixNumClock(dateInstance.getMinutes());
            const seconds = fixNumClock(dateInstance.getSeconds());

            const currentDatetime = `${date} ${month} ${year} ${hours}:${minutes}:${seconds} WIB`;
            $('#clock-realtime').html(currentDatetime);
        }, 1000);
    }
    initClock();

</script>
</body>


{{-- ALERT HAPUS DATA OUTLET --}}
<script>
    $('.deleteOutlet').click(function () {
        let id = $(this).attr('data-id-outlet');
        let nama = $(this).attr('data-nama-outlet');
        swal({
                title: "HAPUS DATA OUTLET?",
                text: "Menghapus Data Outlet > " + nama + " < ",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/admin/outlet/delete-outlet/" + id + ""
                    swal("Data Outlet Telah Berhasil Dihapus!", {
                        icon: "success",
                    });
                } else {
                    swal("OK! Gajadi Hapus Data Outlet");
                }
            });
    });
</script>

{{-- Alert Delete Member --}}
<script>
    $('.deleteMember').click(function () {
        let id = $(this).attr('data-id-member');
        let nama = $(this).attr('data-nama-member');
        swal({
                title: "HAPUS DATA MEMBER?",
                text: "Menghapus Data Member > " + nama + " < ",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/admin/member/delete-member/" + id + ""
                    swal("Data Member " + nama + " Telah Berhasil Dihapus!", {
                        icon: "success",
                    });
                } else {
                    swal("OK! Gajadi Hapus Data Member");
                }
            });
    });

</script>

{{-- ALERT HAPUS DATA USER --}}
<script>
    $('.deleteUser').click(function () {
        let id = $(this).attr('data-id-user');
        let nama = $(this).attr('data-nama-user');
        swal({
                title: "HAPUS DATA USER?",
                text: "Menghapus Nama Data User > " + nama + " < ",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/admin/user/delete-user/" + id + ""
                    swal("Data User Telah Berhasil Dihapus!", {
                        icon: "success",
                    });
                } else {
                    swal("OK! Gajadi Hapus Data User.");
                }
            });
    });

</script>

{{-- ALERT HAPUS DATA PAKET --}}
<script>
    $('.deletePaket').click(function () {
        let id = $(this).attr('data-id-paket');
        let nama = $(this).attr('data-nama-paket');
        swal({
                title: "HAPUS DATA PAKET?",
                text: "Menghapus Nama Data Paket " + nama + " ",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/admin/paket/delete-paket/" + id + ""
                    swal("Data Paket Telah Berhasil Dihapus!", {
                        icon: "success",
                    });
                } else {
                    swal("OK! Gajadi Hapus Data Paket.");
                }
            });
    });

</script>

{{-- ALERT HAPUS DATA TRANSAKSI --}}
<script>
    $('.deleteTransaksi').click(function () {
        let id = $(this).attr('data-id-transaksi');
        let nama = $(this).attr('data-nama-transaksi');
        swal({
                title: "HAPUS DATA TRANSAKSI?",
                text: "Menghapus Nama Transaksi > " + nama + " < ",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/admin/transaksi/delete-transaksi/" + id + ""
                    swal("Data Transaksi Telah Berhasil Dihapus!", {
                        icon: "success",
                    });
                } else {
                    swal("OK! Gajadi Hapus Data Transaksi.");
                }
            });
    });

</script>

</html>
