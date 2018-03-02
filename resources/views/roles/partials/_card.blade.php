<div class="col-md-4">
    <div class="card mb-4 box-shadow bg-lightest-gray">
        <div class="card-body">
            <h5 class="mb-3">
                <a class="ls-1 text-uppercase text-bold-grey">
                    {{ $role->name }}
                </a>
            </h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.</p>

            <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-danger btn-edit">Edit</a>
            <button class="btn btn-danger btn-delete">Delete</button>
        </div>
    </div>
</div>