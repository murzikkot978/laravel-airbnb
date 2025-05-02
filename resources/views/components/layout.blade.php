<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    @vite('resources/css/app.css')
    <title>Registration</title>
</head>

<body class="flex h-screen w-screen flex-col pl-20 pr-20 items-center bg-gray-100">

<header class="flex fixed inset-x-0 z-20 h-14 w-screen items-center justify-center bg-blue-500 text-white">
    <nav class="flex w-screen pl-20 pr-20 justify-between">

        <a href="http://localhost/apartments">Apartments</a>

        <div class="flex gap-5">
            <a href="http://localhost/editapartment">Edit apartment</a>
            <a href="http://localhost/newproposition">New apartment</a>
            <a href="http://localhost/login">Login</a>
            <a href="http://localhost/registration">Register</a>
        </div>

    </nav>
</header>

{{ $slot }}

</body>
</html>
