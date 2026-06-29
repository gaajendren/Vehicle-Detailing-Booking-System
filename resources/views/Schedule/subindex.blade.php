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
            <h2 class="nk-block-title">Schedule Management</h1>
        </div>

        


</div><!-- .nk-block-head -->
<div class="nk-block">
    <div class="card">

    {!! Form::open(array('url' => 'postschedule', 'method' => 'POST', 'files' => true)) !!}
            <div class="row">

    
                
                <center>
                <div class="col-lg-7" style="margin-top: 50px;">
                        <h2>Select Services</h2>
                        <div class="form-group">
                        <select class="form-control" name="service" id="service" style="height: 50px; text-align:center;" required>
                                    <option value="" selected disabled>-- Select Services --</option>
                                    @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                                    @endforeach
                                </select>
                        </div>
                        <button class="btn btn-block btn-primary py-3" style="margin-top: 50px; margin-bottom:50px;" type="submit">Schedule</button>
                    </div>
                </center>
      
            </div>
           
            

        </form>
     

    </div><!-- .card -->
</div><!-- .nk-block -->
</div>
</div>
</div>
</div> <!-- .nk-content -->
@include('Include.footer')