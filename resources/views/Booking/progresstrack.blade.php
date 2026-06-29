@include('Include.appadmin')

<!-- content @s -->
<div class="nk-content">
<div class="container">
<div class="nk-content-inner">
<div class="nk-content-body">


<div class="nk-block-head">
    <div class="nk-block-head-between flex-wrap gap g-2">
        <div class="nk-block-head-content">
            <h2 class="nk-block-title">Progress Tracking</h1>
        </div>
        <div class="nk-block-head-content">
            <ul class="d-flex">
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
    <strong>Success!</strong>  {{ session()->get('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
        <table class="datatable-init table" data-nk-container="table-responsive">
            <thead class="table-light">
                <tr>
                <th>No</th>
            <th>Service Name</th>
            <th>Booking Timeslot</th>
            <th>Booking Status</th>
            <th>Assigned Staff</th>
            <th>Checkin DateTime</th>
            <th>Checkout DateTime</th>
            <th>Progress</th>
            <th>Last Update</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $key => $booking)

                <?php
                $progress = 0;

                if($booking->booking_status == 'Booking Confirmed'){
                    $progress = '20';
                    $color = 'bg-secondary';
                }
                if($booking->booking_status == 'Approved'){
                    $progress = '20';
                    $color = 'bg-secondary';
                }
                if($booking->booking_status == 'Rejected'){
                    $progress = '0';
                    $color = 'bg-danger';
                }
                elseif($booking->booking_status == 'Assigned'){
                    $progress = '30';
                    $color = 'bg-warning';
                }
                elseif($booking->booking_status == 'In Progress'){
                    $progress = '55';
                    $color = 'bg-info';
                }
                elseif($booking->booking_status == 'Completed'){
                    $progress = '100';
                    $color = 'bg-success';
                }
                ?>
                <tr>
                <td>{{ ++$key }}</td>
            <td>{{ $booking->getbooking->service_name }}</td>
            <td>{{ \Carbon\Carbon::parse($booking->book_date)->format('d/m/Y') }} {{ \Carbon\Carbon::parse($booking->getsch->schedule_time)->format('h:i A') }}</td>
            <td>{{ $booking->booking_status }}</td>
            <td>{{ $booking->assigned != '' ? $booking->getstaff->fullname : 'N/A' }}</td>

  
            <td>{{ $booking->checkin ? Carbon\Carbon::parse($booking->checkin)->formatLocalized('%d %b %Y %I:%M:%S %p') : 'N/A' }}</td>
            <td>{{ $booking->checkout ? Carbon\Carbon::parse($booking->checkout)->formatLocalized('%d %b %Y %I:%M:%S %p') : 'N/A' }}</td>
            <td><div class="progress">    <div class="progress-bar {{$color}} progress-bar-striped progress-bar-animated" data-progress="{{$progress}}%">{{$progress}}%</div></div></td>
            <td>{{ $booking->updated_at ? Carbon\Carbon::parse($booking->updated_at)->formatLocalized('%d %b %Y %I:%M:%S %p') : 'N/A' }}</td>

                 
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


@include('Include.footer')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
    $(document).ready( function () {


    $(document).on('click', '.assign', function() {



    var id = $(this).data('id');
    var service = $(this).data('service');
    var timeslot = $(this).data('timeslot');


$('#assigned').val('').prop('disabled',false);

$('#servicename').val(service).prop('disabled',true);
$('#timeslot').val(timeslot).prop('disabled',true);

$('#id').val(id);


});



    });
    </script>