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
                                                            <h3 class="title mb-1" style="color:blue;"><u>CREATE NEW SERVICE</u></h3>


                                                        </div>
                                                    </div>
                                                </div><!-- .nk-block-head-content -->

                                            </div><!-- .nk-block-head-between -->
                                        </div><!-- .nk-block-head -->
                                    </div><!-- .nk-block-head -->
                                

                                    {!! Form::open(array('url' => 'storeservice', 'method' => 'POST', 'files' => true)) !!}

                                    <div class="nk-block">
                                        <div class="card card-gutter-md">
                                            <div class="card-body">
                                                <div class="bio-block">
                                                    <h4 class="bio-block-title mb-4" style="color:blue;"><u>1. SERVICE INFORMATION</u></h4>
                                                    <div class="row g-3">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="firstname" class="form-label">Service Name</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" id="service_name" name="service_name" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="lastname" class="form-label">Service Price</label>
                                                                <div class="form-control-wrap">
                                                                <input type="number" step="0.01" class="form-control" id="service_price" name="service_price" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="lastname" class="form-label">Service Hours</label>
                                                                <div class="form-control-wrap">
                                                                <input type="number" min="1" class="form-control" id="service_hours" name="service_hours" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label for="firstname" class="form-label">Service Image</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="file" class="form-control" id="service_image" name="service_image" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="remarks" class="form-label">Service Details</label>
                                                                <div class="form-control-wrap">
                                                                    <textarea class="form-control" maxlength="500" rows="10" name="service_desc" id="service_desc" required></textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <button class="btn btn-primary" type="submit">Submit</button>
                                                            <a href="../services" class="btn btn-danger" type="button">Cancel</a>
                                                        </div>
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