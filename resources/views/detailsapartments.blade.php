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
    @auth()
        @if(Auth::user()->id == $apartment->user_id || Auth::user()->role == 1)
            <div class="flex lg:flex-row justify-between w-full px-4 lg:px-80 gap-6">
                <a href="{{ route('apartments.edit', ['apartment' => $apartment]) }}"
                   class="bg-red-500 p-4 hover:bg-red-700 rounded-xl w-full max-w-md mx-auto text-center">Edit
                    apartment</a>
                <a href="{{ route('apartments.destroy', ['apartment' => $apartment->id]) }}"
                   class="bg-red-500 p-4 hover:bg-red-700 rounded-xl w-full max-w-md mx-auto text-center">Delete</a>
            </div>
        @endif
    @endauth

    <div class="flex flex-col lg:flex-row justify-between w-full px-4 lg:px-80 gap-6">

        <div class="flex flex-col w-full max-w-md mx-auto  p-6 rounded-lg space-y-3 text-center">
            <p class="text-xl font-semibold text-gray-800">{{ $apartment->title }}</p>

            <p class="text-gray-700">Rooms: {{ $apartment->rooms }} &nbsp; | &nbsp;
                Guests: {{ $apartment->peoples }}</p>

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

        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function () {
                let checkinInput = document.querySelector('#checkin');
                let checkoutInput = document.querySelector('#checkout');
                let priceNights = document.querySelector('.price-nights');
                let totalPrice = document.querySelector('.total-price');

                function updatePrice() {
                    console.log('update');
                    let checkinDate = new Date(checkinInput.value);
                    let checkoutDate = new Date(checkoutInput.value);
                    let differentsTime = checkoutDate - checkinDate;
                    let nights = differentsTime / (1000 * 60 * 60 * 24);
                    let price = {{ $apartment->price }};
                    if (nights > 0) {
                        priceNights.textContent = nights * price + '$';
                        totalPrice.textContent = nights * price + 90 + '$';
                    } else {
                        priceNights.textContent = '0$';
                        totalPrice.textContent = '0$';
                    }
                }

                checkinInput.addEventListener('change', updatePrice);
                checkoutInput.addEventListener('change', updatePrice);
            })
        </script>

        <div class="flex flex-col bg-gray-300 p-6 rounded-lg shadow-md w-full max-w-md mx-auto space-y-4">

            <div class="flex justify-between">
                <p class="text-lg font-semibold text-gray-700">Price per night: </p>
                <div class="flex">
                    <p class="pricePerNight text-lg font-semibold text-gray-700">{{ $apartment->price }}</p>
                    <p class="text-lg font-semibold text-gray-700">$</p>
                </div>

            </div>

            <form method="post" action="{{route('apartments.reservation', ['apartment' => $apartment])}}">
                @csrf
                <div class="flex gap-4">
                    <div class="flex flex-col flex-1">
                        <label for="checkin" class="text-sm text-gray-600">Check-in</label>
                        <input type="date" min="{{ $today }}" id="checkin" name="start_date" class="border rounded p-2"
                               required/>
                    </div>
                    <div class="flex flex-col flex-1">
                        <label for="checkout" class="text-sm text-gray-600">Checkout</label>
                        <input type="date" min="{{ $today }}" id="checkout" name="end_date" class="border rounded p-2"
                               required/>
                    </div>
                </div>

                <button type="submit" class="w-full bg-red-600 text-white rounded p-2 hover:bg-red-700 transition">
                    Reserve
                </button>
            </form>


            <div class="border-t pt-2 space-y-2 text-sm text-gray-700">
                <div class="flex justify-between">
                    <p>Price × nights</p>
                    <p class="price-nights">0$</p>
                </div>
                <div class="flex justify-between">
                    <p>Cleaning fee</p>
                    <p>90$</p>
                </div>
                <div class="flex justify-between font-semibold text-black border-t pt-2">
                    <p>Total</p>
                    <p class="total-price">0$</p>
                </div>
            </div>
        </div>

    </div>


</x-layout>
