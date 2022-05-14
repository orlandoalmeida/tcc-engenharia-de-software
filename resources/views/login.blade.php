<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <title>Login - {{env('APP_NAME')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="MyraStudio" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- App css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/theme.min.css')}}" rel="stylesheet" type="text/css" />
</head>

<body>
 
    <div>
        <div class="container">
            <div class="row">
                <div class="col-6 offset-3">
                    <div class="d-flex align-items-center min-vh-100">
                        <div class="w-100 d-block bg-white shadow-lg rounded my-5">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div class="text-center mb-5">
                                            <a href="{{route('dashboard')}}" class="text-dark font-size-22 font-family-secondary">
                                                <i class="mdi mdi-alpha-h-circle"></i> <b>ERP - TCCII 2022</b>
                                            </a>
                                        </div>
                                        <h1 class="h5 mb-1">Bem vindo de volta</h1>
                                        <p class="text-muted mb-4">Digite seu e-mail e senha para ter acesso ao painel administrativo.</p>
                                        <form class="user" method="POST" action="{{route('entrar')}}">
                                            <div class="form-group">
                                                <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required>
                                            </div>
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-block waves-effect waves-light"> Entrar </button>      
                                        </form>

                                        <!-- end row -->
                                    </div> <!-- end .padding-5 -->
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                        </div> <!-- end .w-100 -->
                    </div> <!-- end .d-flex -->
                </div> <!-- end col-->
            </div> <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!-- jQuery  -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/metismenu.min.js')}}"></script>
    <script src="{{asset('assets/js/waves.js')}}"></script>
    <script src="{{asset('assets/js/simplebar.min.js')}}"></script>
    <!-- App js -->
    <script src="{{asset('assets/js/theme.js')}}"></script>
</body>
</html>