@include('Include.appcustomer')
  <br>

<style>
            .pt-5,.py-5 {
    padding-top:0 !important;
}
</style>
    <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">My Profile</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a class="text-white" href="">Home</a></h6>
            <h6 class="text-body m-0 px-3">/</h6>
            <h6 class="text-uppercase text-body m-0">My Profile</h6>
        </div>
    </div>
    <!-- Page Header Start -->


    <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <h1 class="display-4 text-uppercase text-center mb-5">My Profile</h1>

            @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error !</strong>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif


        @if($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session()->get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
            <div class="row">
                <div class="col-lg-7 mb-2">
                    <div class="contact-form bg-light mb-4" style="padding: 30px;">
    <form action="/updprofile" method="POST">
        @csrf
    <div class="row">
        <div class="col-6 form-group">
            <label for="fullname">Full Name</label>
            <input type="text" class="form-control p-4" id="fullname" name="fullname" value="{{ auth()->user()->fullname }}" placeholder="Full Name" required="required">
        </div>
        <div class="col-6 form-group">
            <label for="text">IC Number</label>
            <input type="text" class="form-control p-4" id="mykad" name="mykad" placeholder="IC Number" value="{{ auth()->user()->mykad }}" required="required">
        </div>
    </div>
    <div class="form-group">
        <label for="email">Email <sup style="color:green;">Verified &#10003;</sup></label>
        <input type="text" class="form-control p-4" value="{{ auth()->user()->email }}" disabled>
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" class="form-control p-4" id="phone" name="phone" placeholder="Phone Number" value="{{ auth()->user()->phone }}" required="required">
    </div>
    <div class="form-group">
        <label for="phone">Licence Validity <sup>[Optional]</sup></label>
        <input type="date" class="form-control p-4" id="licence_validity" name="licence_validity" value="{{ auth()->user()->licence_validity }}">
    </div>
    <div class="form-group">
        <label for="address">Address <sup style="color:blue;">Booking only available for Klang Valley area</sup></label>
        <textarea class="form-control py-3 px-4" id="address" name="address" rows="5" placeholder="Address"  maxlength="500"  required="required">{{ auth()->user()->address }}</textarea>
    </div>
    <div>
        <button class="btn btn-primary py-3 px-5" type="submit">Update</button>
    </div>
</form>

                    </div>
                </div>
                <div class="col-lg-5 mb-2">
                    <div class="contact-form bg-light mb-4" style="padding: 30px;">
                    <form action="/changepass" method="POST">
                    @csrf
    <div class="row">
        <div class="col-12 form-group">
            <label for="name">Current Password</label>
            <input type="password" class="form-control p-4" id="cpassword" name="cpassword" placeholder="Current Password" required="required">
        </div>
    </div>
    <div class="row">
        <div class="col-12 form-group">
            <label for="name">New Password</label>
            <input type="password" class="form-control p-4" id="newpassword" name="newpassword" placeholder="New Password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*#?&]).{10,32}" title="Your password must be between 10 - 32 characters long and include uppercase letter (A-Z), lowercase letter (a-z), number (0-9) and special characters such as @$!%*#?&"  required="required">
        </div>
    </div>
    <div class="row">
        <div class="col-12 form-group">
            <label for="name">Confirm New Password</label>
            <input type="password" class="form-control p-4" id="cnewpassword" name="cnewpassword" placeholder="Confirm New Password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*#?&]).{10,32}" title="Your password must be between 10 - 32 characters long and include uppercase letter (A-Z), lowercase letter (a-z), number (0-9) and special characters such as @$!%*#?&"  required="required">
        </div>
    </div>
    <div>
        <button class="btn btn-primary py-3 px-5" type="submit">Change Password</button>
    </div>
</form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="owl-carousel vendor-carousel">
                <div class="bg-light p-4">
                    <img src="customer/img/vendor-1.png" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="customer/img/vendor-2.png" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="customer/img/vendor-3.png" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="customer/img/vendor-4.png" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="customer/img/vendor-5.png" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="customer/img/vendor-6.png" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="customer/img/vendor-7.png" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="customer/img/vendor-8.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->


    <!-- Footer Start -->
    
    <div class="container-fluid bg-dark py-4 px-sm-3 px-md-5">
        <p class="mb-2 text-center text-body">&copy; <a href="#">Vehicle Detailing Booking System</a>. All Rights Reserved.</p>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="customer/lib/easing/easing.min.js"></script>
    <script src="customer/lib/waypoints/waypoints.min.js"></script>
    <script src="customer/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="customer/lib/tempusdominus/js/moment.min.js"></script>
    <script src="customer/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="customer/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="customer/js/main.js"></script>

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
</body>

</html>