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
            <h2 class="nk-block-title">Holiday List</h1>
        </div>
        <div class="nk-block-head-content">
            <ul class="d-flex">

                <li>
                    <a class="btn btn-md d-md-none btn-warning"  data-bs-toggle="modal" data-bs-target="#exampleModalTop">
                        <em class="icon ni ni-plus"></em>
                        <span>New Holiday</span>
                    </a>
                </li>
                <li>
                    <a class="btn btn-warning d-none d-md-inline-flex"  data-bs-toggle="modal" data-bs-target="#exampleModalTop">
                        <em class="icon ni ni-plus"></em>
                        <span>New Holiday</span>
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
                        <span class="overline-title">Holiday Name</span>
                    </th>
                    <th class="tb-col">
                        <span class="overline-title">Date</span>
                    </th>
                    <th class="tb-col tb-col-end" data-sortable="false">
                        <span class="overline-title">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($holidays as $key => $holiday)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $holiday->holiday_name }}</td>
                    <td>{{ $holiday->holidays_date ? Carbon\Carbon::parse($holiday->holidays_date)->formatLocalized('%d %b %Y') : 'N/A' }}</td>

                    <td style="float:right;">
                        {!! Form::open(['url' => ['deleteholiday', $holiday->id], 'method' => 'DELETE', 'class' => 'delete-form', 'style' => 'display:inline;']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Are you sure you want to Delete this Holiday?")']) !!}
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
@include('Holidays.Modal.holiday')
@include('Include.footer')