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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'where' => 'nullable|string',
            'min' => 'nullable|numeric|min:0',
            'max' => 'nullable|numeric|min:0',
            'rooms' => 'nullable|integer|min:1',
            'persons' => 'nullable|integer|min:1'
        ]);


        $filterApartment = Apartment::with('photos')
            ->when($request->where, fn($query) => $query->where('city', $request->where))
            ->when($request->min, fn($query) => $query->where('price', '>=', $request->min))
            ->when($request->max, fn($query) => $query->where('price', '<=', $request->max))
            ->when($request->rooms, fn($query) => $query->where('rooms', $request->rooms))
            ->when($request->persons, fn($query) => $query->where('peoples', $request->persons));

        $apartments = $filterApartment->get();


        return view('/apartments', ['apartments' => $apartments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()) {
            return redirect('login');
        }
        return view('newproposition');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApartmentRequest $request)
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
        return redirect('apartments');
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        $today = date('Y-m-d');

        $apartment = Apartment::with(['photos', 'user'])
            ->findOrFail($apartment->id);

        return view('detailsapartments', ['apartment' => $apartment], ['today' => $today]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {


        Gate::authorize('user_is_owner_apartment', $apartment);

        return view('editapartment', ['apartment' => $apartment]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        $apartment = Apartment::with('photos')->findOrFail($apartment->id);

        $apartment->update($request->validated());

        if ($request->hasFile('photos')) {
            foreach ($apartment->photos as $photo) {
                Storage::disk('public')->delete('uploads/' . $photo->photo);
            }
            Photo::where('apartment_id', $apartment->id)->delete();
            foreach ($request->file('photos') as $photo) {
                $photoNameToStore = Str::uuid()->toString() . '_' . $photo->getClientOriginalName();
                $photo->storeAs('uploads', $photoNameToStore, 'public');
                Photo::factory([
                    'photo' => $photoNameToStore,
                    'apartment_id' => $apartment->id,
                ])->create();
            }
        }
        return redirect()->route('apartments.show', $apartment->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        $apartment = Apartment::with('photos')->findOrFail($apartment->id);

        Gate::authorize('user_is_owner_apartment', $apartment);

        foreach ($apartment->photos as $photo) {
            Storage::disk('public')->delete('uploads/' . $photo->photo);
        }
        Reservation::where('apartment_id', $apartment->id)->delete();
        Photo::where('apartment_id', $apartment->id)->delete();
        Apartment::where('id', $apartment->id)->delete();

        return redirect('apartments');
    }

    /**
     * Reservation apartment
     */
    public function reservation(StoreReservationRequest $request, Apartment $apartment)
    {

        if (!Auth::user()) {
            return redirect('login');
        }

        $reservation = new Reservation($request->validated());

        $reservation->user()->associate(Auth::user());
        $reservation->apartment()->associate($apartment->id);
        $reservation->save();

        return redirect('/apartments');
    }

    /**
     * Show apartment
     */
    public function apartment()
    {
        $treeMostRentedCities = Apartment::select('city', DB::raw('COUNT(reservations.id) as res_count'))
            ->join('reservations', 'apartments.id', '=', 'reservations.apartment_id')
            ->groupBy('city')
            ->orderByDesc('res_count')
            ->limit(3)
            ->get();

        $cities = $treeMostRentedCities->pluck('city');
        $allApartments = [];
        foreach ($cities as $city) {
            $apartments = Apartment::with('photos')->withCount('reservations')->orderBy('reservations_count', 'desc')->where('city', $city)->limit(2)->get();

            $allApartments[$city] = $apartments;
        }

        return view('homepage', ['allApartments' => $allApartments]);

    }
}
