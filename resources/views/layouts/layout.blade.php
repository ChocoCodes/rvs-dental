@include('layouts.header')

<body>
@auth
    @include('layouts.navbar')
@endauth
<main class="h-content">
    @yield('content')
</main>
</body>
