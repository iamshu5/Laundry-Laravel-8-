<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page | LaundryLarv </title>
    <link rel="icon" type="image/x-icon" href="{{ url('assets/admin/img/logo-laundry.png') }}">
    <link rel="stylesheet" href="{{ url('assets/admin/js/7fdd60d3a4.js') }}">
    <link href="{{ url('assets/admin/vendor/fontawesome-free/css/all.min.css') }}"
        rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- CSS Sb Admin-->
    <link href="{{ url('assets/admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body class="bg-info">
    <section id="login">
        <div class="container">
            @if(session()->exists('alert'))
                <div class="mt-5 alert alert-{{ session()->get('alert') ['bg'] }} alert-dismissible fade show"
                    role="alert">
                    {{ session()->get('alert') ['message'] }}
                </div>
            @endif
            <div class="row justify-content-center">
                <div class="row justify-content-center">
                    <div class="col-xl-9 col-lg-9 col-md-9">
                        <div class="card o-hidden my-5 bg-info">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3 d-none d-lg-block">
                                        <img src="{{ url('assets/admin/img/logo-laundry.png') }}"
                                            widht="1080px" height="510px" class="rounded-5">
                                    </div>

                                    <div class="col-lg-6 mt-5">
                                        <div class="p-6">
                                            <form method="POST">
                                                @csrf
                                                <div class="form-group text-white">
                                                    <label for="">Username</label>
                                                    <input type="text" class="form-control" placeholder="Username" name="username" required>
                                                </div>

                                                <div class="form-group text-white">
                                                    <label for="">Password</label>
                                                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="" class="text-white">Login Sebagai</label>
                                                    <select name="login_sebagai" id="login_sebagai" class="form-control" required>
                                                        <option selected disabled>Login Sebagai</option>
                                                        <option value="admin">Admin</option>
                                                        <option value="kasir">Kasir</option>
                                                        <option value="owner">Owner</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="" class="text-white">Pilih Outlet</label>
                                                    <select name="id_outlet" class="form-control">
                                                        <option value="" selected disabled>Pilih Outlet</option>
                                                        @foreach ($dataoutlet as $o )
                                                            <option value="{{ $o->id_outlet }}"> {{ $o->nama_outlet }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="d-flex justify-content-end">
                                                    <button class="btn btn-success shadow-lg" type="submit"
                                                        name="login">Login</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
