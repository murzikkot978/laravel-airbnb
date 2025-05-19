<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glider-js@1/glider.min.css">
    <title>Registration</title>
</head>

<script src="https://cdn.jsdelivr.net/npm/glider-js@1/glider.min.js"></script>
<body class="flex h-screen w-screen flex-col pl-20 pr-20 items-center bg-gray-100">

<header class="flex fixed inset-x-0 z-20 h-14 w-screen items-center justify-center bg-blue-500 text-white">
    <nav class="flex w-screen pl-20 pr-20 justify-between">


        <div class="flex gap-5">
            <a href="http://localhost/">HOME</a>
            <a href="http://localhost/apartments">Apartments</a>
            @auth()
                @if(Auth::user()->role)
                    <a href="http://localhost/allusers">All users</a>
                @endif
            @endauth
        </div>

        <div class="flex gap-5">
            @auth
                <a href="http://localhost/newproposition">New apartment</a>

                <form id="logout" action="{{ url('logout') }}" method="get">
                    @csrf
                    <button type="submit">Log out</button>
                </form>

            @endauth
            @guest()
                <a href="http://localhost/login">Login</a>
            @endguest
        </div>

    </nav>
</header>

@if ($errors->any())
    <div class="bg-red-700 mt-14 text-white p-6 rounded-3xl shadow-lg w-full">
        <ul class="w-full">
            @foreach ($errors->all() as $error)
                <li class="w-full text-center text-xl">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{ $slot }}

</body>
</html>
