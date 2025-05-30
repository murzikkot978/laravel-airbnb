<x-layout>

    <div class="bg-gray-100 h-screen">
        <div class="bg-white shadow-md rounded-lg h-auto p-4 mt-14">
            <h1 class="text-2xl font-bold text-gray-700 text-center mb-6">User Management</h1>
            @foreach($users as $user)
                <div class="flex justify-between items-center  mb-4 gap-5">
                    @if (!isset($user->photoprofile))
                        <img src="/storage/uploads/default.png"
                             class="h-12 w-12 rounded-full border-2 border-gray-300 shadow-xl">
                    @else
                        <img src="/storage/uploads/{{ $user->photoprofile->photoprofile }}"
                             class="h-12 w-12 rounded-full border-2 border-gray-300 shadow-xl">
                    @endif

                    <div class="flex flex-col">
                        <h2>{{ $user->name }}</h2>
                        <h2>{{ $user->email }}</h2>
                    </div>


                    @if ($user->role)
                        <h2 class="bg-green-400 rounded-full p-2 w-16 text-center">admin</h2>
                    @else
                        <h2 class="bg-red-400 rounded-full p-2 w-16 text-center">user</h2>
                    @endif

                    <a href="{{ route('changeRole', ['id' => $user->id]) }}"
                       class="bg-gray-200 p-2 rounded-full hover:bg-gray-400">Change role</a>

                        <a href="{{ route('editprofile', ['id' => $user->id]) }}"
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold p-2  rounded-full shadow-lg">
                            Edit Profile
                        </a>
                </div>
            @endforeach
        </div>
    </div>

</x-layout>
