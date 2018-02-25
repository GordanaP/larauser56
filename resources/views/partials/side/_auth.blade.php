<ul class="list-group list-group-flush">
    <li class="list-group-item">
        <a href="{{ route('users.accounts.edit', Auth::user()) }}">
            Edit account
        </a>
    </li>
    <li class="list-group-item">
        @include('users.accounts.forms._delete')
    </li>
    <li class="list-group-item">Morbi leo risus</li>
    <li class="list-group-item">Porta ac consectetur ac</li>
    <li class="list-group-item">Vestibulum at eros</li>
</ul>