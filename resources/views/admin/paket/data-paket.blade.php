@include('partials.header', ['title' => 'Data Paket'])

<section id="table-paket">
    <div class="container-fluid">
        <div class="mb-3 d-flex justify-content-end">
            <form class="form-inline d-sm-inline-block">
                <input class="form-control mr-sm-2 btn-sm mx-auto" name="search_paket" type="search"
                    placeholder="Cari Data Paket" aria-label="Search"
                    value="{{ request()->search_paket ?? '' }}">
                <button class="btn btn-outline-primary my-2 my-sm-0 btn-sm" type="submit"><i
                        class="fas fa-search"></i></button>
            </form>
        </div> {{-- Form Pencarian --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">TABEL DATA PAKET</h6>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-info shadow-sm" data-toggle="modal"
                        data-target="#ModalTambahPaket">
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
                                <th>Nama Paket</th>
                                <th>(ID) Nama Outlet</th>
                                <th>Jenis</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(count($paket) == 0)
                                <tr>
                                    <td colspan="6" class="text-center bg-danger text-white">
                                        Data Empty!
                                    </td>
                                </tr>
                            @endif

                            @foreach($paket as $index => $dataPaket)
                                <tr>
                                    <td>{{ $index + $paket->firstItem() }}</td>
                                    <td>{{ $dataPaket->nama_paket }}</td>
                                    <td>{{ $dataPaket->outlet->id_outlet }} - {{ $dataPaket->outlet->nama_outlet }}</td>
                                    <td>{{ $dataPaket->jenis }}</td>
                                    <td>{{ $dataPaket->harga }}</td>
                                    <td>

                                        <button class="btn btn-warning btn-sm rounded mb-1" data-toggle="modal"
                                            data-target="#ModalEditPaket{{ $index }}">
                                            <i class="fas fa-user-edit"></i>
                                        </button>

                                        <button class="btn btn-danger btn-sm rounded mb-1 deletePaket"
                                            data-id-paket="{{ $dataPaket->id_paket }}"
                                            data-nama-paket="{{ $dataPaket->nama_paket }}"><i
                                                class="fas fa-trash"></i></button>
                                        {{-- <button class="btn btn-danger btn-sm rounded mb-1"
                                        onclick="confirmDelete('{{ url('admin/alumni/delete-alumni/' . $dataPaket->id_alumni) }}')"><i
                                            class="fas fa-trash"></i></button> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    Total ada {{ $paket->total() }} Data Paket
                    <div class="d-flex justify-content-end">
                        {{ $paket->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="form-tambah-paket">
    <div class="modal fade" id="ModalTambahPaket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">Form Tambah Paket</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ url('admin/paket/tambah-paket') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="form-floating mb-3">
                            <label for="" class="badge badge-primary">Nama Paket*</label>
                            <input type="text" class="form-control" name="nama_paket" placeholder="Nama Paket">
                            @error('nama_paket')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <label for="" class="badge badge-dark">Nama Outlet*</label>
                            <select name="id_outlet" class="form-control">
                                <option value="" selected disabled>Pilih Nama Outlet</option>
                                @foreach ( $dataoutlet as $name )
                                    <option value="{{ $name->id_outlet }}"> {{ $name->nama_outlet }} </option>
                                @endforeach
                            </select>
                            @error('id_outlet')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <label for="" class="badge badge-info">Jenis*</label>
                            <select name="jenis" class="form-control">
                                <option value="" selected disabled>Pilih Jenis Paket</option>
                                <option value="kiloan" >Kiloan</option>
                                <option value="selimut">Selimut</option>
                                <option value="bed_cover">Bed Cover</option>
                                <option value="kaos">Kaos</option>
                                <option value="lain">Dan Lain-Lain</option>
                            </select>
                            @error('jenis')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <label for="" class="badge badge-warning">Harga*</label>
                            <input type="number" min="5000" class="form-control" name="harga" placeholder="Harga Paket">
                            @error('harga')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-sm">Simpan Data Paket <i
                                class="fa-solid fa-check"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@foreach($paket as $index => $dataPaket)
    <div class="modal fade" id="ModalEditPaket{{ $index }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">Form Edit Paket</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/paket/edit-paket/' . $dataPaket->id_paket) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <label for="" class="badge badge-info">ID Paket</label>
                            <input type="text" class="form-control" value="{{ $dataPaket->id_paket }}" readonly>
                        </div>

                        <div class="form-floating mb-3">
                            <label for="" class="badge badge-primary">Nama Outlet</label>
                            <select name="id_outlet" class="form-control">
                                @foreach ($dataoutlet as $name )
                                    <option value="{{ $name->id_outlet }}" {{ $name->id_outlet == $dataPaket->id_outlet ? 'selected' : '' }}> {{ $name->nama_outlet }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-floating mb-3">
                            <label for="" class="badge badge-secondary">Jenis</label>
                            <select name="jenis" class="form-control">
                                <option value="kiloan" {{ $dataPaket->jenis == 'kiloan' ? 'selected' : '' }}>Kiloan</option>
                                <option value="selimut" {{ $dataPaket->jenis == 'selimut' ? 'selected' : '' }}>selimut</option>
                                <option value="bed_cover" {{ $dataPaket->jenis == 'bed_cover' ? 'selected' : '' }}>Bed Cover</option>
                                <option value="kaos" {{ $dataPaket->jenis == 'kaos' ? 'selected' : '' }}>Kaos</option>
                                <option value="lain" {{ $dataPaket->jenis == 'lain' ? 'selected' : '' }}>Dll.</option>
                            </select>
                        </div>

                        <div class="form-floating mb-3">
                            <label for="" class="badge badge-dark">Nama Paket</label>
                            <input type="text" name="nama_paket" class="form-control" value="{{ $dataPaket->nama_paket }}" required>
                        </div>

                        <div class="form-floating mb-3">
                            <label for="" class="badge badge-warning">Harga</label>
                            <input type="number" name="harga" min="1000" class="form-control" value="{{ $dataPaket->harga }}" required>
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
