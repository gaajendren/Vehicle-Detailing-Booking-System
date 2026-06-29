<div class="modal fade" id="exampleModalTop" data-bs-keyboard="false" tabindex="-1" aria-labelledby="scrollableLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollableLabel">Add New Staff</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {!! Form::open(array('url' => 'storestaff', 'method' => 'POST')) !!}

                <div class="modal-body">

                <input type="text" name="id" id="id" hidden>
                <input type="text" name="type" id="type" hidden>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Full Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" name="fullname" id="fullname" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Email</label>
                            <div class="form-control-wrap">
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Staff ID</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" name="staffid" id="staffid" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="mykad" class="form-label">IC Number</label>
                            <div class="form-control-wrap">
                                <input type="number" class="form-control" name="mykad" id="mykad" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Phone</label>
                            <div class="form-control-wrap">
                                <input type="number" class="form-control" name="phone" id="phone" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Status</label>
                            <div class="form-control-wrap">
                                <select class="form-control" name="status" id="status">
                                    <option value="" selected disabled>-- Select Status --</option>
                                    <option value="A">Active</option>
                                    <option value="I">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 passworddiv">
                            <label for="inputPassword4" class="form-label">Password <sup class="passwordtext">Entering password will replace existing password!</sup></label>
                            <div class="form-control-wrap">
                                <input type="password" class="form-control" name="password" id="password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*#?&]).{10,32}" title="Your password must be between 10 - 32 characters long and include uppercase letter (A-Z), lowercase letter (a-z), number (0-9) and special characters such as @$!%*#?&"  required>
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