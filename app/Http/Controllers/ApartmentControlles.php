<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApartmentControlles extends Controller
{
    public function showNewProposition()
    {
        return view('newproposition');
    }

    public function newProposition(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'rooms' => 'required|integer',
            'peoples' => 'required|integer',
            'price' => 'required|integer',
            'country' => 'required',
            'city' => 'required',
            'street' => 'required',
            'photos' => 'required|array',
            'photos.*' => 'file|mimes:jpg,png,jpeg|max:2048',
        ]);


        $apartment = new Apartment([
            'title' => $request->title,
            'content' => $request->description,
            'rooms' => $request->rooms,
            'peoples' => $request->peoples,
            'price' => $request->price,
            'country' => $request->country,
            'city' => $request->city,
            'street' => $request->street,
        ]);

        $apartment->user()->associate(Auth::user());
        $apartment->save();

        foreach ($request->file('photos') as $photo) {
            $photoNameToStore = time() . '_' . $photo->getClientOriginalName();
            $photo->storeAs('uploads', $photoNameToStore, 'public');
            Photo::factory([
                'photo' => $photoNameToStore,
                'apartment_id' => $apartment->id,
            ])->create();
        }
        return redirect('/apartments');
    }

    public function showApartments()
    {

        $apartments = Apartment::with('photos')->get();

        return view('/apartments', ['apartments' => $apartments]);
    }

    public function sortApartments(Request $request)
    {
        $request->validate([
            'where' => 'required|string',
            'min' => 'required|numeric|min:0',
            'max' => 'required|numeric|min:0|gte:min',
            'rooms' => 'required|integer|min:1',
            'persons' => 'required|integer|min:1'
        ]);

        if (empty($request->all())) {
            $apartments = Apartment::with('photos')->get();

        } else {
            $apartments = Apartment::with('photos')
                ->where('city', $request->where)
                ->where('price', '>=', $request->min)
                ->where('price', '<=', $request->max)
                ->where('rooms', $request->rooms)
                ->where('peoples', $request->persons)
                ->get();
        }

        return view('/apartments', ['apartments' => $apartments]);
    }

    public function showDetailsApartments(int $id)
    {
        $apartment = Apartment::with(['photos', 'user'])
            ->findOrFail($id);

        return view('detailsapartments', ['apartment' => $apartment]);
    }

    public function showEditApartment(int $id)
    {
        $apartment = Apartment::findOrFail($id);
        return view('editapartment', ['apartment' => $apartment]);
    }

    public function editApartment(Request $request, int $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'rooms' => 'required|integer',
            'peoples' => 'required|integer',
            'price' => 'required|integer',
            'country' => 'required',
            'city' => 'required',
            'street' => 'required',
            'photos' => 'array',
            'photos.*' => 'file|mimes:jpg,png,jpeg|max:2048',
        ]);

        $apartment = Apartment::with('photos')->findOrFail($id);

        $apartment->update([
            'title' => $request->title,
            'content' => $request->description,
            'rooms' => $request->rooms,
            'peoples' => $request->peoples,
            'price' => $request->price,
            'country' => $request->country,
            'city' => $request->city,
            'street' => $request->street,
        ]);

        if ($request->hasFile('photos')) {
            foreach ($apartment->photos as $photo) {
                Storage::disk('public')->delete('uploads/' . $photo->photo);
            }
            Photo::where('apartment_id', $id)->delete();
            foreach ($request->file('photos') as $photo) {
                $photoNameToStore = time() . '_' . $photo->getClientOriginalName();
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
}
