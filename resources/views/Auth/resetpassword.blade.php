<!DOCTYPE html>
<html lang="en">

<head>
    <base href="../../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Multi-purpose admin dashboard template that especially build for programmers.">
    <title>Reset Password - Vehicle &mdash; Detailing Booking System</title>
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
                            <div class="logo-wrap">
                                    <img style="width:250px; height:250px;" class="logo-img logo-light" src="AZIM_LOGO.png" srcset="AZIM_LOGO.png 2x"  alt="">
                                        <img style="width:250px; height:250px;" class="logo-img logo-dark" src="AZIM_LOGO.png" srcset="AZIM_LOGO.png 2x" alt="">
                                        <img style="width:250px; height:250px;" class="logo-img logo-icon" src="AZIM_LOGO.png" srcset="AZIM_LOGO.png 2x" alt="">
                                    </div>
                            </div>
                        </div>
                        <div class="card card-gutter-lg rounded-4 card-auth">
                            <div class="card-body">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h3 class="nk-block-title mb-2">Reset password</h3>
                                        <p class="small">Enter your new password to reset your password</p>
                                    </div>
                                </div>
								<form action="/updatepassword" method="POST" autocomplete="off" aria-autocomplete="off">
                                            @csrf

											<input type="hidden" name="id" value="{{ $user->id }}">

                                    <div class="row gy-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="email-address" class="form-label">Email</label>
                                                <div class="form-control-wrap">
                                                    <input type="email" class="form-control" id="email-address" name="email" value="{{ $user->email }}" placeholder="Enter email address" readonly>
                                                </div>
                                            </div><!-- .form-group -->
                                        </div>

										<div class="col-12">
                                            <div class="form-group">
                                                <label for="email-address" class="form-label">Password</label>
                                                <div class="form-control-wrap">
<input type="password" class="form-control" id="password" name="password" placeholder="Enter New Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*#?&]).{10,32}" title="Your password must be between 10 - 32 characters long and include uppercase letter (A-Z), lowercase letter (a-z), number (0-9) and special characters such as @$!%*#?&" required>
                                                </div>
                                            </div><!-- .form-group -->
                                        </div>

										<div class="col-12">
                                            <div class="form-group">
                                                <label for="email-address" class="form-label">Confirm Password</label>
                                                <div class="form-control-wrap">
												<input type="password" class="form-control" id="repassword" name="repassword" placeholder="Re Enter New Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*#?&]).{10,32}" title="Your password must be between 10 - 32 characters long and include uppercase letter (A-Z), lowercase letter (a-z), number (0-9) and special characters such as @$!%*#?&" required>
                                                </div>
                                            </div><!-- .form-group -->
                                        </div>


                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn btn-primary" type="submit">Submit</button>
                                            </div>
                                        </div>
                                    </div><!-- .row -->
                                </form>
                            </div><!-- .card-body -->
                        </div><!-- .card -->
                        <div class="text-center mt-5">
                            <p class="small"><a href="/">Back to Login</a></p>
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