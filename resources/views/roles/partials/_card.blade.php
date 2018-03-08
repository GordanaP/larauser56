<div class="col-md-4">
    <div class="card mb-4 box-shadow bg-lightest-gray">
        <div class="card-body">
            <h5 class="mb-3">
                <a class="ls-1 text-uppercase text-bold-grey">
                    {{ $role->name }}
                </a>
            </h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.</p>

            <div class="flex justify-between">
                <div class="div">
                    <a class="btn btn-danger btn-edit" href="{{ route('admin.roles.show', $role) }}">
                        Details
                    </a>
                    <button type="button" class="btn btn-danger btn-delete" id="editRole" value="{{ $role->id }}">
                        Edit
                    </button>
                </div>
                <button type="button" class="btn btn-danger btn-delete" id="deleteRole" value="{{ $role->id }}">
                    <i class="fa fa-trash fs-18"></i>
                </button>
            </div>
        </div>
    </div>
</div>