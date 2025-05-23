<x-layout>

    <div class="bg-gray-300 p-8 rounded-lg shadow-lg w-full max-w-md m-auto">
        <h1 class="text-2xl font-bold mb-6 text-center">Register</h1>
        <form action="/registration" method="post" class="flex flex-col gap-4">
            @csrf
            <input type="text" name="name" id="name" placeholder="Username" class="border-2 rounded p-2"
                   required>
            <input type="email" name="email" id="email" placeholder="Email" class="border-2 rounded p-2" required>
            <input type="password" name="password" id="password" placeholder="Password" class="border-2 rounded p-2"
                   required>
            <input type="password" name="password_confirmation" id="password_confirmation"
                   placeholder="Confirm Password" class="border-2 rounded p-2" required>
            <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Register</button>
        </form>
        <p class="text-center text-sm text-gray-600 mt-4">
            Already have an account?
            <a href="/login" class="text-blue-500 hover:underline">Login</a>
        </p>
    </div>

</x-layout>
