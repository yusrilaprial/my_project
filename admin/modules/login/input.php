<div class="modal fade" id="mightywebModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Data User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="needs-validation mb-0" novalidate method="post" id="mightywebForm">
                <div class="modal-body">

                    <div class="form-group"><label for="email">Email</label>
                        <input type="email" class="form-control" required="required" name="email" data-toggle="datetimepicker" placeholder="Masukkan email...">
                        <div class="invalid-feedback">Error: this field is required.</div>
                    </div>
                    <div class="form-group"><label for="password">Password</label>
                        <input type="password" class="form-control" required="required" name="password" data-toggle="datetimepicker" placeholder="Masukkan password...">
                        <div class="invalid-feedback">Error: this field is required.</div>
                    </div>
                    <div class="form-group"><label>Level</label>
                        <div class="col-12">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" value="Admin" name="level" id="level-1" required="required">
                                <label class="custom-control-label" for="level-1">Admin</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" value="User" name="level" id="level-2" required="required">
                                <label class="custom-control-label" for="level-2">User</label>
                            </div>
                        </div>
                        <div class="invalid-feedback">Error: this field is required.</div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between border-dark">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>