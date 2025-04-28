<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <title>Registration</title>
</head>

<body class="h-screen w-screen flex items-center justify-center bg-gray-100">

<div class="bg-gray-300 p-8 rounded-lg shadow-lg w-full max-w-md">
    <h1 class="text-2xl font-bold mb-6 text-center">Register</h1>
    <form class="flex flex-col gap-4">
        <input type="text" name="username" id="username" placeholder="Username" class="border-2 rounded p-2" required>
        <input type="email" name="email" id="email" placeholder="Email" class="border-2 rounded p-2" required>
        <input type="password" name="password" id="password" placeholder="Password" class="border-2 rounded p-2" required>
        <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Register</button>
    </form>
    <p class="text-center text-sm text-gray-600 mt-4">
        Already have an account?
        <a href="/login" class="text-blue-500 hover:underline">Login</a>
    </p>
</div>

</body>
</html>
