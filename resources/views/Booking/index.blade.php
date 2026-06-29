@include('Include.appadmin')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">



<!-- content @s -->
<div class="nk-content">
<div class="container">
<div class="nk-content-inner">
    <div class="nk-content-body">


        <div class="nk-block-head" style="margin-top:80px;">
            <div class="nk-block-head-between flex-wrap gap g-2">
                <div class="nk-block-head-content">
                    <h2 class="nk-block-title">Booking Management</h1>
                </div>
                <div class="nk-block-head-content">
                    <ul class="d-flex">
                        <li>
                            <a class="btn btn-md d-md-none btn-warning newbooking" data-bs-toggle="modal" data-bs-target="#exampleModalTopBooking">
                                <em class="icon ni ni-plus"></em>
                                <span>New Booking</span>
                            </a>
                        </li>
                        <li>
                            <a class="btn btn-warning d-none d-md-inline-flex newbooking" data-bs-toggle="modal" data-bs-target="#exampleModalTopBooking">
                                <em class="icon ni ni-plus"></em>
                                <span>New Booking</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div><!-- .nk-block-head-between -->
        </div><!-- .nk-block-head -->
        <div class="nk-block">
            <div class="card">
                @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error !</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif


                @if($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ session()->get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <table class="datatable-init table" data-nk-container="table-responsive">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Service Name</th>
                            <th>Booking Timeslot</th>
                            <th>Total Amount</th>
                            <th>Payment Status</th>
                            <th>Booking Status</th>
                            <th>Customer Name</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $key => $booking)
                        @php
                        $bookingDateTime = \Carbon\Carbon::parse($booking->book_date . ' ' . $booking->getsch->schedule_time);
                        $hoursLeft = \Carbon\Carbon::now()->diffInHours($bookingDateTime, false); // false to get negative values if the date is in the past
                        @endphp
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $booking->getbooking->service_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->book_date)->format('d/m/Y') }} {{ \Carbon\Carbon::parse($booking->getsch->schedule_time)->format('h:i A') }}</td>
                            <td>RM {{ $booking->total_price }}</td>
                            <td>{{ $booking->payment_status }}</td>
                            <td>{{ $booking->booking_status }}</td>
                            <td>{{ $booking->name }}</td>
                            <td>{{ $booking->created_at ? Carbon\Carbon::parse($booking->created_at)->formatLocalized('%d %b %Y %I:%M:%S %p') : 'N/A' }}</td>

                            <td>
    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
        <a class="btn btn-success" href="viewBooking/{{ $booking->book_id }}">View</a>

        @if($booking->assigned == '' && $booking->payment_status == 'Success' && $booking->booking_status == 'Booking Confirmed' && $hoursLeft <= 48 || $booking->assigned == '' && $booking->payment_status == 'Success' && $booking->booking_status == 'Approved' && $hoursLeft <= 48)
        <button class="btn btn-primary assign" data-bs-toggle="modal" data-bs-target="#exampleModalTop" data-id="{{ $booking->book_id }}" data-service="{{ $booking->getbooking->service_name }}" data-bookdate="{{ $booking->book_date }}" data-booktime="{{ $booking->getsch->schedule_time }}" data-timeslot="{{ \Carbon\Carbon::parse($booking->book_date)->format('d/m/Y') }} {{ \Carbon\Carbon::parse($booking->getsch->schedule_time)->format('h:i A') }}">Assign</button>
        @endif

        @if($booking->payment_status == 'Success' && $booking->booking_status == 'Booking Confirmed')
        <button class="btn btn-warning approval" style="background-color:green; border-color:green; color:white;" data-id="{{ $booking->book_id }}">Approval</button>
        @endif

        @if($booking->booking_status == 'Booking Confirmed' || $booking->booking_status == 'Payment Failed')
        <button class="btn btn-info editbooking" data-id="{{ $booking->book_id }}" data-bs-toggle="modal" data-bs-target="#exampleModalTopBooking">Edit</button>
        @endif

        <button class="btn btn-danger delete" data-id="{{ $booking->book_id }}">Delete</button>
    </div>
