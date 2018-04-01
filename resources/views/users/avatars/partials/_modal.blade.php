<div class="modal fade" tabindex="-1" role="dialog" id="avatarModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fa fa-user-circle"></i>
                    <span></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- FORM -->
            <form id="adminAvatarForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">

                        <!-- Avatar image -->
                        <div class="col-lg-4 col-sm-4 mb-12" id="showAvatar"></div>

                        <div class="col-lg-8 col-sm-8">
                            <p class="required-fields mb-18">
                                <sup><i class="fa fa-asterisk fa-form"></i></sup> Required field
                            </p>

                            <!-- Avatar options -->
                            <div class="form-group">
                                <label for="avatar_options">Avatar <span class="red">&#42;</span></label>
                                <select name="avatar_options" id="avatar_options" class="form-control avatar_options">
                                    <option value="">Choose an avatar</option>
                                    @foreach (AvatarOptions::all() as $value => $text)
                                        <option value="{{ $value }}">{{ $text }}</option>
                                    @endforeach
                                </select>

                                <span class="invalid-feedback avatar_options"></span>
                            </div>

                            <!-- Avatar -->
                            <div class="form-group mt-30">
                                <input type="file" class="avatar" name="avatar" id="avatar" />

                                <span class="invalid-feedback avatar"></span>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveAvatar">
                        Save changes
                    </button>
                </div>
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->