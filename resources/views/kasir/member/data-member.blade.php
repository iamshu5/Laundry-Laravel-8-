@include('partials.header', ['title' => 'Data Member'])

<section id="table-member">
    <div class="container-fluid">
        <div class="mb-3 d-flex justify-content-end">
            <form class="form-inline d-sm-inline-block">
                <input class="form-control mr-sm-2 btn-sm mx-auto" name="search_member" type="search"
                    placeholder="Cari Data Member" aria-label="Search"
                    value="{{ request()->search_member ?? '' }}">
                <button class="btn btn-outline-primary my-2 my-sm-0 btn-sm" type="submit"><i
                        class="fas fa-search"></i></button>
            </form>
        </div> {{-- Form Pencarian --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">TABEL DATA MEMBER</h6>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-info shadow-sm" data-toggle="modal"
                        data-target="#ModalTambahMember">
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
                                <th>ID Member</th>
                                <th>Nama Member</th>
                                <th>Alamat</th>
                                <th>Jenis Kelamin</th>
                                <th>Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(count($member) == 0)
                                <tr>
                                    <td colspan="6" class="text-center bg-danger text-white">
                                        Data Empty!
                                    </td>
                                </tr>
                            @endif

                            @foreach($member as $index => $dataMember)
                                <tr>
                                    <td>{{ $index + $member->firstItem() }}</td>
                                    <td>{{ $dataMember->id_member }}</td>
                                    <td>{{ $dataMember->nama_member }}</td>
                                    <td>{{ $dataMember->alamat }}</td>
                                    <td>{{ $dataMember->jenis_kelamin }}</td>
                                    <td>{{ $dataMember->telp }}</td>
                                    <td>

                                        <button class="btn btn-warning btn-sm rounded mb-1" data-toggle="modal"
                                            data-target="#ModalEditMember{{ $index }}">
                                            <i class="fas fa-user-edit"></i>
                                        </button>

                                        <button class="btn btn-danger btn-sm rounded mb-1 deleteMember"
                                            data-id-member="{{ $dataMember->id_member }}"
                                            data-nama-member="{{ $dataMember->nama_member }}"><i
                                                class="fas fa-trash"></i></button>
                                        {{-- <button class="btn btn-danger btn-sm rounded mb-1"
                                        onclick="confirmDelete('{{ url('admin/alumni/delete-alumni/' . $dataMember->id_alumni) }}')"><i
                                            class="fas fa-trash"></i></button> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    Total ada {{ $member->total() }} Data Member
                    <div class="d-flex justify-content-end">
                        {{ $member->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="form-tambah-member">
    <div class="modal fade" id="ModalTambahMember" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">Form Tambah Member</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ url('admin/member/tambah-member') }}"
                    enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <label for="">Nama Member*</label>
                            <input type="text" class="form-control" name="nama_member" placeholder="Input Nama Member">
                            @error('nama_member')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <label for="">Alamat*</label>
                            <textarea class="form-control" name="alamat" placeholder="Alamat"></textarea>
                            @error('alamat')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <label for="">Jenis Kelamin*</label>
                            <select name="jenis_kelamin" class="form-control">
                                <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <label for="">Telepon*</label>
                            <input type="text" class="form-control" name="telp" placeholder="08xxx (WA)">
                            @error('telp')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-sm">Simpan Data Member <i
                                class="fa-solid fa-check"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@foreach($member as $index => $dataMember)
    <div class="modal fade" id="ModalEditMember{{ $index }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">Form Edit Member</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form
                    action="{{ url('admin/member/edit-member/' . $dataMember->id_member) }}"
                    method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <label for="">ID Member</label>
                            <input type="text" class="form-control" value="{{ $dataMember->id_member }}" readonly>
                        </div>

                        <div class="form-floating mb-3">
                            <label for="">Nama Member</label>
                            <input type="text" class="form-control" name="nama_member" placeholder="Ubah Nama Outlet"
                                value="{{ $dataMember->nama_member }}" required>
                        </div>

                        <div class="form-floating mb-3">
                            <label for="">Alamat</label>
                            <textarea name="alamat" class="form-control" required>{{ $dataMember->alamat }}</textarea>
                        </div>

                        <div class="form-floating mb-3">
                            <label for="">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control" required>
                                <option value="Laki-Laki" {{ $dataMember->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="Perempuan" {{ $dataMember->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <div class="form-floating mb-3">
                            <label for="">Telepon</label>
                            <input type="text" class="form-control" name="telp" placeholder="Ubah Nomor Telepon"
                                value="{{ $dataMember->telp }}" required>
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
