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

                <div class="nk-block-head">
                    <div class="nk-block-head-between flex-wrap gap g-2">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title">Services List</h1>
                        </div>
                        <div class="nk-block-head-content">
                        <ul class="d-flex">

                                <li>
                                    <a href="/createservice" class="btn btn-md d-md-none btn-warning">
                                        <em class="icon ni ni-plus"></em>
                                        <span>New Service</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/createservice" class="btn btn-warning d-none d-md-inline-flex">
                                        <em class="icon ni ni-plus"></em>
                                        <span>New Service</span>
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
                                        <span class="overline-title">Service Name</span>
                                    </th>
                                    <th class="tb-col">
                                        <span class="overline-title">Price</span>
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
                                @foreach ($services as $key => $service)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $service->service_name ?? '-' }}</td>
                                    <td>RM {{ $service->service_price ?? '-' }}</td>
                                    <td>{{ $service->updated_at ? Carbon\Carbon::parse($service->updated_at)->formatLocalized('%d %b %Y %I:%M:%S %p') : 'N/A' }}</td>

                                    <td style="float:right;">
                                        <a class="btn btn-success" href="{{ url('editservice', $service->id) }}">Edit</a>
                                        <a class="btn btn-info" href="{{ url('viewservice', $service->id) }}">View</a>
                                        {!! Form::open(['url' => ['deleteservice', $service->id], 'method' => 'DELETE', 'class' => 'delete-form', 'style' => 'display:inline;']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Are you sure you want to Delete this Service?")']) !!}
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
@include('Include.footer')