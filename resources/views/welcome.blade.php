<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ url('assets/admin/img/logo-laundry.png') }}">
    <title>LaundryShu</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('assets/bootstrap.min.css') }}">


</head>

<body>
    <div class="container pt-3">
        <nav class="navbar navbar-expand-lg navbar-light ">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ url('assets/admin/img/logo-laundry.png') }}" width="25" height="30"
                    class="d-inline-block align-top" alt="">
                LaundryShu
            </a>
        </nav>

        <div class="row justify-content-center pt-5">
            <div class="col">
                <div class="card shadow">
                    <div class="card-body">
                        <img src="{{ url('assets/admin/img/logo-laundry.png') }}" width="250"
                            height="250" alt="">
                        <strong>LAUNDRYSHU</strong>

                        <h4 class="badge badge-pill shadow text-white bg-info mt-2 mx-5 my-4">I wish you wash here gess :D </h4>

                        <div class="d-flex justify-content-end">
                            <a href="{{ url('/login') }}"
                                class="btn btn-success shadow mt-3">LOGIN</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
