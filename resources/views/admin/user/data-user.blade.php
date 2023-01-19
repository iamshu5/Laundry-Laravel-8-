@include('partials.header', ['title' => 'Data User'])

<section id="table-user">
    <div class="container-fluid">
        <div class="mb-3 d-flex justify-content-end">
            <form class="form-inline d-sm-inline-block">
                <input class="form-control mr-sm-2 btn-sm mx-auto" name="search_user" type="search"
                    placeholder="Cari Data User" aria-label="Search" value="{{ request()->search_user ?? '' }}">
                <button class="btn btn-outline-primary my-2 my-sm-0 btn-sm" type="submit"><i
                        class="fas fa-search"></i></button>
            </form>
        </div> {{-- Form Pencarian --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">TABEL DATA USER</h6>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-info shadow-sm" data-toggle="modal"
                        data-target="#ModalTambahUser">
                        <i class="fas fa-user-plus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">

                @if (session()->exists('alert'))
                    <div class="alert alert-{{ session()->get('alert')['bg'] }} alert-dismissible fade show"
                        role="alert">
                        {{ session()->get('alert')['message'] }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        @foreach ($errors->all() as $error)
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
                                <th>Nama User</th>
                                <th>Posisi</th>
                                <th>Nama Outlet</th>
                                <th>Username</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (count($user) == 0)
                                <tr>
                                    <td colspan="6" class="text-center bg-danger text-white">
                                        Data Empty!
                                    </td>
                                </tr>
                            @endif

                            @foreach ($user as $index => $dataUser)
                                <tr>
                                    <td>{{ $index + $user->firstItem() }}</td>
                                    <td>{{ $dataUser->nama_user }}</td>
                                    <td>{{ $dataUser->posisi }}</td>
                                    <td>{{ $dataUser->outlet->nama_outlet }}</td>
                                    <td>{{ $dataUser->username }}</td>
                                    <td>

                                        <button class="btn btn-warning btn-sm rounded mb-1" data-toggle="modal"
                                            data-target="#ModalEditUser{{ $index }}">
                                            <i class="fas fa-user-edit"></i>
                                        </button>

                                        <button class="btn btn-danger btn-sm rounded mb-1 deleteUser"
                                            data-id-user="{{ $dataUser->id_user }}"
                                            data-nama-user="{{ $dataUser->nama_user }}"><i
                                                class="fas fa-trash"></i></button>
                                        {{-- <button class="btn btn-danger btn-sm rounded mb-1"
                                        onclick="confirmDelete('{{ url('admin/alumni/delete-alumni/' . $dataUser->id_alumni) }}')"><i
                                            class="fas fa-trash"></i></button> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    Total ada {{ $user->total() }} Data user
                    <div class="d-flex justify-content-end">
                        {{ $user->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="form-tambah-user">
    <div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">Form Tambah User</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ url('admin/user/tambah-user') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <label for="" class="badge badge-warning shadow">Username*</label>
                                    <input type="text" class="form-control" name="username" placeholder="Username">
                                    @error('username')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <label for="" class="badge badge-danger shadow">Password*</label>
                                    <input type="text" class="form-control" name="password" placeholder="Password">
                                    @error('password')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <label for="" class="badge badge-primary shadow">Nama User*</label>
                                    <input type="text" class="form-control" name="nama_user" placeholder="Nama User">
                                    @error('nama_user')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <label for="" class="badge badge-secondary shadow">Nama Outlet*</label>
                                    <select name="id_outlet" class="form-control">
                                        <option value="" selected disabled>Pilih Nama Outlet</option>
                                        @foreach ($dataoutlet as $name)
                                            <option value="{{ $name->id_outlet }}"> {{ $name->nama_outlet }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_outlet')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <label for="" class="badge badge-dark shadow">Posisi*</label>
                                    <select name="posisi" class="form-control">
                                        <option value="" selected disabled>Pilih Jabatan</option>
                                        <option value="admin">Admin</option>
                                        <option value="kasir">Kasir</option>
                                        <option value="owner">Owner</option>
                                    </select>
                                    @error('posisi')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-sm">Simpan Data User <i
                                class="fa-solid fa-check"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@foreach ($user as $index => $dataUser)
    <div class="modal fade" id="ModalEditUser{{ $index }}" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">Form Edit User</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/user/edit-user/' . $dataUser->id_user) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <label for="" class="badge badge-info">ID User</label>
                                    <input type="text" class="form-control" value="{{ $dataUser->id_user }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <label for="" class="badge badge-primary">Nama User</label>
                                    <input type="text" class="form-control" name="nama_user"
                                        placeholder="Ubah Nama User" value="{{ $dataUser->nama_user }}" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <label for="" class="badge badge-warning">Username</label>
                                    <input value="{{ $dataUser->username }}" type="text" name="username"
                                        class="form-control" required></input>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <label for="" class="badge badge-danger">Password</label>
                                    <input type="text" name="password" class="form-control"
                                        placeholder="Password"></input>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <label for="" class="badge badge-secondary">Nama Outlet</label>
                                    <select name="id_outlet" class="form-control">
                                        @foreach ($dataoutlet as $name)
                                            <option value="{{ $name->id_outlet }}"
                                                {{ $name->id_outlet == $dataUser->id_outlet ? 'selected' : '' }}>
                                                {{ $name->nama_outlet }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <label for="" class="badge badge-dark shadow">Posisi</label>
                                    <select name="posisi" class="form-control">
                                        <option value="admin" {{ $dataUser->posisi == 'admin' ? 'selected' : '' }}>
                                            Admin</option>
                                        <option value="kasir" {{ $dataUser->posisi == 'kasir' ? 'selected' : '' }}>
                                            Kasir</option>
                                        <option value="owner" {{ $dataUser->posisi == 'owner' ? 'selected' : '' }}>
                                            Owner</option>
                                    </select>
                                </div>
                            </div>

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
