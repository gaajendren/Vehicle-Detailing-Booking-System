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
    <link rel="stylesheet" href="./assets/css/style.css?v1.1.3">
</head>

<style>
    .mb-5 {
        margin-bottom: 0 !important;
    }

    .wide-xs {
    max-width: 680px !important; 
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
<div class="container">
<div class="row gy-3">
                                        <div class="col-12">
            <div class="card">
                <div class="card-header">2FA Verification</div>
  
                <div class="card-body">
                    <form method="POST" action="{{ route('2fa.post') }}">
                        @csrf
                        @if(auth()->user())
                        <p class="text-center">We sent code to email : {{ substr(auth()->user()->email, 0, 5) . '******' . substr(auth()->user()->email,  -2) }}</p>
                        @else
                        <p class="text-center">User not authenticated .</p>
                        @endif
                        @if($message = Session::get('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Whoops !</strong>  {{ session()->get('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong>  {{ session()->get('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
  
                        <div class="form-group row">
                            <label for="code" class="col-md-4 col-form-label text-md-right">Code</label>
  
                            <div class="col-md-6">
                                <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required autocomplete="code" autofocus>
  
                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
  
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <a class="btn btn-link" href="{{ route('2fa.resend') }}">Resend Code?</a>
                            </div>
                        </div>
  
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                                <a type="button" href="{{ route('signout') }}" class="btn btn-danger">
                                    Cancel
</a>

                                
  
                            </div>
                        </div>
                    </form>

                    <form id="logout-form" action="{{ route('signout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
