
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CMS-NẠP THẺ | Đăng nhập</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('backend/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('backend/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('backend/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('backend/dist/css/AdminLTE.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('backend/plugins/iCheck/square/blue.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html"><b class="text-success">CMS</b><b>-</b><b class="text-danger">NẠP THẺ</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        @if($errors->any())
        <p class="text-center text-danger"><strong>
                    {{$errors->first()}}</strong></p>
        @else
        <p class="login-box-msg">Đăng nhập vào hệ thống nạp thẻ</p>
        @endif
        <form action="{{URL::route('auth.post-login')}}" method="post">
            {{csrf_field()}}
            <div class="form-group has-feedback {{($errors->has('phone'))?"has-error":""}}">
                <input type="text" class="form-control" name="phone" value="{{old('phone')}}" placeholder="Số điện thoại">
                <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                <p class="text-danger">{{$errors->first('phone')}}</p>
            </div>
            <div class="form-group has-feedback {{($errors->has('password'))?"has-error":""}}">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <p class="text-danger">{{$errors->first('password')}}</p>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Ghi nhớ
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Đăng nhập</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <!-- /.social-auth-links -->

        <a href="" data-toggle="modal" data-target="#forgetModal">Quên mật khẩu</a><br>

    </div>
    <!-- /.login-box-body -->
</div>
<div id="forgetModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <form action="{{URL::route('auth.forget')}}" method="post" id="form-forget">
            {{csrf_field()}}
        <div class="modal-content" style="width: 70%;margin: 0 auto;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">QUÊN MẬT KHẨU</h4>
            </div>
            <div class="modal-body">
                <div class="form-group has-feedback " id="error-class">
                    <input type="email" id="forget-mail" name="email" class="form-control" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <p class="text-danger" id="show-error"></p>
                <p id="forget-info">Để đặt lại mật khẩu của mình, hãy nhập địa chỉ email mà bạn sử dụng để đăng nhập vào hệ thống.</p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="send-email"><i class="fa fa-send-o"></i> GỬI</button>
            </div>
        </div>
        </form>>

    </div>
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{asset('backend/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('backend/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('backend/plugins/iCheck/icheck.min.js')}}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });


        //send email
        $(document).on('click', '#send-email', function () {


        })
        $('#form-forget').submit(function (e) {

            e.preventDefault();
            var mail = $('#forget-mail').val();
            if(mail=='') {
                $('#show-error').html('Bạn chưa nhập email');
                $('#error-class').addClass('has-error');
                $('#forget-info').hide();
                return;
            } else {
                $.ajax({
                    type: $('#form-forget').attr('method'),
                    url: $('#form-forget').attr('action'),
                    data: $('#form-forget').serialize(),
                    success: function (data) {
                        console.log('Submission was successful.');
                        console.log(data);
                    },
                    error: function (data) {
                        console.log('An error occurred.');
                        console.log(data);
                    },
                });
            }
        });
    });

</script>
</body>
</html>
