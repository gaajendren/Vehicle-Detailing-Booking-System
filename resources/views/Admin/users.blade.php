@include('Include.appadmin')

<!-- content @s -->
<div class="nk-content">
<div class="container">
<div class="nk-content-inner">
<div class="nk-content-body">


<div class="nk-block-head">
    <div class="nk-block-head-between flex-wrap gap g-2">
        <div class="nk-block-head-content">
            <h2 class="nk-block-title">Staff List</h1>
        </div>
        <div class="nk-block-head-content">
            <ul class="d-flex">

                <li>
                    <a class="btn btn-md d-md-none btn-warning newstaff"  data-bs-toggle="modal" data-bs-target="#exampleModalTop">
                        <em class="icon ni ni-plus"></em>
                        <span>New Staff</span>
                    </a>
                </li>
                <li>
                    <a class="btn btn-warning d-none d-md-inline-flex newstaff"  data-bs-toggle="modal" data-bs-target="#exampleModalTop">
                        <em class="icon ni ni-plus"></em>
                        <span>New Staff</span>
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
    <strong>Success!</strong>  {{ session()->get('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
        <table class="datatable-init table" data-nk-container="table-responsive">
            <thead class="table-light">
                <tr>
                    <th class="tb-col">
                        <span class="overline-title">No</span>
                    </th>
                    <th class="tb-col">
                        <span class="overline-title">Full Name</span>
                    </th>
                    <th class="tb-col">
                        <span class="overline-title">Staff ID</span>
                    </th>
                    <th class="tb-col">
                        <span class="overline-title">Email</span>
                    </th>
                    <th class="tb-col">
                        <span class="overline-title">Phone</span>
                    </th>
                    <th class="tb-col">
                        <span class="overline-title">Status</span>
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
                @foreach ($staffs as $key => $staff)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $staff->fullname }}</td>
                    <td>{{ $staff->staffid }}</td>
                    <td>{{ $staff->email }}</td>
                    <td>{{ $staff->phone }}</td>
                    <td>{{ $staff->status == 'A' ? 'Active' : 'Inactive' }}</td>


                    <td>{{ $staff->updated_at ? Carbon\Carbon::parse($staff->updated_at)->formatLocalized('%d %b %Y %I:%M:%S %p') : 'N/A' }}</td>

                    <td style="float:right;">
                    <button class="btn btn-success edit"
                    data-bs-toggle="modal" data-bs-target="#exampleModalTop"
                    data-id="{{ $staff->id }}"
                    data-fullname="{{ $staff->fullname }}"
                    data-staffid="{{ $staff->staffid }}"
                    data-email="{{ $staff->email }}"
                    data-phone="{{ $staff->phone }}"
                    data-status="{{ $staff->status }}"
                    data-mykad="{{ $staff->mykad }}"

                    >Edit</button>

                <button class="btn btn-info view"
                data-bs-toggle="modal" data-bs-target="#exampleModalTop"
                data-id="{{ $staff->id }}"
                    data-fullname="{{ $staff->fullname }}"
                    data-staffid="{{ $staff->staffid }}"
                    data-email="{{ $staff->email }}"
                    data-phone="{{ $staff->phone }}"
                    data-status="{{ $staff->status }}"
                    data-mykad="{{ $staff->mykad }}"
                    >View</button>

                    {!! Form::open(['url' => ['deletestaff', $staff->id], 'method' => 'DELETE', 'class' => 'delete-form', 'style' => 'display:inline;']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Are you sure you want to Delete this Staff?")']) !!}
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
@include('Admin.Modal.staff')
@include('Include.footer')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
    $(document).ready( function () {

    $('.newstaff').on('click',function(){


    $('#fullname').val('').prop('disabled',false);
    $('#email').val('').prop('disabled',false);
    $('#staffid').val('').prop('disabled',false);
    $('#phone').val('').prop('disabled',false);
    $('#status').val('').prop('disabled',false);
    $('#mykad').val('').prop('disabled',false);
    
    $('#password').val('').prop('disabled',false).prop('required',true);
    $('.passwordtext').hide();
    $('.passworddiv').show();

    $('#type').val('C');
    $('#id').val('');

    $('.modal-title').text('Create New Staff');

    $('.btnsubmit').html('Submit').show();


    });

    $(document).on('click', '.edit', function() {



    var id = $(this).data('id');
    var fullname = $(this).data('fullname');
    var staffid = $(this).data('staffid');
    var email = $(this).data('email');
    var phone = $(this).data('phone');
    var status = $(this).data('status');
    var mykad = $(this).data('mykad');

$('#fullname').val(fullname).prop('disabled',false);
$('#email').val(email).prop('disabled',false);
$('#staffid').val(staffid).prop('disabled',false);
$('#phone').val(phone).prop('disabled',false);
$('#status').val(status).prop('disabled',false);
$('#mykad').val(mykad).prop('disabled',false);

$('#password').val('').prop('disabled',false).prop('required',false);
$('.passwordtext').show();
$('.passworddiv').show();

$('#type').val('E');
$('#id').val(id);

$('.modal-title').text('Edit Staff');

$('.btnsubmit').html('Submit').show();


});


$(document).on('click', '.view', function() {

var id = $(this).data('id');
var fullname = $(this).data('fullname');
var staffid = $(this).data('staffid');
var email = $(this).data('email');
var phone = $(this).data('phone');
var status = $(this).data('status');
var mykad = $(this).data('mykad');

$('#fullname').val(fullname).prop('disabled',true);
$('#email').val(email).prop('disabled',true);
$('#staffid').val(staffid).prop('disabled',true);
$('#phone').val(phone).prop('disabled',true);
$('#status').val(status).prop('disabled',true);
$('#mykad').val(mykad).prop('disabled',true);

$('#password').val('').prop('disabled',false).prop('required',false);
$('.passwordtext').hide();
$('.passworddiv').hide();

$('#type').val('V');
$('#id').val('');

$('.modal-title').text('View Staff');

$('.btnsubmit').html('Submit').hide();


});

    });
    </script>