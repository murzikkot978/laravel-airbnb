<x-layout>

    <div class="bg-gray-300 p-8 rounded-lg shadow-lg w-full max-w-md items-center m-auto">
        <h1 class="text-2xl font-bold mb-6 text-center">Log in</h1>
        <form class="flex flex-col gap-4">

            <input type="email" name="email" id="email" placeholder="Email" class="border-2 rounded p-2" required>
            <input type="password" name="password" id="password" placeholder="Password" class="border-2 rounded p-2" required>
            <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Log in</button>
        </form>
        <p class="text-center text-sm text-gray-600 mt-4">
            Do not have an account?
            <a href="/registration" class="text-blue-500 hover:underline">Register</a>
        </p>
    </div>

</x-layout>
