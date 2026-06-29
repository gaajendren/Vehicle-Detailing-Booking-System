@include('Include.appcustomer')
  <br>

  <style>
            .pt-5,.py-5 {
    padding-top:0 !important;
}
</style>

    <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">Service Listing</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a class="text-white" href="">Home</a></h6>
            <h6 class="text-body m-0 px-3">/</h6>
            <h6 class="text-uppercase text-body m-0">Service Listing</h6>
        </div>
    </div>
    <!-- Page Header Start -->


    <!-- Rent A Car Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <h1 class="display-4 text-uppercase text-center mb-5">Find our Best Services</h1>
            <h3 style="color:blue; text-align:center;">Booking only available for Klang Valley area</h3>
            <br><br><br>
            <div class="row">
                @foreach($services as $service)
                <div class="col-lg-4 col-md-6 mb-2" >
                    <div class="rent-item mb-4" style="height:600px;">
                        <img class="img-fluid mb-4" src="uploads/service_images/{{ $service->service_image }}" style="width:300px; height:300px;" alt="">
                        <h4 class="text-uppercase mb-4">{{ $service->service_name }}</h4>
                        <div class="d-flex justify-content-center mb-4">
                            <div class="px-2">
                                <i class="fa fa-money-check text-primary mr-1"></i>
                                <span>RM {{ $service->service_price }}</span>
                            </div>
                        </div>
                        <a href="bookservice/{{ $service->id }}" class="btn btn-primary px-3" href="">BOOK NOW</a>
                    </div>
                </div>
                @endforeach
               
          
            </div>
        </div>
    </div>
    <!-- Rent A Car End -->


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
</body>

</html>