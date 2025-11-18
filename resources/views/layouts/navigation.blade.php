@php
    $user = auth()->user();
@endphp

<nav>
    @if ($user->isAdmin())
        <a href="{{ url('/admin') }}">Dashboard</a>
    @elseif ($user->isGuru())
        <a href="{{ url('/guru') }}">Dashboard</a>
    @elseif ($user->isSiswa())
        <a href="{{ route('siswa.dashboard') }}">Dashboard</a>
    @endif

    <!-- Logout -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</nav>
