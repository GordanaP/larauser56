<ul class="list-group list-group-flush">
    <li class="list-group-item">
        <a href="{{ route('users.accounts.edit', $user) }}">
            Edit account
        </a>
    </li>
    <li class="list-group-item">
        <a href="{{ route('users.profiles.edit', $user) }}">
            Edit profile
        </a>
    </li>
    <li class="list-group-item">
        <a href="#">
            Change avatar
        </a>
    </li>
    <li class="list-group-item">
        @include('users.accounts.forms._delete')
    </li>
    <li class="list-group-item">Vestibulum at eros</li>
</ul>