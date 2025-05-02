<x-layout>

    <div class="glider-contain px-80 pt-20 pb-10">
        <button class="glider-prev ml-72 mt-32">«</button>
        <div class="glider">
            <img src="/storage/uploads/apartament-1.jpg"/>
            <img src="/storage/uploads/apartament-2.jpg"/>
            <img src="/storage/uploads/apartament-3.jpg"/>
            <img src="/storage/uploads/apartament-4.jpg"/>
            <img src="/storage/uploads/apartament-5.jpg"/>
            <img src="/storage/uploads/apartament-6.jpg"/>
            <img src="/storage/uploads/apartament-7.jpg"/>
            <img src="/storage/uploads/apartament-8.jpg"/>
            <img src="/storage/uploads/apartament-9.jpg"/>
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
            <p class="text-xl font-semibold text-gray-800">Apartment Title</p>

            <p class="text-gray-700">Rooms: 2 &nbsp; | &nbsp; Guests: 3</p>

            <p class="text-sm text-gray-600">
                Content for this apartment, like a short description that explains what the place offers.
            </p>

            <hr class="my-2 border-gray-300"/>

            <p class="text-gray-700"><span class="font-medium">Owner:</span> John Doe</p>
            <p class="text-gray-700"><span class="font-medium">Email:</span> john@example.com</p>

            <hr class="my-2 border-gray-300"/>

            <p class="text-gray-700"><span class="font-medium">Country:</span> France</p>
            <p class="text-gray-700"><span class="font-medium">City:</span> Paris</p>
            <p class="text-gray-700"><span class="font-medium">Address:</span> 123 Rue Lafayette</p>
        </div>

        <div class="flex flex-col bg-gray-300 p-6 rounded-lg shadow-md w-full max-w-md mx-auto space-y-4">

            <p class="text-lg font-semibold text-gray-700">Price per night</p>

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
