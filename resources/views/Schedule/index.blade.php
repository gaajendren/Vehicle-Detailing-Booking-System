@include('Include.appadmin')

<!-- content @s -->
<div class="nk-content">
<div class="container">
<div class="nk-content-inner">
<div class="nk-content-body">

@if($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> {{ session()->get('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if($message = Session::get('errors'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> {{ session()->get('errors') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="nk-block-head">
    <div class="nk-block-head-between flex-wrap gap g-2">
        <div class="nk-block-head-content">
            <h2 class="nk-block-title">Schedule List <b style="color:blue;">[ {{ $service->service_name }}]</b></h1>
        </div>
        <div class="nk-block-head-content">
            <ul class="d-flex">

                <li>
                    <a class="btn btn-md d-md-none btn-info"  href="/schedule">
                        <em class="icon ni ni-back-alt"></em>
                        <span>Back</span>
                    </a>
                </li>
                <li style="margin-right: 20px;">
                    <a class="btn btn-info d-none d-md-inline-flex" href="/schedule">
                        <em class="icon ni ni-back-alt"></em>
                        <span>Back</span>
                    </a>
                </li>

                <li>
                    <a class="btn btn-md d-md-none btn-warning"  data-bs-toggle="modal" data-bs-target="#exampleModalTop">
                        <em class="icon ni ni-plus"></em>
                        <span>New Schedule</span>
                    </a>
                </li>
                <li>
                    <a class="btn btn-warning d-none d-md-inline-flex"  data-bs-toggle="modal" data-bs-target="#exampleModalTop">
                        <em class="icon ni ni-plus"></em>
                        <span>New Schedule</span>
                    </a>
                </li>
            </ul>
        </div>
    </div><!-- .nk-block-head-between -->
</div><!-- .nk-block-head -->
<div class="nk-block">
    <div class="card">

        <table class="datatable-init table" data-nk-container="table-responsive">
            <thead class="table-light">
                <tr>
                    <th class="tb-col">
                        <span class="overline-title">No</span>
                    </th>
                    <th class="tb-col">
                        <span class="overline-title">Service Time</span>
                    </th>
                    <th class="tb-col">
                        <span class="overline-title">Last Update</span>
                    </th>
                    <th class="tb-col tb-col-end" data-sortable="false">
                        <span class="overline-title">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schedules as $key => $schedule)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $schedule->updated_at ? Carbon\Carbon::parse($schedule->schedule_time)->formatLocalized('%I:%M %p') : 'N/A' }}</td>
                    <td>{{ $schedule->updated_at ? Carbon\Carbon::parse($schedule->updated_at)->formatLocalized('%d %b %Y %I:%M:%S %p') : 'N/A' }}</td>

                    <td style="float:right;">
                        {!! Form::open(['url' => ['deleteschedule', $schedule->schedule_id], 'method' => 'DELETE', 'class' => 'delete-form', 'style' => 'display:inline;']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Are you sure you want to Delete this Schedule?")']) !!}
                        {!! Form::close() !!}
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
@include('Schedule.Modal.addsh')
@include('Include.footer')