<x-layout>

    <div class="bg-gray-300 p-8 rounded-lg shadow-lg w-full max-w-md  m-auto">
        @forEach ($users as $user)
            <div class="flex w-auto justify-between border-2 border-gray-300 rounded-md p-2">
                <p>{{ $user->name }}</p>
                <p>{{ $user->email }}</p>
                @if ($user->role)
                    <p>Admin</p>
                @else
                    <p>User</p>
                @endif
                <a href="{{ route('changeRole', ['id' => $user->id]) }}">Change role</a>
            </div>
        @endforeach
    </div>

</x-layout>
