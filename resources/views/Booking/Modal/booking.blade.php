<div class="modal fade" id="exampleModalTopBooking" data-bs-keyboard="false" tabindex="-1" aria-labelledby="scrollableLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modalbookingtitle" id="scrollableLabel">Add New Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {!! Form::open(array('url' => 'storebookingadmin', 'method' => 'POST')) !!}

                <div class="modal-body">

                <input type="text" name="idbook" id="idbook" hidden>



                <input type="text" name="typebook" id="typebook" hidden>

                <h4>Customer Details</h4>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label for="inputPassword4" class="form-label">Customer</label>
                            <div class="form-control-wrap">
                            <select class="form-control" name="created_by" id="created_by" required>
                                    <option value="" selected disabled>-- Select Customer --</option>
                                    @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                    data-email="{{ $customer->email }}"
                                         data-phone="{{ $customer->phone }}"
                                              data-address="{{ $customer->address }}"
                                    >{{ $customer->fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="inputPassword4" class="form-label">Email</label>
                            <div class="form-control-wrap">
                                <input type="email" class="form-control" name="email" id="email" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="inputPassword4" class="form-label">Phone</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" name="phone" id="phone" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Address</label>
                            <div class="form-control-wrap">
                            <textarea class="form-control p-4" name="address" id="address" readonly></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h4>Service Details</h4>
                    <div class="row g-4">
                    <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Service</label>
                            <div class="form-control-wrap">
                                <select class="form-control" name="service_id" id="service_id" required>
                                <option value="" selected disabled>-- Select Services --</option>
                                    @foreach($services as $service)
                                    <option value="{{ $service->id }}"
                                    data-price="{{ $service->service_price }}"
                                         data-desc="{{ $service->service_desc }}"
                                              >{{ $service->service_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="inputPassword4" class="form-label">Service Price</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" name="service_price" id="service_price" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Service Details</label>
                            <div class="form-control-wrap">
                            <textarea class="form-control p-4" name="service_desc" id="service_desc" readonly></textarea>
                            </div>
                        </div>

                    </div>

                <hr>
                    <h4>Booking Details</h4>
                    <div class="row g-4">
                    <div class="col-md-4">
                            <label for="inputPassword4" class="form-label">Booking Date</label>
                            <div class="form-control-wrap">
                            <div id="datepicker"></div>
                            <input type="date" name="book_date" id="book_date" hidden>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="inputPassword4" class="form-label">Booking Timeslot</label>
                            <div class="form-control-wrap">
                            <select class="form-control" name="book_timeslot" id="book_timeslot" required>
                            
                                </select>
                            </div>
                        </div>
                    
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Payment Status</label>
                            <div class="form-control-wrap">
                            <select class="form-control" name="payment_status" id="payment_status" required>
                            <option value="Success">Success</option>
                            <option value="Failed">Failed</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Booking Remarks</label>
                            <div class="form-control-wrap">
                            <textarea class="form-control p-4" name="remarks" id="remarks" maxlength="500" required></textarea>
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