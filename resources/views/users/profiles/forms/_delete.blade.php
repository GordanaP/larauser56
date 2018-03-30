<form action="{{ route('users.profiles.destroy', $user) }}" method="POST">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete the account?')">
        Delete profile
    </button>
</form>