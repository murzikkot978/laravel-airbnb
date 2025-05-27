<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Apartment;
use App\Models\Photo;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('user_is_admin');

        $users = User::all();
        return view('allusers', ['users' => $users]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        Gate::authorize('user_is_owner_profile', $user->id);

        $user = User::with(['apartments.photos', 'reservations.apartment'])->find($user->id);

        return view('profile', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('user_is_owner_profile', $id);

        $user = User::find($id);
        return view('editprofile', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        Gate::authorize('user_is_owner_profile', $user->id);

        if (isset($request->password)) {
            $user->update($request->validated());
        } else {
            $user->update($request->except('password'));
        }

        if ($request->hasFile('photoprofile')) {
            if ($user->photoprofile !== 'default.png') {
                Storage::disk('public')->delete('uploads/' . $user->photoprofile);
            }

            $photoNameToStore = Str::uuid()->toString() . '_' . $request->file('photoprofile')->getClientOriginalName();
            $request->file('photoprofile')->storeAs('uploads', $photoNameToStore, 'public');
            User::where('id', $user->id)->update(['photoprofile' => $photoNameToStore]);
        }

        return redirect()->route('users.show', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('user_is_owner_profile', $id);

        $user = User::with(['apartments.photos', 'reservations.apartment'])->find($id);

        foreach ($user->apartments as $apartment) {
            foreach ($apartment->photos as $photo) {
                Storage::disk('public')->delete('uploads/' . $photo->photo);
            }
            Photo::where('apartment_id', $apartment->id)->delete();
            Reservation::where('apartment_id', $apartment->id)->delete();
        }
        Reservation::where('user_id', $id)->delete();
        Apartment::where('user_id', $id)->delete();
        if ($user->photoprofile !== 'default.png') {
            Storage::disk('public')->delete('uploads/' . $user->photoprofile);
        }
        User::where('id', $id)->delete();

        return view('login');
    }

    /**
     * Change role for user
     */
    public function changeRole(User $user)
    {
        if (Auth::user()->id === $user->id) {
            return redirect()->route('users.index');
        }
        $user->role = !$user->role;
        $user->save();

        return redirect()->route('users.index');
    }
}
