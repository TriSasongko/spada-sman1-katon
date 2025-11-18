<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="text-sm font-medium text-white">
        Logout
    </button>
</form>
