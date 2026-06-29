<!DOCTYPE html>
<html lang="en">

<head>
    <base href="../../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Multi-purpose admin dashboard template that especially build for programmers.">
    <title>Vehicle &mdash; Detailing Booking System</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <link rel="icon" type="image/x-icon" href="AZIM_LOGO.png">
    <link rel="stylesheet" href="./assets/css/style.css?v1.1.4">
</head>

<style>
    .mb-5 {
        margin-bottom: 0 !important;
    }
    
</style>

<body class="nk-body bodyauth" data-sidebar-collapse="lg" data-navbar-collapse="lg">


    <!-- Root  -->
    <div class="nk-app-root">
        
        <!-- main  -->
        <div class="nk-main">
            
            <div class="nk-wrap align-items-center justify-content-center">

            
                <div class="container p-2 p-sm-4">
                    <div class="wide-xs mx-auto">
                        <div class="text-center mb-5">
                            <div class="brand-logo mb-1">
                                <a href="/loginusr" class="logo-link">
                                <div class="logo-wrap">
                                    <img style="width:250px; height:250px;" class="logo-img logo-light" src="AZIM_LOGO.png" srcset="AZIM_LOGO.png 2x"  alt="">
                                        <img style="width:250px; height:250px;" class="logo-img logo-dark" src="AZIM_LOGO.png" srcset="AZIM_LOGO.png 2x" alt="">
                                        <img style="width:250px; height:250px;" class="logo-img logo-icon" src="AZIM_LOGO.png" srcset="AZIM_LOGO.png 2x" alt="">
                                    </div>
                                </a>
                            </div>
                        
                        </div>
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> 
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong>  {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <div class="card card-gutter-lg rounded-4 card-auth">
                            <div class="card-body">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h3 class="nk-block-title mb-1">Login to Account</h3>
                                        <p class="small">Please sign-in to your account.</p>
                                    </div>
                                </div>



                                <form action="postloginusr" method="POST" autocomplete="off" aria-autocomplete="off">
                                   @csrf
                                    <div class="row gy-3">

                                        <div class="col-sm-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="Customer" name="role" id="flexRadioDefault" checked>
                                                <label class="form-check-label" for="flexRadioDefault"> Customer </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="Staff" name="role" id="flexRadioDefault">
                                                <label class="form-check-label" for="flexRadioDefault"> Staff </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="Admin" name="role" id="flexRadioDefault">
                                                <label class="form-check-label" for="flexRadioDefault"> Admin </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="username" class="form-label">Email</label>
                                                <div class="form-control-wrap">
                                                    <input type="email" class="form-control" name="email" placeholder="Enter Email">
                                                </div>
                                            </div><!-- .form-group -->
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="password" class="form-label">Password</label>
                                                <div class="form-control-wrap">
                                                    <input type="password" class="form-control" name="password" placeholder="Enter Password">
                                                </div>
                                            </div><!-- .form-group -->
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex flex-wrap justify-content-between">
                                                <div class="form-check form-check-sm">
                                                 
                                                </div>
                                                <a href="/forgotpass" class="small">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn btn-primary" type="submit">Login to account</button>
                                            </div>
                                        </div>
                                    </div><!-- .row -->
                                </form>
                                <div class="my-3 text-center">
                                    <h6 class="overline-title overline-title-sep"><span>OR</span></h6>
                                </div>
                                <div class="row g-2">
                                <div class="col-12">
                                            <div class="d-grid">
                                               <a href="/regusr"> <button style="width:100%;" class="btn btn-secondary" type="submit">Register New Account</button> </a>
                                            </div>
                                        </div>
                                </div><!-- .row -->
                            </div><!-- .card-body -->
                        </div><!-- .card -->
                     
                    </div><!-- .col -->
                </div><!-- .container -->
            </div>
        </div> <!-- .nk-main -->
    </div> <!-- .nk-app-root -->
</body>
<!-- JavaScript -->
<script src="./assets/js/bundle.js"></script>
<script src="./assets/js/scripts.js"></script>

</html>