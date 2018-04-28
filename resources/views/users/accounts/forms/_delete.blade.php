<form action="{{ route('users.accounts.destroy') }}" method="POST">

    @csrf
    @method('DELETE')

    <button type="submit" class="btn" onclick="return confirm('Are you sure you want to delete the account?')">
        Delete account
    </button>

</form>