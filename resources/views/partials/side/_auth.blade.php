<ul class="list-group list-group-flush">
    <li class="list-group-item">
        <a href="{{ route('users.accounts.edit', $user) }}">
            Edit account
        </a>
    </li>
    <li class="list-group-item">
        <form action="{{ route('users.accounts.destroy', $user) }}" method="POST">

            @method('DELETE')
            @csrf

            <button type="submit" class="btn btn-link" onclick="return confirm('Are you sure you want to delete the account?')">
                Delete account
            </button>

        </form>
    </li>
    <li class="list-group-item">Morbi leo risus</li>
    <li class="list-group-item">Porta ac consectetur ac</li>
    <li class="list-group-item">Vestibulum at eros</li>
</ul>