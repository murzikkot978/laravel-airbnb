<x-layout>
    <div class="glider-contain px-80 pt-20 pb-10">
        <button class="glider-prev ml-72 mt-32">«</button>
        <div class="glider">
            @foreach($apartment->photos as $photo)
                <img src="/storage/uploads/{{ $photo->photo }}" alt="Photo apartment">
            @endforeach
        </div>
        <button class="glider-next mr-72 mt-32">»</button>
    </div>
    <div class="dots mt-4 text-center"></div>
    <script>
        window.addEventListener('load', function () {
            new Glider(document.querySelector('.glider'), {
                slidesToShow: 2,
                dots: '.dots',
                arrows: {
                    prev: '.glider-prev',
                    next: '.glider-next'
                }
            });
        })
    </script>
    <div class="flex flex-col lg:flex-row justify-between w-full px-4 lg:px-80 gap-6">

        <div class="flex flex-col w-full max-w-md mx-auto  p-6 rounded-lg space-y-3 text-center">
            <p class="text-xl font-semibold text-gray-800">{{ $apartment->title }}</p>

            <p class="text-gray-700">Rooms: {{ $apartment->rooms }} &nbsp; | &nbsp; Guests: {{ $apartment->peoples }}</p>

            <p class="text-sm text-gray-600">
                {{ $apartment->content }}
            </p>

            <hr class="my-2 border-gray-300"/>

            <p class="text-gray-700"><span class="font-medium">Owner:</span> {{ $apartment->user->name }}</p>
            <p class="text-gray-700"><span class="font-medium">Email:</span> {{ $apartment->user->email }}</p>

            <hr class="my-2 border-gray-300"/>

            <p class="text-gray-700"><span class="font-medium">Country:</span> {{ $apartment->country }}</p>
            <p class="text-gray-700"><span class="font-medium">City:</span> {{ $apartment->city }}</p>
            <p class="text-gray-700"><span class="font-medium">Address:</span> {{ $apartment->street }}</p>
        </div>

        <div class="flex flex-col bg-gray-300 p-6 rounded-lg shadow-md w-full max-w-md mx-auto space-y-4">

            <p class="text-lg font-semibold text-gray-700">Price per night: {{ $apartment->price }}</p>

            <div class="flex gap-4">
                <div class="flex flex-col flex-1">
                    <label for="checkin" class="text-sm text-gray-600">Check-in</label>
                    <input type="date" id="checkin" name="checkin" class="border rounded p-2"/>
                </div>
                <div class="flex flex-col flex-1">
                    <label for="checkout" class="text-sm text-gray-600">Checkout</label>
                    <input type="date" id="checkout" name="checkout" class="border rounded p-2"/>
                </div>
            </div>

            <button class="w-full bg-red-600 text-white rounded p-2 hover:bg-red-700 transition">
                Reserve
            </button>

            <div class="border-t pt-2 space-y-2 text-sm text-gray-700">
                <div class="flex justify-between">
                    <p>Price × nights</p>
                    <p>$450</p>
                </div>
                <div class="flex justify-between">
                    <p>Cleaning fee</p>
                    <p>$90</p>
                </div>
                <div class="flex justify-between font-semibold text-black border-t pt-2">
                    <p>Total</p>
                    <p>$540</p>
                </div>
            </div>
        </div>

    </div>


</x-layout>
