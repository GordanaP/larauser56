<div class="modal" tabindex="-1" role="dialog" id="editPermissionModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <form id="editPermissionForm">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa fa-pencil mr-6"></i>
                        <span>Edit permission</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="required-fields mb-18">
                        <sup><i class="fa fa-asterisk fa-form"></i></sup> Required field.
                    </p>

                    <!-- Resources -->
                    <div class="form-group mb-4">
                        <label for="resource">Resource <sup><i class="fa fa-asterisk fa-form red"></i></sup></label>
                        <select class="form-control resource" name="resource" id="resource">
                            <option value="">Select a resource</option>
                            @foreach (Resources::all() as $resource)
                                <option value="{{ $resource }}"> {{ ucfirst($resource) }}
                                </option>
                            @endforeach
                        </select>

                        <span class="invalid-feedback resource"></span>
                    </div>

                    <!-- CRUD methods -->
                    <div class="form-group">
                        <label for="">Select a permission <sup><i class="fa fa-asterisk fa-form red"></i></sup></label>

                        @foreach (Cruds::all() as $key => $value)
                            <div class="form-check">
                                <input class="form-check-input permission" type="radio" name="permission" id="permission-{{ $key }}" value="{{ $key }}" />
                                <label class="form-check-label" for="{{ $key }}">{{ strtoupper($value) }}</label>
                            </div>
                        @endforeach

                        <span class="invalid-feedback permission"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-permission" id="updatePermission">Save changes</button>
                </div>
            </form>

        </div>
    </div>
</div>