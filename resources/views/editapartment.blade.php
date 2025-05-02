<x-layout>
    <div class="m-auto">
        <form class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gray-300 p-8 rounded-lg shadow-lg w-full">
                <h1 class="text-2xl font-bold mb-6 text-center">Edit information</h1>

                <div class="flex flex-col gap-4">
                    <input type="text" name="title" id="title" placeholder="Name apartment" class="border-2 rounded p-3"
                           required>
                    <textarea name="content" placeholder="Content" class="border-2 rounded p-3 resize-none"
                              rows="4"></textarea>
                    <input type="number" name="rooms" id="rooms" min="1" placeholder="Rooms"
                           class="border-2 rounded p-3" required>
                    <input type="number" name="peoples" id="peoples" min="1" placeholder="Max people"
                           class="border-2 rounded p-3" required>
                    <input type="number" name="price" id="price" placeholder="Price" class="border-2 rounded p-3"
                           required>
                    <input type="file" name="photo" id="photo" class="border-2 rounded p-3" multiple required>
                </div>
            </div>

            <div class="bg-gray-300 p-8 rounded-lg shadow-lg w-full">
                <h1 class="text-2xl font-bold mb-6 text-center">Edit location</h1>

                <div class="flex flex-col gap-4">
                    <input type="text" name="country" id="country" placeholder="Country" class="border-2 rounded p-3"
                           required>
                    <input type="text" name="city" id="city" placeholder="City" class="border-2 rounded p-3" required>
                    <input type="text" name="adress" id="adress" placeholder="Address" class="border-2 rounded p-3"
                           required>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d21959.20473994736!2d6.631473949999999!3d46.5298689!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sfr!2sch!4v1746184837321!5m2!1sfr!2sch"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

            <div class="md:col-span-2">
                <button type="submit"
                        class="w-full bg-blue-500 text-white p-3 rounded-lg font-semibold hover:bg-blue-600 transition">
                    Save changes
                </button>
            </div>
        </form>
    </div>
</x-layout>
