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
    <link rel="stylesheet" href="./assets/css/style.css?v1.1.2">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<style>
    .mb-5 {
        margin-bottom: 0 !important;
    }

    label{
        padding-top: 20px;
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
                        @if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{!! $error !!}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif


@if($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong>  {{ session()->get('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
                        <div class="card card-gutter-lg rounded-4 card-auth">
                            <div class="card-body">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h3 class="nk-block-title mb-1">Create New Account</h3>
                                        <p class="small">Use your email to continue with Booking System !</p>
                                    </div>
                                </div>




                         
                                    <div class="row gy-3">
                                    <form id="my-form" action="regusr" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-sm-12">
                                            <div class="form-group">   
                                                <p style="color:red">
                                                    No need to upload license (demo mode).  
                                                    You can continue without uploading a licence.
                                                </p>

                                                <p>
                                                    If you want to register without a licence,  
                                                    <a  href="regusrwi">click here to register</a>.
                                                </p> 
                                                <label for="licence_file" class="form-label">Upload Driving Licence Image</label>    
                                                
                                                <div class="form-control-wrap">        
                                                    <input class="form-control" type="file" id="licence_file" name="licence_file">   
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    </div>

                                    <div class="row gy-3">
                                    <form action="postregisterusr" method="POST" autocomplete="off" aria-autocomplete="off">
                                            @csrf
                                    <hr>
                                    @if($licencefile != '')
                                    
                                    <div class="col-12">
                                            <div class="form-group">
                                                <label for="licence_file" class="form-label">Licence File</label>
                                                <div class="form-control-wrap">
                                                 <image src="uploads/{{$licencefile}}" style="width:auto; height:150px;"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="fullname" class="form-label">Fullname</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Enter Fullname" value="{{$name}}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="ic" class="form-label">IC Number</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="mykad" id="mykad" placeholder="Enter IC" value="{{$ic}}"  required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="email" class="form-label">Email</label>
                                                <div class="form-control-wrap">
                                                    <input type="email" class="form-control" name="email" placeholder="Enter Email Address" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="phone" class="form-label">Phone</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone Number" required>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="phone" class="form-label">Licence Validity</label>
                                                <div class="form-control-wrap">
                                                    <input type="date" class="form-control" name="licence_validity" id="licence_validity" value="{{$validity}}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="phone" class="form-label">Address <sup style="color:blue;">Booking only available for Klang Valley area</sup></label>
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control" name="address" id="address" placeholder="Enter Address" maxlength="500" required>{{$address}}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="password" class="form-label">Password</label>
                                                <div class="form-control-wrap">
                                                    <input type="password" class="form-control" name="password" placeholder="Enter Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*#?&]).{10,32}" title="Your password must be between 10 - 32 characters long and include uppercase letter (A-Z), lowercase letter (a-z), number (0-9) and special characters such as @$!%*#?&" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="cpassword" class="form-label">Confirm Password</label>
                                                <div class="form-control-wrap">
                                                    <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*#?&]).{10,32}" title="Your password must be between 10 - 32 characters long and include uppercase letter (A-Z), lowercase letter (a-z), number (0-9) and special characters such as @$!%*#?&" required>
                                                </div>
                                            </div>
                                        </div>
            <br>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn btn-primary" type="submit">Register</button>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </form>
                                <div class="my-3 text-center">
                                    <h6 class="overline-title overline-title-sep"><span>OR</span></h6>
                                </div>
                                <div class="row g-2">
                                <div class="col-12">
                                            <div class="d-grid">
                                               <a href="/"> <button style="width:100%;" class="btn btn-secondary" type="submit">Login</button></a>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div> 
    </div> 
</body>

<script src="./assets/js/bundle.js"></script>
<script src="./assets/js/scripts.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js" integrity="sha512-efAcjYoYT0sXxQRtxGY37CKYmqsFVOIwMApaEbrxJr4RwqVVGw8o+Lfh/+59TU07+suZn1BWq4fDl5fdgyCNkw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date();
            const day = String(today.getDate()).padStart(2, '0');
            const month = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based
            const year = today.getFullYear();

            const todayDate = `${year}-${month}-${day}`;
            document.getElementById('licence_validity').setAttribute('min', todayDate);
        });
    </script>


<script>
   Inputmask({ mask: '999999999999', greedy: false }).mask(document.getElementById('mykad'));
   Inputmask({ mask: '+6099-99999999', greedy: false,placeholder: "" }).mask(document.getElementById('phone'));

   
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    // Get the file input element
    var fileInput = document.getElementById("licence_file");
    
    // Add event listener to detect file selection
    fileInput.addEventListener("change", function() {
        // Get the form element
        var form = document.getElementById("my-form");
        
        // Submit the form
        form.submit();
    });
});

</script>

</html>