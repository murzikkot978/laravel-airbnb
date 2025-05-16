<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Models\Apartment;
use App\Models\Photo;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PhpParser\Builder;

class ApartmentControlles extends Controller
{
    public function showNewProposition()
    {
        return view('newproposition');
    }

    public function newProposition(StoreApartmentRequest $request)
    {
        $apartment = new Apartment($request->validated());

        $apartment->user()->associate(Auth::user());
        $apartment->save();

        foreach ($request->file('photos') as $photo) {
            $photoNameToStore = Str::uuid() . '_' . $photo->getClientOriginalName();
            $photo->storeAs('uploads', $photoNameToStore, 'public');
            Photo::factory([
                'photo' => $photoNameToStore,
                'apartment_id' => $apartment->id,
            ])->create();
        }
        return redirect('/apartments');
    }

    public function showApartments(Request $request)
    {
        $request->validate([
            'where' => 'nullable|string',
            'min' => 'nullable|numeric|min:0',
            'max' => 'nullable|numeric|min:0',
            'rooms' => 'nullable|integer|min:1',
            'persons' => 'nullable|integer|min:1'
        ]);


        $filterApartment = Apartment::with('photos') // Подгружаем связанные фото
        ->when($request->where, fn($query) => $query->where('city', $request->where))
            ->when($request->min, fn($query) => $query->where('price', '>=', $request->min))
            ->when($request->max, fn($query) => $query->where('price', '<=', $request->max))
            ->when($request->rooms, fn($query) => $query->where('rooms', $request->rooms))
            ->when($request->persons, fn($query) => $query->where('peoples', $request->persons));

        $apartments = $filterApartment->get();


        return view('/apartments', ['apartments' => $apartments]);

    }

    public function showDetailsApartments(int $id)
    {
        $today = date('Y-m-d');

        $apartment = Apartment::with(['photos', 'user'])
            ->findOrFail($id);

        return view('detailsapartments', ['apartment' => $apartment], ['today' => $today]);
    }

    public function showEditApartment(int $id)
    {
        $apartment = Apartment::findOrFail($id);
        return view('editapartment', ['apartment' => $apartment]);
    }

    public function editApartment(UpdateApartmentRequest $request, int $id)
    {
        $apartment = Apartment::with('photos')->findOrFail($id);

        $apartment->update($request->validated());

        if ($request->hasFile('photos')) {
            foreach ($apartment->photos as $photo) {
                Storage::disk('public')->delete('uploads/' . $photo->photo);
            }
            Photo::where('apartment_id', $id)->delete();
            foreach ($request->file('photos') as $photo) {
                $photoNameToStore = Str::uuid()->toString() . '_' . $photo->getClientOriginalName();
                $photo->storeAs('uploads', $photoNameToStore, 'public');
                Photo::factory([
                    'photo' => $photoNameToStore,
                    'apartment_id' => $apartment->id,
                ])->create();
            }
        }
        return redirect('detailsapartments/' . $id);
    }

    public function deleteApartment(int $id)
    {
        $apartment = Apartment::with('photos')->findOrFail($id);

        foreach ($apartment->photos as $photo) {
            Storage::disk('public')->delete('uploads/' . $photo->photo);
        }
        Photo::where('apartment_id', $id)->delete();
        Apartment::where('id', $id)->delete();

        return redirect('apartments');
    }

    public function reservation(StoreReservationRequest $request, int $id)
    {


        $reservation = new Reservation($request->validated());

        $reservation->user()->associate(Auth::user());
        $reservation->apartment()->associate($id);
        $reservation->save();

        $apartment = Apartment::where('id', $id)->first();
        $apartment->reserved++;
        $apartment->save();

        return redirect('/apartments');
    }
}
