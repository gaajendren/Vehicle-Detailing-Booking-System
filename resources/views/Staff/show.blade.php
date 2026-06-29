@include('Include.appstaff')

<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>

<div class="nk-content">
    <div class="container">
        <div class="nk-content-inner">
            <div class="nk-content-body">

                <div class="nk-block">
    
                    <!-- content @s -->
                    <div class="nk-content">
                        <div class="container">
                            <div class="nk-content-inner">
                                <div class="nk-content-body">
                                    <div class="nk-block-head">
                                        <div class="nk-block-head">
                                            <div class="nk-block-head-between flex-wrap gap g-2 align-items-center">
                                                <div class="nk-block-head-content">
                                                    <div class="d-flex flex-column flex-md-row align-items-md-center">

                                                        <div class="mt-3 mt-md-0 ms-md-3">
                                                            <h3 class="title mb-1" style="color:blue;"><u>BOOKING DETAILS</u></h3>


                                                        </div>
                                                    </div>
                                                </div><!-- .nk-block-head-content -->

                                            </div><!-- .nk-block-head-between -->
                                        </div><!-- .nk-block-head -->
                                    </div><!-- .nk-block-head -->
                                

                                    {!! Form::open(['url' => route('uploadjobdone', ['id' => $booking->book_id]), 'method' => 'POST', 'files' => true]) !!}
                                    {!! Form::hidden('_method', 'PUT') !!}

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

                                    <div class="nk-block">
                                        <div class="card card-gutter-md">
                                            <div class="card-body">
                                                <div class="bio-block">
                                                    <h4>Booking Status: <b style="color:blue;">{{ $booking->booking_status }}</b></h4>
                                                    <HR>
                                                    <h4 class="bio-block-title mb-4" style="color:blue;"><u>1. SERVICE INFORMATION</u></h4>
                                                    <div class="row g-3">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="" class="form-label">Service Name</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" id="service_name" name="service_name" value="{{ $booking->getbooking->service_name }}" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="" class="form-label">Service Price</label>
                                                                <div class="form-control-wrap">
                                                                <input type="number" step="0.01" class="form-control" id="service_price" name="service_price" value="{{ $booking->getbooking->service_price }}"  disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="" class="form-label">Service Image</label>
                                                                <div class="form-control-wrap">
                                                                    <br>
                                                                    <image src="uploads/service_images/{{ $booking->getbooking->service_image }}" style="width:200px; height:200px;"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="remarks" class="form-label">Service Details</label>
                                                                <div class="form-control-wrap">
                                                                    <textarea class="form-control" maxlength="500" rows="10" name="service_desc" id="service_desc" disabled>{{ $booking->getbooking->service_desc }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr>

                                                     
                                                    </div>

                                                    <h4 class="bio-block-title mb-4" style="color:blue;"><u>2. CUSTOMER INFORMATION</u></h4>
                                                    <div class="row g-3">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="" class="form-label">Name</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" value="{{ $booking->name }}" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="" class="form-label">Email</label>
                                                                <div class="form-control-wrap">
                                                                <input type="text" class="form-control" value="{{ $booking->email }}"  disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="" class="form-label">Mobile</label>
                                                                <div class="form-control-wrap">
                                                                <input type="text" class="form-control" value="{{ $booking->phone }}"  disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="remarks" class="form-label">Address</label>
                                                                <div class="form-control-wrap">
                                                                    <textarea class="form-control" maxlength="500" rows="10" disabled>{{ $booking->address }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr>

                                                     
                                                    </div>

                                                    <h4 class="bio-block-title mb-4" style="color:blue;"><u>3. BOOKING INFORMATION</u></h4>
                                                    <div class="row g-3">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="" class="form-label">Booking Date</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($booking->book_date)->format('d/m/Y') }}" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="" class="form-label">Booking Time</label>
                                                                <div class="form-control-wrap">
                                                                <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($booking->getsch->schedule_time)->format('h:i A') }}"  disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                       

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="remarks" class="form-label">Customer Remarks</label>
                                                                <div class="form-control-wrap">
                                                                    <textarea class="form-control" maxlength="500" rows="10" disabled>{{ $booking->remarks }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr>

                                    
                                                    </div>

                                                    <h4 class="bio-block-title mb-4" style="color:blue;"><u>4. MY TASK UPDATE</u></h4>
                                                    <div class="row g-3">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="" class="form-label">Checkin</label>
                                                                <div class="form-control-wrap">
                                                                    @if($booking->checkin != '')
                                                                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($booking->checkin)->format('d/m/Y') }} {{ \Carbon\Carbon::parse($booking->checkin)->format('h:i A') }}" disabled>
                                                                    @else
                                                                    <a href="../checkin/{{$booking->book_id}}" class="btn btn-info btn-lg" type="button">Checkin</a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="" class="form-label">Checkout</label>
                                                                <div class="form-control-wrap">
                                                                @if($booking->checkout != '')
                                                                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($booking->checkout)->format('d/m/Y') }} {{ \Carbon\Carbon::parse($booking->checkout)->format('h:i A') }}" disabled>
                                                                    @else
                                                                    <a href="../checkout/{{$booking->book_id}}" class="btn btn-success btn-lg" type="button">Checkout</a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                       

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="remarks" class="form-label">Job Done Proof</label>
                                                                <div class="form-control-wrap">
                                                                @if($booking->jobdone_proof == '')
                                                                <input type="file" class="form-control" id="jobdone_proof" name="jobdone_proof" required>
                                                                <br>
                                                                <button class="btn btn-success btn-md" type="submit">Upload</a>
                                                                @else
                                                                <a href="uploads/jobdone/{{ $booking->jobdone_proof }}" class="btn btn-primary btn-md" type="button" target="_blank">View/Download</a>
                                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <hr>

                                    
                                                    </div>

                                                    <div class="col-lg-12">
                                                       
                                                       <a href="../homestaff" class="btn btn-primary" type="button"><< Back</a>
                                                   </div>

                                                    </div>

                                                </div><!-- .bio-block -->
                                            </div><!-- .card-body -->
                                        </div><!-- .card -->
                                    </div><!-- .nk-block -->


                                    
                                                    </form>
                                                </div><!-- .bio-block -->
                                            </div><!-- .card-body -->
                                        </div><!-- .card -->
                                    </div><!-- .nk-block -->


                                </div>
                            </div>
                        </div>
                    </div> <!-- .nk-content -->

@include('Include.footer')