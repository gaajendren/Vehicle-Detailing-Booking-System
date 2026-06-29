<div class="modal fade" id="exampleModalTop" data-bs-keyboard="false" tabindex="-1" aria-labelledby="scrollableLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollableLabel">Add New Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {!! Form::open(array('url' => 'storeschedule', 'method' => 'POST')) !!}

            <input type="hidden" name="id" id="id" value="{{ $id }}">

                <div class="modal-body">

                    <div class="row g-4">
                        <div class="col-md-12">
                            <label for="inputPassword4" class="form-label">Schedule Time</label>
                            <div class="form-control-wrap">
                                <input type="time" class="form-control" name="schedule_time" id="schedule_time" required>
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