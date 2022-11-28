<div class="modal fade" id="mightywebModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Title Form</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="needs-validation mb-0" novalidate method="post" id="mightywebForm" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="form-group"><label>Photo</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="input_file1" name="photo" required="required">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                        <div class="invalid-feedback">Error: this field is required.</div>
                    </div>
                    <div class="form-group"><label for="deskripsi">Deskripsi</label>
                        <textarea type="text" class="form-control" required="required" name="deskripsi"></textarea>
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