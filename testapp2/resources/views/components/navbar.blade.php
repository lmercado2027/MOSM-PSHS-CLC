<nav class="navbar navbar-expand-md navbar-light d-flex justify-content-end justify-content-md-between flex-row-reverse" style="background-color:#f3f7fa">
    @guest
        <ul class="d-none d-md-flex navbar-nav">
            @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link btn nav-btn" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @endif
        </ul>
    @else
        <a id="navbarDropdown" class="nav-link d-none d-md-inline dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }}
        </a>
        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('settings') }}">Settings</a>
            <a class="dropdown-item" href="{{ route('nurses') }}">Nurse List</a>
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </ul>
    @endguest
    <div class="d-flex justify-content-start align-items-center">
        <a class="navbar-brand" href="{{ route('item.index') }}"><img src="{{ asset('storage/logo.png') }}" width=200px height=auto></a>
        @auth
            <ul class="d-none d-md-flex navbar-nav">
                <li class="nav-item">
                    <a class="nav-link btn nav-btn" href="{{ route('item.index') }}">Inventory</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn nav-btn" href="{{ route('export') }}">Export</a>
                </li>
            </ul>
        @endauth
    </div>
    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#dropdown" aria-controls="dropdown" aria-expanded="false" aria-label="Toggle navigation" style="margin-right: 1em">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="dropdown">
            <ul class="dropdown-menu" id="dropdown">
                @guest
                    @if (Route::has('login'))
                        <li class="dropdown-item">
                            <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                @else
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
                        <a class="dropdown-item" href="{{ route('nurses') }}">Nurse List</a>
                    </li>
                    <li class="dropdown-item">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>