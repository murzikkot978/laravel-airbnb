<x-layout>

    <div class="bg-gray-300 p-8 rounded-lg shadow-lg w-full max-w-md m-auto">
        <h1 class="text-2xl font-bold mb-6 text-center">Edit profile</h1>
        <form method="post" action="{{ route('users.update', ['user' => $user]) }}" class="flex flex-col gap-4"
              enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" id="name" placeholder="Username" value="{{ $user->name }}"
                   class="border-2 rounded p-2"
                   required>
            <input type="email" name="email" id="email" placeholder="Email" value="{{ $user->email }}"
                   class="border-2 rounded p-2" required>
            <input type="password" name="password" id="password" placeholder="Password"
                   class="border-2 rounded p-2">
            <input type="password" name="password_confirmation" id="password_confirmation"
                   placeholder="Confirm Password" class="border-2 rounded p-2">
            <input type="file" name="photoprofile" class="border-2 rounded p-2">
            <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Confirm edit</button>
        </form>
    </div>

</x-layout>
