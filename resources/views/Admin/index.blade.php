@include('Include.appadmin')

                <!-- content -->
                <div class="nk-content">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="row g-gs">
                                    <div class="col-xl-12">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <div class="card-title">
                                                            <h4 class="title mb-1">Welcome Back {{ auth()->user()->fullname }}!</h4>
                                                            <p class="small">Current Month Sales</p>
                                                        </div>
                                                        <div class="my-3">
                                                        <div class="amount h2 fw-bold text-primary">RM {{ number_format($totalincome, 2) }}</div>

                                                        </div>
                                                        <a href="/bookings" class="btn btn-sm btn-primary">View Sales</a>
                                                    </div>
                                                    <div class="d-none d-sm-block d-xl-none d-xxl-block me-md-5 me-xxl-0">
                                                        <img src="images/award/a.png" alt="">
                                                    </div>
                                                </div>
                                            </div><!-- .card-body -->
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                    <div class="col-sm-4 col-xl-3 col-xxl-4">
                                        <a href="bookings">
                                                <div class="card h-100">
                                                    <div class="card-body">
                                                        <div class="media media-middle media-circle text-bg-success mb-3">
                                                            <em class="icon ni ni-calendar"></em>
                                                        </div>
                                                        <h5>Total Booking</h5>
                                                        <div class="d-flex align-items-center mb-3">
                                                            <div class="amount h4 mb-0">{{ $totalbooking }}</div>
                                                            <div class="change up smaller ms-1">
                                                            </div>
                                                        </div>
                                                    </div><!-- .card-body -->
                                                </div><!-- .card -->
                                        </a>
                                            </div><!-- .col -->
                                            <div class="col-sm-4 col-xl-3 col-xxl-4">
                                            <a href="services">
                                                <div class="card h-100">
                                                    <div class="card-body">
                                                        <div class="media media-middle media-circle text-bg-primary mb-3">
                                                            <em class="icon ni ni-shield-check"></em>
                                                        </div>
                                                        <h5>Total Services</h5>
                                                        <div class="d-flex align-items-center mb-3">
                                                            <div class="amount h4 mb-0">{{ $totalservices }}</div>
                                                            <div class="change up smaller ms-1">
                                                              
                                                            </div>
                                                        </div>
                                                    </div><!-- .card-body -->
                                                </div><!-- .card -->
                                            </a>
                                            </div><!-- .col -->
                                            <div class="col-sm-4 col-xl-3 col-xxl-4">
                                            <a href="stafflist">
                                                <div class="card h-100">
                                                    <div class="card-body">
                                                        <div class="media media-middle media-circle text-bg-warning mb-3">
                                                            <em class="icon ni ni-user-list"></em>
                                                        </div>
                                                        <h5>Total Staff</h5>
                                                        <div class="d-flex align-items-center mb-3">
                                                            <div class="amount h4 mb-0">{{ $totalstaff }}</div>
                                                            <div class="change up smaller ms-1">
                                                               
                                                            </div>
                                                        </div>
                                                    </div><!-- .card-body -->
                                                </div><!-- .card -->
                                            </a>
                                            </div><!-- .col -->
                                   
                                    

                                
                                            <div class="nk-block">
                                    <div class="card">
                                        
                                        <div class="card-body">
                                        <h1 class="nk-block-title">Confirmed Booking</h1>
                                            <div class="js-calendar" id="fullCalendar"></div>
                                        </div><!-- .card-body -->
                                    </div><!-- .card -->
                                </div><!-- .nk-block -->
                                
                                </div><!-- .row -->
                            </div>
                        </div>
                    </div>
                </div> <!-- .nk-content -->
               @include('Include.footer')
               <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
               <script src="assets/js/fullcalendar/fullcalendar.js"></script>