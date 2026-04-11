<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-head/>
<body>
    <div id="app">
        <x-navbar/>

        <main class="py-4 force-font">
            @yield('content')
        </main>
    </div>
</body>
</html>
