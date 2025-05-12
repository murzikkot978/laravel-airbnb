<x-layout>

    <form method="post" action="apartments" class="w-screen bg-blue-500 mt-14 py-4 text-white flex justify-center">
        @csrf
        <div class="flex gap-6 border-2 border-white rounded-2xl px-6 py-4 bg-white text-black shadow-md">
            <div class="flex flex-col items-start">
                <label for="where" class="mb-1 font-semibold">City</label>
                <input type="text" id="where" name="where" class="border border-gray-300 rounded-md px-2 py-1 w-40"/>
            </div>
            <div class="flex flex-col items-start">
                <label for="where" class="mb-1 font-semibold">Min Price</label>
                <input type="number" id="min" name="min" placeholder="0"
                       class="border border-gray-300 rounded-md px-2 py-1 w-40"/>
            </div>
            <div class="flex flex-col items-start">
                <label for="where" class="mb-1 font-semibold">Max Price</label>
                <input type="number" id="max" name="max" placeholder="0"
                       class="border border-gray-300 rounded-md px-2 py-1 w-40"/>
            </div>
            <div class="flex flex-col items-start">
                <label for="where" class="mb-1 font-semibold">Rooms</label>
                <input type="number" id="rooms" name="rooms" placeholder="0"
                       class="border border-gray-300 rounded-md px-2 py-1 w-40"/>
            </div>
            <div class="flex flex-col items-start">
                <label for="persons" class="mb-1 font-semibold">Persons</label>
                <input type="number" id="persons" name="persons" placeholder="0"
                       class="border border-gray-300 rounded-md px-2 py-1 w-40"/>
            </div>
            <div class="flex flex-col items-start justify-end">
                <button type="submit" class="bg-blue-500 border border-gray-300 rounded-md px-2 py-1 w-40">Submite
                </button>
            </div>
        </div>
    </form>


    <div class=" grid md:grid-cols-5 mt-8 gap-6 px-10 py-10">

        @foreach($apartments as $apartment)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transition-transform hover:scale-110">
                <img src="/storage/uploads/{{ $apartment->photos[0]->photo }}"
                     class="w-full h-48 object-cover" alt="Post image">
                <div class="p-4">
                    <h2 class="text-lg font-semibold">{{ $apartment->city }}</h2>
                    <p class="text-blue-600 font-bold">{{ $apartment->price }}</p>
                </div>
            </div>
        @endforeach
    </div>

</x-layout>
