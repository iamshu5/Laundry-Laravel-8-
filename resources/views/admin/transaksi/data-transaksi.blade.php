@include('partials.header', ['title' => 'Data Transaksi'])

<section id="table-transaksi">
    <div class="container-fluid">
        <div class="mb-3 d-flex justify-content-end">
            <form class="form-inline d-sm-inline-block">
                <input class="form-control mr-sm-2 btn-sm mx-auto" name="search_transaksi" type="search"
                    placeholder="Cari Data Transaksi" aria-label="Search"
                    value="{{ request()->search_transaksi ?? '' }}">
                <button class="btn btn-outline-primary my-2 my-sm-0 btn-sm" type="submit"><i
                        class="fas fa-search"></i></button>
            </form>
        </div> {{-- Form Pencarian --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">TABEL DATA TRANSAKSI</h6>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-info shadow-sm" data-toggle="modal"
                        data-target="#ModalTambahTransaksi">
                        <i class="fas fa-user-plus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">

                @if(session()->exists('alert'))
                    <div class="alert alert-{{ session()->get('alert')['bg'] }} alert-dismissible fade show"
                        role="alert">
                        {{ session()->get('alert')['message'] }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        @foreach($errors->all() as $error )
                            {{ $error }}
                        @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID Transaksi</th>
                                <th>(ID) Nama Outlet</th>
                                <th>Kode Invoice</th>
                                <th>(ID) Nama Member</th>
                                <th>Tanggal Transaksi</th>
                                <th>Batas Waktu</th>
                                <th>Tanggal Bayar</th>
                                <th>Biaya Tambahan</th>
                                <th>Diskon</th>
                                <th>Pajak</th>
                                <th>Status</th>
                                <th>Dibayar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(count($transaksi) == 0)
                                <tr>
                                    <td colspan="14" class="text-center bg-danger text-white">
                                        Data Empty!
                                    </td>
                                </tr>
                            @endif

                            @foreach($transaksi as $index => $dataTransaksi)
                                <tr>
                                    <td>{{ $index + $transaksi->firstItem() }}</td>
                                    <td>{{ $dataTransaksi->id_transaksi }}</td>
                                    <td>{{ $dataTransaksi->outlet->nama_outlet }}</td>
                                    <td>{{ $dataTransaksi->kode_invoice }}</td>
                                    <td>{{ $dataTransaksi->member->id_member }} -
                                        {{ $dataTransaksi->member->nama_member }}</td>
                                    <td>{{ $dataTransaksi->tgl }}</td>
                                    <td>{{ $dataTransaksi->batas_waktu }}</td>
                                    <td>{{ $dataTransaksi->tgl_bayar }}</td>
                                    <td>{{ $dataTransaksi->biaya_tambahan }}</td>
                                    <td>{{ $dataTransaksi->diskon }}</td>
                                    <td>{{ $dataTransaksi->pajak }}</td>
                                    <td class="text-dark">{{ $dataTransaksi->status }}</td>
                                    <td class="text-dark">{{ $dataTransaksi->dibayar }}</td>
                                    
                                    <td>

                                        <button class="btn btn-warning btn-sm rounded mb-1" data-toggle="modal"
                                            data-target="#ModalEditTransaksi{{ $index }}">
                                            <i class="fas fa-user-edit"></i>
                                        </button>

                                        <a class="btn btn-primary btn-sm rounded mb-1" href="{{ url('/admin/transaksi/detail-transaksi/' . $dataTransaksi->id_transaksi) }}">
                                            <i class="fa-solid fa-circle-info"></i>
                                        </a>

                                        {{-- <button class="btn btn-danger btn-sm rounded mb-1"
                                        onclick="confirmDelete('{{ url('admin/alumni/delete-alumni/' . $dataTransaksi->id_alumni) }}')"><i
                                            class="fas fa-trash"></i></button> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    Total ada {{ $transaksi->total() }} Data Paket
                    <div class="d-flex justify-content-end">
                        {{ $transaksi->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="form-tambah-transaksi">
    <div class="modal fade" id="ModalTambahTransaksi" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">Form Tambah Transaksi</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ url('admin/transaksi/tambah-transaksi') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <label for="">Nama Outlet*</label>
                                    <select name="id_outlet" class="form-control">
                                        <option value="" selected disabled>Pilih Nama Outlet</option>
                                        @foreach( $dataoutlet as $name )
                                            <option value="{{ $name->id_outlet }}"> {{ $name->nama_outlet }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_outlet')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <label for="">Nama Member*</label>
                                    <select name="id_member" class="form-control">
                                        <option value="" selected disabled>Pilih Nama Member</option>
                                        @foreach( $datamember as $name )
                                            <option value="{{ $name->id_member }}"> {{ $name->nama_member }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_member')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <label for="">Tanggal Penyerahan*</label>
                                    <input type="datetime-local" min="1" class="form-control" name="tgl" placeholder="0">
                                    @error('tgl')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <label for="">Batas Waktu*</label>
                                    <input type="date" min="1" class="form-control" name="batas_waktu" placeholder="0">
                                    @error('batas_waktu')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <label for="">Tanggal Bayar*</label>
                                    <input type="datetime-local" class="form-control" name="tgl_bayar">
                                    @error('tgl_bayar')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <label for="">Biaya Tambahan*</label>
                                    <input type="number" min="0" class="form-control" name="biaya_tambahan"
                                        placeholder="Rp. 0000">
                                    @error('batas_waktu')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <label for="">Diskon %*</label>
                                    <input type="number" min="0" class="form-control" name="diskon"
                                        placeholder="0">
                                    @error('diskon')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <label for="">Pajak*</label>
                                    <input type="number" min="0" class="form-control" name="pajak"
                                        placeholder="Rp. 0000">
                                    @error('pajak')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="row px-3" id="paket">
                                <div class="d-flex justify-content-center px-2">
                                    <span class="badge badge-pills bg-info text-white py-2 my-3 px-3">PAKET</span>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <label for="">Nama Paket*</label>
                                        <select name="id_paket[]" class="form-control">
                                            <option value="" selected disabled>Pilih Nama Paket</option>
                                            @foreach( $datapaket as $name )
                                                <option value="{{ $name->id_paket }}"> {{ $name->nama_paket }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <label for="">QTY</label>
                                        <input type="number" min="1" class="form-control" name="qty[]" placeholder="0">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <label for="">Keterangan</label>
                                        <textarea name="keterangan[]" class="form-control"
                                            placeholder="Masukan Keterangan"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex">
                                <button type="button" id="addPaket" class="btn btn-success mb-2 btn-sm ml-2 shadow">Tambah Paket</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success btn-sm">Simpan Data Transaksi <i
                                    class="fa-solid fa-check"></i></button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</section>


@foreach($transaksi as $index => $a)
    <div class="modal fade" id="ModalEditTransaksi{{ $index }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">Form Edit Transaksi</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/transaksi/edit-transaksi/' . $a->id_transaksi) }}" method="post">
                    @csrf
                    <div class="modal-body">

                        <div class="form-floating mb-3">
                            <label for="" class="badge badge-info">ID Transaksi</label>
                            <input type="text" class="form-control" value="{{ $a->id_transaksi }}" readonly>
                        </div>

                        <div class="form-floating mb-3">
                            <label for="" class="badge badge-secondary">Status</label>
                            <select name="status" class="form-control">
                                <option value="baru" {{ $a->status == 'baru' ? 'selected' : '' }} class="text-secondary" >Baru</option>
                                <option value="proses" {{ $a->status == 'proses' ? 'selected' : '' }} class="text-dark">Proses</option>
                                <option value="selesai" {{ $a->status == 'selesai' ? 'selected' : '' }} class="text-primary">Selesai</option>
                                <option value="diambil" {{ $a->status == 'diambil' ? 'selected' : '' }} class="text-success">Diambil</option>
                            </select>
                        </div>

                        <div class="form-floating mb-3">
                            <label for="" class="badge badge-secondary">Status bayar</label>
                            <select name="dibayar" class="form-control">
                                <option value="dibayar" {{ $a->dibayar == 'dibayar' ? 'selected' : '' }} class="text-success">Dibayar</option>
                                <option value="belum_dibayar" {{ $a->dibayar == 'belum_dibayar' ? 'selected' : '' }} class="text-danger">Belum Dibayar</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-success">Simpan Perubahan <i
                                class="fa-solid fa-check"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

@include('partials.footer')

<script>
function deletePaket(i) {
    $(`.paket-item-${i}`).remove();
}

$( function() {
    let paket = 2;

    $('#addPaket').click( function() {
        $('#paket').append(`
            <div class="col-md-12 paket-item-${paket}">
                <div class="form-floating mb-3">
                    <label for="">
                        Nama Paket*
                        <i class="fas fa-trash-alt ml-2 text-danger" onclick="deletePaket('${paket}')"></i>
                    </label>
                    <select name="id_paket[]" class="form-control">
                        ${ $('[name*=id_paket]').html() }
                    </select>
                </div>
            </div>

            <div class="col-md-12 paket-item-${paket}">
                <div class="form-floating mb-3">
                    <label for="">QTY</label>
                    <input type="number" min="1" class="form-control" name="qty[]" placeholder="0">
                </div>
            </div>

            <div class="col-md-12 paket-item-${paket}">
                <div class="form-floating mb-3">
                    <label for="">Keterangan</label>
                    <textarea name="keterangan[]" class="form-control"
                        placeholder="Masukan Keterangan"></textarea>
                </div>
            </div>
        `);

        paket++;
    });


});
</script>