<nav class="navbar navbar-expand-md navbar-light" style="justify-content:flex-start; background-color:#f3f7fa">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar" style="margin-right:1rem">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{ route('item.index') }}"><img src="{{ asset('storage/logo.png') }}" width=200px height=auto></a>
    <div class="collapse navbar-collapse d-flex justify-content-between" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link btn nav-btn" href="{{ route('item.index') }}">Inventory</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn nav-btn" href="{{ route('export') }}">Export</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link btn nav-btn" href="{{ route('settings') }}">Settings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn nav-btn" href="{{ route('logout') }}">Log out</a>
            </li>
        </ul>
    </div>
</nav>