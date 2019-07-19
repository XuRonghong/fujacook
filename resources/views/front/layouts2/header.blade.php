
<!-- Header -->
<header id="header">
    <a class="logo" href="index.html">Industrious</a>
    <nav>
        <a href="#menu">Menu</a>
        <form action="{{ url('admin/logout') }}" method="post" id="layouts-nav-form">
            {{ csrf_field() }}
            <a href="index.html">Home</a>
            <a href="generic.html">Generic</a>
            <a href="elements.html">Elements</a>
            @if (Route::has('login'))
                @if(Auth::guard('admin')->check())
                    {{--<a href="{{ url('/home') }}">Home</a>--}}
                    <a onclick="document.getElementById('layouts-nav-form').submit();" href="#">Logout</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    {{--<a href="{{ route('register') }}">Register</a>--}}
                @endAuth
            @endif
        </form>

        {{--@if (Route::has('login'))--}}
            {{--<div class="top-right links">--}}
                {{--@auth--}}
                    {{--<a href="{{ url('/home') }}">Home</a>--}}
                {{--@else--}}
                    {{--<a href="{{ route('login') }}">Login</a>--}}
                    {{--<a href="{{ route('register') }}">Register</a>--}}
                {{--@endauth--}}
            {{--</div>--}}
        {{--@endif--}}

    </nav>
</header>