</td>


                        </tr>
                        @endforeach

                    </tbody>
                </table>

            </div><!-- .card -->
        </div><!-- .nk-block -->
    </div>
</div>
</div>
</div> <!-- .nk-content -->

@include('Booking.Modal.assign')
@include('Booking.Modal.booking')
@include('Include.footer')
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {


$(document).on('click', '.delete', function() {
    const bookingId = $(this).data('id');

    Swal.fire({
        title: 'Are you sure you want to delete this booking?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Delete
            $.ajax({
                url: '/delete-booking', // Adjust this URL to your route
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // CSRF token for security
                    booking_id: bookingId
                },
                success: function(response) {
                    Swal.fire('Deleted!', 'The booking has been deleted.', 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 1000); // Reload after 2 seconds
                },
                error: function(response) {
                    Swal.fire('Error!', 'There was an error deleting the booking.', 'error');
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire('Cancelled', 'The booking is safe.', 'info');
        }
    });
});

$(document).on('click', '.approval', function() {

    const bookingId = $(this).data('id');

    Swal.fire({
        title: 'Do you want to approve this booking?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Approve',
        denyButtonText: 'Reject',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Approve
            $.ajax({
                url: '/approve-booking', // Adjust this URL to your route
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // CSRF token for security
                    booking_id: bookingId
                },
                success: function(response) {
                    Swal.fire('Approved!', 'The booking has been approved.', 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                },
                error: function(response) {
                    Swal.fire('Error!', 'There was an error approving the booking.', 'error');
                }
            });
        } else if (result.isDenied) {
            // Reject
            $.ajax({
                url: '/reject-booking', // Adjust this URL to your route
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // CSRF token for security
                    booking_id: bookingId
                },
                success: function(response) {
                    Swal.fire('Rejected!', 'The booking has been rejected.', 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                },
                error: function(response) {
                    Swal.fire('Error!', 'There was an error rejecting the booking.', 'error');
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire('Cancelled', 'No changes have been made.', 'info');
        }
    });
});





$(document).on('click', '.newbooking', function() {

    $('#typebook').val('Create');

    $('#created_by').val('');
    $('#email').val('');
    $('#phone').val('');
    $('#address').val('');

    $('#service_id').val('');
    $('#service_price').val('');
    $('#service_desc').val('');

    $('#payment_status').val('');
    $('#remarks').val('');


    $('#book_timeslot').empty('');

    $("#datepicker").datepicker();
    $("#datepicker").datepicker("destroy");

    $('.btnsubmit').text('Submit');

    $('.modalbookingtitle').text('Add New Booking');

    $('#created_by').prop('disabled', false);
    $('#email').prop('disabled', false);
    $('#phone').prop('disabled', false);
    $('#address').prop('disabled', false);
    $('#service_id').prop('disabled', false);

});



$(document).on('change', '#created_by', function() {
    var selectedOption = $(this).find(':selected');

    var email = selectedOption.data('email');
    var phone = selectedOption.data('phone');
    var address = selectedOption.data('address');

    $('#email').val(email);
    $('#phone').val(phone);
    $('#address').val(address);
});

$(document).on('change', '#service_id', function() {

    var selectedOption2 = $(this).find(':selected');

    var price = selectedOption2.data('price');
    var desc = selectedOption2.data('desc');

    $('#service_price').val(price);
    $('#service_desc').val(desc);

    $('#book_timeslot').empty('');

    $("#datepicker").datepicker();
    $("#datepicker").datepicker("destroy");
});


$(document).on('change', '#service_id', function() {

    var holidays = @json($holidays);

    var holidayDates = holidays.map(function(holiday) {
        return holiday.holidays_date;
    });

    $("#datepicker").datepicker({
        minDate: 0, // Disable past dates
        beforeShowDay: function(date) {
            var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
            if (holidayDates.indexOf(string) !== -1) {
                return [false, "holiday"];
            }
            return [true, ""];
        }
    });

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

    var type = $('#typebook').val();


    $("#datepicker").on("change", function() {
        var selected = $(this).val();

        var id = $('#service_id').val();
        var cid = $('#idbook').val();

        function formatDateToISO(date) {
            var parts = date.split('/');
            var day = parts[1];
            var month = parts[0];
            var year = parts[2];
            return year + '-' + (month.length === 1 ? '0' + month : month) + '-' + (day.length === 1 ? '0' + day : day);
        }

        var formattedDate = formatDateToISO(selected);



        $('#book_date').val(formattedDate);



        if (type == 'Create') {
            $.ajax({
                type: "GET",
                url: "{{url('gettimeslots')}}",
                data: {
                    date: selected,
                    id: id,
                    type: type
                },
                success: function(res) {
                    if (res) {

                        if (res.length != 0) {
                            $('#book_timeslot').empty('');
                            $("#book_timeslot").append(
                                '<option value="" selected disabled>-- Select Timeslot --</option>'
                            );
                            $.each(res, function(key, value) {
                                var formattedTime = formatTimeTo12Hour(value.schedule_time);
                                $("#book_timeslot").append('<option value="' + value.schedule_id +
                                    '">' + formattedTime + '</option>');
                            });
                        } else {
                            $('#book_timeslot').empty('');
                        }
                    } else {
                        $('#book_timeslot').empty('');
                    }
                }
            });
        } else {
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
                            $('#book_timeslot').empty('');
                            $("#book_timeslot").append(
                                '<option value="" selected disabled>-- Select Timeslot --</option>'
                            );
                            $.each(res.data, function(key, value) {
                                var formattedTime = formatTimeTo12Hour(value.schedule_time);
                                $("#book_timeslot").append('<option value="' + value.schedule_id +
                                    '">' + formattedTime + '</option>');
                            });
                            $('#book_timeslot').val(res.timeslot).trigger('change');
                        } else {
                            $('#book_timeslot').empty('');
                        }
                    } else {
                        $('#book_timeslot').empty('');
                    }
                }
            });

        }
    });


});

