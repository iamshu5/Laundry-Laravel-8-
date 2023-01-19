<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ url('assets/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/admin/js/7fdd60d3a4.js') }}">
    <link href="{{ url('assets/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <title>DETAIL TRANSAKSI</title>
</head>

<body>
    <section id="table-detail">
        <div class="container-fluid">
            <a href="{{ url('/admin/transaksi/data-transaksi') }}"
                class="btn btn-warning mt-3 text-white shadow">BACK</a>
            <div class="card text-center shadow mb-4 mt-5">
                <div class="card-header py-3">
                    <div class="row justify-content-center">
                        <h2 class="m-0 font-weight-bold text-primary text-center"><i class="fas fa-info-circle"></i>
                            ~DETAIL TRANSAKSI~</h2>
                    </div>
                </div>
                <div class="card-body bg-info">
                    <div class="row justify-content-between">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="" class="text-white">Kode Invoice</label>
                                <input type="text" value="{{ $transaksi->kode_invoice }}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="" class="text-white">Total Harga Paket</label>
                                <input type="text" value="{{ $total_harga }}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="" class="text-white">Status Barang</label>
                                <input type="text" value="{{ $transaksi->status }}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="" class="text-white">Tanggal Transaksi</label>
                                <input type="text" value="{{ $transaksi->tgl }}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="" class="text-white">Batas Waktu</label>
                                <input type="text" value="{{ $transaksi->batas_waktu }}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="" class="text-white">Status Pembayaran</label>
                                <input type="text" value="{{ $transaksi->dibayar }}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="" class="text-white">Pajak</label>
                                <input type="text" value="{{ $transaksi->pajak }}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="" class="text-white">Diskon</label>
                                <input type="text" value="{{ $transaksi->diskon }}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="" class="text-white">Total Bayar</label>
                                <input type="text" value="{{ $total_bayar }}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="" class="text-white">Biaya Tambahan</label>
                                <input type="text" value="{{ $transaksi->biaya_tambahan }}" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($transaksi->detail as $detailTransaksi)
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="badge badge-pill badge-info">(ID) Nama Paket</label>
                            <input type="text" value="{{ $detailTransaksi->paket->id_paket }} - {{ $detailTransaksi->paket->nama_paket }}" name="id_paket" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label for="" class="badge badge-pill badge-primary">QTY</label>
                            <input type="text" value="{{ $detailTransaksi->qty }}" name="qty" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label for="" class="badge badge-pill badge-success">Keterangan</label>
                            <textarea type="text" name="keterangan" class="form-control" readonly>{{ $detailTransaksi->keterangan }}</textarea>
                        </div>
                        
                    </div>
                @endforeach
            </div>
        </div>
    </section>

</body>
</html>
