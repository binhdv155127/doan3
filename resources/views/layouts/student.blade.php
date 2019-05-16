<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">--}}

    <link rel="stylesheet" href="{{asset('vendor/bootstrap/bootstrap4.min.css')}}" />

    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">

    <style>
        body {
            /*font-family: 'Helvetica, Arial, sans-serif';*/
        }

        .btn-login-main-style {
            background: white;
            border: 1px solid #d9241b;
            color: #d9241b;
            padding: 4px 12px;
            text-transform: uppercase;
            margin-left: 3px;
        }

        .first-header-panel {
            display: flex;
            justify-content: space-between;
            padding: 15px 0px;

        }

    </style>

</head>
<body>
<div class="header-panel clearfix">
    <div class="container">
        <div class="row first-header-panel">
            <div class="col-md-8">
                <a href="{{url("/student/home")}}">
                    <img src="http://storage.googleapis.com/hust-edu.appspot.com/images/347519313-1553408625211-logo_hust.png"
                         width="55px" class="img-responsive" alt="Responsive image" align="left">
                </a>
                <p>HỆ THỐNG QUẢN LÝ GIẢNG DẠY, ĐỒ ÁN VÀ DỊCH VỤ TRỰC TUYẾN</p>
                <p>ĐẠI HỌC BÁCH KHOA HÀ NỘI</p>

            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href={{ '/student/home' }}>ĐỒ ÁN <span class="sr-only">(current)</span></a>
                </li>


            </ul>
            <div class="form-inline my-2 my-lg-0">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            {{ auth()->guard('student')->user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('student.logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('student.logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

@yield('content')


{{--@include('.footer')--}}
<!-- Menu Toggle Script -->

<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>--}}
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>--}}

<script src="{{ asset('vendor/bootstrap/popper.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/bootstrap.min.js') }}"></script>

<script>
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>

</body>
</html>