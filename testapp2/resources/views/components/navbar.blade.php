<nav class="navbar navbar-expand-md navbar-light d-flex justify-content-end justify-content-md-between flex-row-reverse" style="background-color:#f3f7fa">
    <ul class="d-none d-md-flex navbar-nav">
        <li class="nav-item">
            <a class="nav-link btn nav-btn" href="{{ route('settings') }}">Settings</a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn nav-btn" href="{{ route('logout') }}">Log out</a>
        </li>
    </ul>
    <div class="d-flex justify-content-start align-items-center">
        <a class="navbar-brand" href="{{ route('item.index') }}"><img src="{{ asset('storage/logo.png') }}" width=200px height=auto></a>
        <ul class="d-none d-md-flex navbar-nav">
            <li class="nav-item">
                <a class="nav-link btn nav-btn" href="{{ route('item.index') }}">Inventory</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn nav-btn" href="{{ route('export') }}">Export</a>
            </li>
        </ul>
    </div>
    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#dropdown" aria-controls="dropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="dropdown">
            <ul class="dropdown-menu" id="dropdown">
                <li class="dropdown-item">
                    <a class="dropdown-item" href="{{ route('item.index') }}">Inventory</a>
                </li>
                <li class="dropdown-item">
                    <a class="dropdown-item" href="{{ route('export') }}">Export</a>
                </li>
                <li class="dropdown-item">
                    <a class="dropdown-item" href="{{ route('settings') }}">Settings</a>
                </li>
                <li class="dropdown-item">
                    <a class="dropdown-item" href="{{ route('logout') }}">Log out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>