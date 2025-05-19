<x-layout>

    <div class="mt-16">
        <p class="w-full text-center font-bold text-3xl mb-5">3 most popular place</p>
        @foreach($allApartments as $apartments)
            <p class="w-full text-center font-bold text-2xl mb-2">{{ $apartments[0]->city }}</p>
            <div class="grid md:grid-cols-3 gap-6 mb-5">
                @foreach($apartments as $apartment)
                    <a href="{{ route('detailsapartments', ['id' => $apartment->id]) }}">
                        <div
                            class="bg-white rounded-2xl shadow-lg overflow-hidden transition-transform hover:scale-110">
                            @csrf
                            <img src="/storage/uploads/{{ $apartment->photos[0]->photo }}"
                                 class="w-full h-48 object-cover" alt="Post image">
                            <div class="p-4">
                                <h2 class="text-lg font-semibold">{{ $apartment->city }}</h2>
                                <p class="text-blue-600 font-bold">{{ $apartment->price }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach

            </div>
        @endforeach
    </div>

</x-layout>
