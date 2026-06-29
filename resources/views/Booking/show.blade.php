@include('Include.appadmin')

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
                                                            <h3 class="title mb-1" style="color:blue;"><u>VIEW BOOKING DETAILS</u></h3>


                                                        </div>
                                                    </div>
                                                </div><!-- .nk-block-head-content -->

                                            </div><!-- .nk-block-head-between -->
                                        </div><!-- .nk-block-head -->
                                    </div><!-- .nk-block-head -->
                                

                                    {!! Form::open(['url' => '', 'method' => 'POST', 'files' => true]) !!}
{!! Form::hidden('_method', 'PUT') !!}



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
                                                                <label for="" class="form-label">Total Amount</label>
                                                                <div class="form-control-wrap">
                                                                <input type="text" class="form-control" value="RM {{ $booking->total_price }}"  disabled>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="" class="form-label">Payment Status</label>
                                                                <div class="form-control-wrap">
                                                                <input type="text" class="form-control" value="{{ $booking->payment_status }}"  disabled>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="" class="form-label">Transaction ID</label>
                                                                <div class="form-control-wrap">
                                                                <input type="text" class="form-control" value="{{ $booking->transaction_id }}"  disabled>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="" class="form-label">Bill Code</label>
                                                                <div class="form-control-wrap">
                                                                <input type="text" class="form-control" value="{{ $booking->payment_status }}"  disabled>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="" class="form-label">Booking DateTime</label>
                                                                <div class="form-control-wrap">
                                                                <input type="text" class="form-control" value="{{ $booking->created_at ? Carbon\Carbon::parse($booking->created_at)->formatLocalized('%d %b %Y %I:%M:%S %p') : 'N/A' }}"  disabled>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="" class="form-label">Job Done Proof</label>
                                                                <div class="form-control-wrap">
                                                                @if($booking->jobdone_proof != '')
                                                                <a href="uploads/jobdone/{{ $booking->jobdone_proof }}" class="btn btn-primary btn-md" type="button" target="_blank">View/Download</a>
                                                                @else
                                                                N/A
                                                                @endif
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

                                                    <div class="col-lg-12">
                                                       
                                                       <a href="../bookings" class="btn btn-primary" type="button"><< Back</a>
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