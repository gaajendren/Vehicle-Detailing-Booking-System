@include('Include.appcustomer')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
<style>
.pt-5,.py-5 {
    padding-top:0 !important;
}
</style>

<!-- Page Header Start -->
<div class="container-fluid page-header">
    <h1 class="display-3 text-uppercase text-white mb-3">My Booking</h1>
    <div class="d-inline-flex text-white">
        <h6 class="text-uppercase m-0"><a class="text-white" href="">Home</a></h6>
        <h6 class="text-body m-0 px-3">/</h6>
        <h6 class="text-uppercase text-body m-0">My Booking</h6>
    </div>
</div>
<!-- Page Header Start -->


<!-- Rent A Car Start -->
<div class="container-fluid py-5">
    <div class="container-fluid pt-5 pb-3">

        <h1 class="display-4 text-uppercase text-center mb-5">List of Bookings</h1>
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
            <div class="col-lg-12 col-md-12 mb-2">
                <table id="myTable" style="width:100%;" class="table table-striped">
                    <thead>
                        <tr style="font-size: 15px;">
                            <th>No</th>
                            <th>Service Name</th>
                            <th>Booking Timeslot</th>
                            <th>Total Amount</th>
                            <th>Payment Status</th>
                            <th>Booking Status</th>
                            <th>Remaining Hours</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $key => $booking)
                        @php
                            

                            $bookingDateTime = Carbon\Carbon::parse($booking->book_date . ' ' . $booking->getsch->schedule_time);
                            $currentTime = Carbon\Carbon::now();
                            $timeDiffHours = $currentTime->diffInHours($bookingDateTime, false);
                            @endphp
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $booking->getbooking->service_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->book_date)->format('d/m/Y') }} {{ \Carbon\Carbon::parse($booking->getsch->schedule_time)->format('h:i A') }}</td>
                            <td>RM {{ $booking->total_price }}</td>
                            <td>{{ $booking->payment_status }}</td>
                            <td>{{ $booking->booking_status }}</td>
                            <td @if($timeDiffHours > 0) style="color:green; text-align:center;" @else style="color:red; text-align:center;" @endif>{{ $timeDiffHours }}</td>
                            <td>{{ $booking->created_at }}</td>
                            <td>
                                @if($booking->booking_status != "Cancelled" && $booking->booking_status != "Payment Failed" && $booking->booking_status != "Rejected")

                                @if($booking->booking_review == '' && $booking->payment_status == 'Success')
                                <button type="button" class="btn btn-warning review" data-name="{{ $booking->getbooking->service_name }}" data-id="{{ $booking->book_id }}" data-toggle="modal" data-target="#exampleModal">Add Review</button>
                                @endif

                                @if($timeDiffHours > 48 && $booking->booking_status != "Completed" && $booking->booking_status != "Approved" && $booking->booking_status != "Rejected" && $booking->booking_status != "Assigned")
                                    <br>
                                    <a type="button" href="editBooking/{{ $booking->book_id }}" class="btn btn-info" style="margin-top: 20px;">Edit Booking</a>
                                    <br>
                                    <a type="button" href="cancelBooking/{{ $booking->book_id }}" class="btn btn-danger" style="margin-top: 20px;" onclick="return confirm('Are you sure you want to cancel this booking?');">Cancel Booking</a>
                                    @endif
                                    @else
                                    -
                                    @endif

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Review Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(array('url' => 'storereview', 'method' => 'POST', 'files' => true)) !!}
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Service Name:</label>
                    <input type="text" class="form-control" id="id" name="id" required hidden>
                    <input type="text" class="form-control" id="service_name" name="service_name" disabled>
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Your Review:</label>
                    <textarea class="form-control" id="booking_review" name="booking_review" maxlength="500" required></textarea>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>


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

<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });

    $(".review").on("click", function() {
        var name = $(this).data('name');
        var id = $(this).data('id');

        $('#id').val(id);
        $('#service_name').val(name);

    });
</script>
</body>

</html>