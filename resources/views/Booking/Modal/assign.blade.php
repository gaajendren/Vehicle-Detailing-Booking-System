<div class="modal fade" id="exampleModalTop" data-bs-keyboard="false" tabindex="-1" aria-labelledby="scrollableLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollableLabel">Assign Staff</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {!! Form::open(array('url' => 'assignstaff', 'method' => 'POST')) !!}

                <div class="modal-body">

                <input type="text" name="id" id="id" hidden>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Booked Service</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" name="servicename" id="servicename" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Booked Timeslot</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" name="timeslot" id="timeslot" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Staff</label>
                            <div class="form-control-wrap">
                            <select class="form-control" name="assigned" id="assigned" required>
                             </select>
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