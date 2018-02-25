<form action="{{ route('users.accounts.destroy', Auth::user()) }}" method="POST">

    @method('DELETE')
    @csrf

    <button type="submit" class="btn" onclick="return confirm('Are you sure you want to delete the account?')">
        Delete account
    </button>

</form>