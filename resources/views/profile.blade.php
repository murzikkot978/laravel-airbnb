<x-layout>

    <div class="flex flex-col gap-8 mt-14">
        <p class="text-6xl font-bold w-full flex justify-center">User Profile</p>

        <div class="grid md:grid-cols-2 gap-8 items-center justify-around">

            <div class="flex w-auto justify-center">
                @if(isset($user->photoprofile))
                    <img src="/storage/uploads/{{ $user->photoprofile->photoprofile }}" alt="Profile image"
                         class="h-64 w-64 rounded-full border-4 border-gray-300 shadow-xl">
                @else
                    <img src="/storage/uploads/default.png" alt="Profile image"
                         class="h-64 w-64 rounded-full border-4 border-gray-300 shadow-xl">
                @endif
            </div>

            <div class="flex flex-col justify-center w-auto">
                <p class="text-4xl font-semibold">Name: <span class="font-bold">{{ $user->name }}</span></p>
                <p class="text-4xl font-semibold mt-2">Email: <span class="font-bold">{{ $user->email }}</span></p>

                <div class="flex mt-6">
                    <a href="{{ route('editprofile', ['id' => $user->id]) }}"
                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-l-full w-full shadow-lg duration-300 ease-in-out">
                        Edit Profile
                    </a>
                    <a href="{{ route('deleteprofile', ['id' => $user->id]) }}"
                       class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-r-full w-full shadow-lg duration-300 ease-in-out">
                        Delete Profile
                    </a>
                </div>
            </div>
        </div>

        <div>
            <p class="text-3xl font-bold mb-6 text-center">My reservation</p>

            <div class="grid md:grid-cols-2 gap-6 mb-5">
                @foreach($user->reservations as $reservation)
                    <a href="{{ route('detailsapartments', ['id' => $reservation->apartment->id]) }}">
                        <div
                            class="bg-white rounded-2xl shadow-lg overflow-hidden transition-transform hover:scale-110">
                            @csrf
                            <img src="/storage/uploads/{{ $reservation->apartment->photos[0]->photo }}"
                                 class="w-full h-80 object-cover" alt="Post image">
                            <div class="p-4 flex justify-between">
                                <div class="p-4">
                                    <h2 class="text-lg font-semibold">{{ $reservation->apartment->city }}</h2>
                                    <p class="text-blue-600 font-bold">{{ $reservation->apartment->price }}</p>
                                </div>
                                <div class="p-4">
                                    <h2 class="text-lg font-semibold">Start : {{ $reservation->start_date }}</h2>
                                    <h2 class="text-lg font-semibold">End : {{ $reservation->end_date }}</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach

            </div>
        </div>

        <div>
            <p class="text-3xl font-bold mb-6 text-center">Your Apartments</p>

            <div class="grid md:grid-cols-2 gap-6 mb-5">
                @foreach($user->apartments as $apartment)
                    <a href="{{ route('detailsapartments', ['id' => $apartment->id]) }}">
                        <div
                            class="bg-white rounded-2xl shadow-lg overflow-hidden transition-transform hover:scale-110">
                            @csrf
                            <img src="/storage/uploads/{{ $apartment->photos[0]->photo }}"
                                 class="w-full h-80 object-cover" alt="Post image">
                            <div class="p-4">
                                <h2 class="text-lg font-semibold">{{ $apartment->city }}</h2>
                                <p class="text-blue-600 font-bold">{{ $apartment->price }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach

            </div>
        </div>
    </div>

</x-layout>
