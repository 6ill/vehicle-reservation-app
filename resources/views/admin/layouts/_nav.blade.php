<style>
    .main-nav { background-color: #333; padding: 1rem; margin-bottom: 2rem; }
    .main-nav a { color: white; text-decoration: none; margin-right: 1.5rem; }
    .main-nav form { display: inline; }
    .main-nav button { background: none; border: none; color: white; cursor: pointer; padding: 0; font-size: 1em; }
</style>

<nav class="main-nav">
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ route('admin.vehicles.index') }}">Manajemen Kendaraan</a>
    <a href="{{ route('admin.drivers.index') }}">Manajemen Driver</a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
            Logout
        </a>
    </form>
</nav>