$(document).on('click', '.assign', function() {

    var id = $(this).data('id');
    var service = $(this).data('service');
    var timeslot = $(this).data('timeslot');
    var bookdate = $(this).data('bookdate');
    var booktime = $(this).data('booktime');

    $.ajax({
        type: "GET",
        url: "{{url('fetchstaff')}}",
        data: {
            id: id,
            bookdate: bookdate,
            booktime: booktime
        },
        success: function(res) {
            if (res) {
                $('#assigned').empty();
                console.log(res)
                $("#assigned").append('<option value=""  selected disabled>Select Staff</option>');
                $.each(res, function(key, value) {
                    $("#assigned").append('<option value="' + value.id + '">' + value.fullname + '</option>');
                });
            } else {
                $('#assigned').empty('');
            }
        }
    });


    $('#assigned').val('').prop('disabled', false);

    $('#servicename').val(service).prop('disabled', true);
    $('#timeslot').val(timeslot).prop('disabled', true);

    $('#id').val(id);


});

$(document).on('click', '.editbooking', function() {

    $("#datepicker").datepicker();
    $("#datepicker").datepicker("destroy");

    $('#typebook').val('Edit');
    var id = $(this).data('id');
    $.ajax({
        url: '/fetch-bookings-byid',
        type: 'GET',
        data: {
            id: id
        },
        success: function(booking) {
            $('#created_by').val(booking.created_by).trigger('change');
            $('#service_id').val(booking.service_id).trigger('change');

            $('#idbook').val(booking.book_id);

            var parsedBookingDate = new Date(booking.book_date);

            $("#datepicker").datepicker("setDate", parsedBookingDate).trigger('change');


            $('#payment_status').val(booking.payment_status);
            $('#remarks').val(booking.remarks);

            $('#created_by').prop('disabled', true);
            $('#email').prop('disabled', true);
            $('#phone').prop('disabled', true);
            $('#address').prop('disabled', true);
            $('#service_id').prop('disabled', true);


        },
        error: function(error) {
            console.error('Error fetching result:', error);
        },
    });

    $('.btnsubmit').text('Update');

    $('.modalbookingtitle').text('Edit Booking');

});




});
</script>