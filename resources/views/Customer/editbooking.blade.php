@include('Include.appcustomer')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">

  <br>


    <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">Edit Booking</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a class="text-white" href="">Home</a></h6>
            <h6 class="text-body m-0 px-3">/</h6>
            <h6 class="text-uppercase text-body m-0">Edit Booking</h6>
        </div>
    </div>
    <!-- Page Header Start -->

    <!-- Car Booking Start -->
    <div class="container-fluid pb-5">
        <div class="container">
        {!! Form::open(array('url' => 'updbooking', 'method' => 'POST', 'files' => true)) !!}
            <div class="row">
                <div class="col-lg-8">
                <h2 class="mb-4">Service Detail</h2>
                    <div class="mb-5">
                        <div class="row">
                            <div class="col-6 form-group">
                            <label class="form-group">Service Name</label>
                                <input type="email" class="form-control p-4" value="{{ $service->service_name }}" readonly>
                            </div>
                            <div class="col-6 form-group">
                            <label class="form-group">Service Price</label>
                            <input type="email" class="form-control p-4" value="RM {{ $service->service_price }}" readonly>
                            </div>
                            <div class="col-12 form-group">
                            <label class="form-group">Service Details</label>
                                <textarea class="form-control p-4" rows="7" readonly>{{ $service->service_desc }}</textarea>
                            </div>
                        </div>
                    </div>


                    <h2 class="mb-4">Personal Detail</h2>
                    <div class="mb-5">
                        <input type="text" name="id" id="id" value="{{ $booking->service_id }}" hidden>
                        <input type="text" name="cid" id="cid" value="{{ $id }}" hidden>
                        <div class="row">
                            <div class="col-6 form-group">
                                <label class="form-group">Full Name</label>
                                <input type="text" class="form-control p-4" required="required" value="{{ auth()->user()->fullname }}" name="name" id="name" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 form-group">
                            <label class="form-group">Email</label>
                                <input type="email" class="form-control p-4" placeholder="Your Email" required="required" name="email" id="email"  value="{{ auth()->user()->email }}" readonly>
                            </div>
                            <div class="col-6 form-group">
                            <label class="form-group">Mobile Number</label>
                                <input type="text" class="form-control p-4" placeholder="Mobile Number" required="required" name="phone" id="phone" value="{{ auth()->user()->phone }}" readonly>
                            </div>
                            <div class="col-12 form-group">
                            <label class="form-group">Address</label>
                                <textarea class="form-control p-4" name="address" id="address" readonly>{{ auth()->user()->address }}</textarea>
                            </div>
                        </div>
                    </div>
                    <h2 class="mb-4">Booking Detail</h2>
                    <div class="mb-5">
                        <div class="row">
                            <div class="col-6 form-group">
                            <label class="form-group">Booking Date</label>
                            <div id="datepicker"></div>
                            <input type="date" name="book_date" id="book_date" hidden>
                            </div>
                            <div class="col-6 form-group">
                            <label class="form-group">Booking Timeslot</label>
                                <select class="custom-select px-4" name="book_timeslot" id="timeslot" style="height: 50px;" required>
                                    <option value="" selected disabled>-- Select Timeslot --</option>
                                </select>
                            </div>
                        </div>
           
                        <div class="form-group">
                        <label class="form-group">Remarks</label>
                            <textarea class="form-control py-3 px-4" rows="3" name="remarks" id="remarks" placeholder="Remarks..."  required="required">{{ $booking->remarks }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="bg-secondary p-5 mb-5">
                        <h2 class="text-primary mb-4">Payment Made</h2>
                        <h4 style="color:yellow;">RM {{ $service->service_price }}</h4>
                    
                        <button class="btn btn-block btn-primary py-3" type="submit">Update Booking</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    <!-- Car Booking End -->


    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="owl-carousel vendor-carousel">
                <div class="bg-light p-4">
                    <img src="../customer/img/vendor-1.png" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="../customer/img/vendor-2.png" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="../customer/img/vendor-3.png" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="../customer/img/vendor-4.png" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="../customer/img/vendor-5.png" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="../customer/img/vendor-6.png" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="../customer/img/vendor-7.png" alt="">
                </div>
                <div class="bg-light p-4">
                    <img src="../customer/img/vendor-8.png" alt="">
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


  <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
  <script>
 $(document).ready(function() {
    var bookingDate = "{{ $booking->book_date }}"; 

    var parsedBookingDate = new Date(bookingDate);

    var holidays = @json($holidays);

var holidayDates = holidays.map(function(holiday) {
    return holiday.holidays_date;
});

$("#datepicker").datepicker({
    minDate: 0, // Disable past dates
    beforeShowDay: function(date) {
        var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
        if (holidayDates.indexOf(string) !== -1) {
            return [false, "holiday"]; // Disable holiday dates
        }
        return [true, ""];
    }
});

    // Function to convert 24-hour time to 12-hour time
function formatTimeTo12Hour(time) {
    // Split the time into hours and minutes
    var [hours, minutes] = time.split(':');
    hours = parseInt(hours);

    // Determine AM or PM suffix
    var suffix = hours >= 12 ? 'PM' : 'AM';

    // Convert hours to 12-hour format
    hours = hours % 12 || 12;

    // Return formatted time
    return `${hours}:${minutes} ${suffix}`;
}

    $("#datepicker").on("change",function(){
        var selected = $(this).val();
        var id = $('#id').val();
        var cid = $('#cid').val();

    // Function to format date to yyyy-MM-dd
    function formatDateToISO(date) {
        var parts = date.split('/');
        var day = parts[1];
        var month = parts[0];
        var year = parts[2];
        return year + '-' + (month.length === 1 ? '0' + month : month) + '-' + (day.length === 1 ? '0' + day : day);
    }

    // Format the selected date
    var formattedDate = formatDateToISO(selected);

    // Set the formatted date as the value of book_date
    $('#book_date').val(formattedDate);

        $.ajax({
                type: "GET",
                url: "{{url('gettimeslotsedit')}}",
                data: {
                date: selected,
                id: id,
                cid: cid
                },
                success: function(res) {
                    if (res.data) {
                      
                 

                        if (res.data.length != 0) {
                                $('#timeslot').empty('');
                                $("#timeslot").append(
                                    '<option value="" selected disabled>-- Select Timeslot --</option>'
                                );
                                $.each(res.data, function(key, value) {
                                    var formattedTime = formatTimeTo12Hour(value.schedule_time);
                                    $("#timeslot").append('<option value="' + value.schedule_id +
                                        '">' + formattedTime + '</option>');
                                });
                                $('#timeslot').val(res.timeslot).trigger('change');
                        } else {
                            $('#timeslot').empty('');
                        }
                    } else {
                        $('#timeslot').empty('');
                    }
                }
            });
    });
    console.log(parsedBookingDate);
    $("#datepicker").datepicker("setDate", parsedBookingDate).trigger('change');
  } );

  
  </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('customer/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('customer/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('customer/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('customer/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('customer/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('customer/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('customer/js/main.js') }}"></script>
</body>

</html>