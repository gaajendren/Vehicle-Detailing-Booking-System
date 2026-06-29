@include('Include.appstaff')

<!-- content @s -->
<div class="nk-content">
<div class="container">
<div class="nk-content-inner">
<div class="nk-content-body">


<div class="nk-block-head">
    <div class="nk-block-head-between flex-wrap gap g-2">
        <div class="nk-block-head-content">
            <h2 class="nk-block-title">My Dashboard</h1>

            <h3 class="nk-block-title">Task List</h3>
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
            <th>Customer Name</th>
            <th>Last Update</th>
            <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $key => $booking)
                <tr>
                <td>{{ ++$key }}</td>
            <td>{{ $booking->getbooking->service_name }}</td>
            <td>{{ \Carbon\Carbon::parse($booking->book_date)->format('d/m/Y') }} {{ \Carbon\Carbon::parse($booking->getsch->schedule_time)->format('h:i A') }}</td>


            <td>{{ $booking->booking_status }}</td>
            <td>{{ $booking->name }}</td>
                    <td>{{ $booking->updated_at ? Carbon\Carbon::parse($booking->updated_at)->formatLocalized('%d %b %Y %I:%M:%S %p') : 'N/A' }}</td>

                  <td>
                  <a class="btn btn-warning"
                    href="viewTask/{{ $booking->book_id }}"
                    >Update Task</a>
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


@include('Include.footer')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

   