@include('partials.header', ['title' => 'Data Outlet'])

<section id="table-outlet">
    <div class="container-fluid">
        <div class="mb-3 d-flex justify-content-end">
            <form class="form-inline d-sm-inline-block">
                <input class="form-control mr-sm-2 btn-sm mx-auto" name="search_outlet" type="search"
                    placeholder="Cari Data Outlet" aria-label="Search"
                    value="{{ request()->search_outlet ?? '' }}">
                <button class="btn btn-outline-primary my-2 my-sm-0 btn-sm" type="submit"><i
                        class="fas fa-search"></i></button>
            </form>
        </div> {{-- Form Pencarian --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">TABEL DATA OUTLET</h6>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-info shadow-sm" data-toggle="modal"
                        data-target="#ModalTambahOutlet">
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
                                <th>Id Outlet</th>
                                <th>Nama Outlet</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(count($outlet) == 0)
                                <tr>
                                    <td colspan="6" class="text-center bg-danger text-white">
                                        Data Empty!
                                    </td>
                                </tr>
                            @endif

                            @foreach($outlet as $index => $dataOutlet)
                                <tr>
                                    <td>{{ $index + $outlet->firstItem() }}</td>
                                    <td>{{ $dataOutlet->id_outlet }}</td>
                                    <td>{{ $dataOutlet->nama_outlet }}</td>
                                    <td>{{ $dataOutlet->telp }}</td>
                                    <td>{{ $dataOutlet->alamat }}</td>
                                    <td>

                                        <button class="btn btn-warning btn-sm rounded mb-1" data-toggle="modal"
                                            data-target="#ModalEditOutlet{{ $index }}">
                                            <i class="fas fa-user-edit"></i>
                                        </button>

                                        <button class="btn btn-danger btn-sm rounded mb-1 deleteOutlet"
                                            data-id-outlet="{{ $dataOutlet->id_outlet }}"
                                            data-nama-outlet="{{ $dataOutlet->nama_outlet }}"><i
                                                class="fas fa-trash"></i></button>
                                        {{-- <button class="btn btn-danger btn-sm rounded mb-1"
                                        onclick="confirmDelete('{{ url('admin/alumni/delete-alumni/' . $dataOutlet->id_alumni) }}')"><i
                                            class="fas fa-trash"></i></button> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    Total ada {{ $outlet->total() }} Data Outlet
                    <div class="d-flex justify-content-end">
                        {{ $outlet->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="form-tambah-outlet">
    <div class="modal fade" id="ModalTambahOutlet" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">Form Tambah Outlet</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ url('admin/outlet/tambah-outlet') }}"
                    enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <label for="" class="badge badge-primary">Nama Outlet*</label>
                            <input type="text" class="form-control" name="nama_outlet" placeholder="Input Nama Outlet">
                            @error('nama_outlet')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <label for="" class="badge badge-secondary">Telepon*</label>
                            <input type="text" class="form-control" name="telp" placeholder="08xxx (WA)">
                            @error('telp')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-floating mb-3">
                            <label for="" class="badge badge-success">Alamat*</label>
                            <textarea class="form-control" name="alamat" placeholder="Alamat"></textarea>
                            @error('alamat')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-sm">Simpan Data Outlet <i
                                class="fa-solid fa-check"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@foreach($outlet as $index => $dataOutlet)
    <div class="modal fade" id="ModalEditOutlet{{ $index }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">Form Edit Outlet</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form
                    action="{{ url('admin/outlet/edit-outlet/' . $dataOutlet->id_outlet) }}"
                    method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <label for="" class="badge badge-info">ID Outlet</label>
                            <input type="text" class="form-control" value="{{ $dataOutlet->id_outlet }}" readonly>
                        </div>

                        <div class="form-floating mb-3">
                            <label for="" class="badge badge-primary">Nama Outlet</label>
                            <input type="text" class="form-control" name="nama_outlet" placeholder="Ubah Nama Outlet"
                                value="{{ $dataOutlet->nama_outlet }}" required>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <label for="" class="badge badge-secondary">Telepon</label>
                            <input type="text" class="form-control" name="telp" placeholder="Ubah Nomor Telepon"
                                value="{{ $dataOutlet->telp }}" required>
                        </div>

                        <div class="form-floating mb-3">
                            <label for="" class="badge badge-success">Alamat</label>
                            <textarea name="alamat" class="form-control" required>{{ $dataOutlet->alamat }}</textarea>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan Perubahan <i
                                class="fa-solid fa-check"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

@include('partials.footer')

