<div class="modal fade" id="exampleModalTop" data-bs-keyboard="false" tabindex="-1" aria-labelledby="scrollableLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollableLabel">Add New Holiday</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {!! Form::open(array('url' => 'storeholidays', 'method' => 'POST')) !!}


                <div class="modal-body">

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="holiday_name" class="form-label">Holiday Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" name="holiday_name" id="holiday_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="holidays_date" class="form-label">Holiday Date</label>
                            <div class="form-control-wrap">
                                <input type="date" class="form-control" name="holidays_date" id="holidays_date" required>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary btnsubmit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>