<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"--}}
          {{--integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">--}}

    <link rel="stylesheet" href="{{asset('vendor/bootstrap/bootstrap4.min.css')}}" />
    <style>
        body{
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
<div style="background-color: #841919;">
    <div class="container">
        <div class="row">
            <div style="padding: 5px">
                <a href="{{url("/")}}"><img class="logo2" src="{{asset('image/hust_logo.jpg')}}" alt="" width="75px" height="100px"></a>
                <img class="logo3" src="{{asset('image/soict.png')}}">
            </div>
        </div>
    </div>
</div>



@yield('content')

@include('.footer')

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Login</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form id="formLogin" class="form-horizontal" role="form" method="POST"
                      action="{{ url('student/login') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Username</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="code">
                            <small class="help-block"></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password">
                            <small class="help-block"></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/popper.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/bootstrap.min.js') }}"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"--}}
        {{--integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"--}}
        {{--crossorigin="anonymous"></script>--}}
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"--}}
        {{--integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"--}}
        {{--crossorigin="anonymous"></script>--}}
<script>
    $(function () {
        $('#login').click(function () {
            $('#myModal').modal();
        });
        $(document).on('submit', '#formLogin', function (e) {
            e.preventDefault();
            $('input+small').text('');
            $('input').parent().removeClass('has-error');
            $.ajax({
                method: $(this).attr('method'),
                url: $(this).attr('action'),
                data: getFormData($(this)),
                dataType: "json"
            })
                .done(function (data) {
                    console.log(data);
                    $('.alert-success').removeClass('hidden');
                    $('#myModal').modal('hide');
                })
                .fail(function (data) {
                    $.each(data.responseJSON, function (key, value) {
                        var input = '#formLogin input[name=' + key + ']';
                        $(input + '+small').text(value);
                        $(input).parent().addClass('has-error');
                    });
                });
        });

    });

    function getFormData($form) {
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};

        $.map(unindexed_array, function (n, i) {
            indexed_array[n['name']] = n['value'];
        });

        return indexed_array;
    }

</script>
</body>
</html>
