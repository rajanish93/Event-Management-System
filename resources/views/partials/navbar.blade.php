<!-- resources/views/partials/navbar.blade.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('talk_proposals.index') }}">Event Management</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('talk_proposals.index') }}">Talk Proposals</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('reviewer.dashboard') }}">Reviewer Dashboard</a>
                </li>
                <li class="nav-item">
                    <!-- <a class="nav-link" href="{{ route('logout') }}">Logout</a> -->
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="nav-link" type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>