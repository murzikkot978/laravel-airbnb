<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Apartment;
use App\Models\Photo;
use App\Models\PhotoProfile;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AllUsersController extends Controller
{
    public function showAllUsers()
    {
        if (!Auth::user()->role) {
            abort(403);
        }
        $users = User::all();
        return view('allusers', ['users' => $users]);
    }

    public function changeRole($id)
    {
        if (Auth::user()->id == $id) {
            return redirect('allusers');
        }
        $user = User::where('id', $id)->first();
        User::where('id', $id)->update(['role' => $user->role == 0 ? 1 : 0]);

        return redirect('allusers');
    }

    public function showProfile()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = User::with(['apartments.photos', 'reservations.apartment'])->find(Auth::id());

        return view('profile', ['user' => $user]);
    }

    public function deleteProfile(int $id)
    {

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
        User::where('id', $id)->delete();

        return view('login');
    }

    public function showEditProfile(int $id)
    {
        $user = User::with('photoprofile')->find($id);
        return view('editprofile', ['user' => $user]);
    }

    public function editProfile(UpdateUserRequest $request, int $id)
    {
        $user = User::with('photoprofile')->find($id);
        if (isset($request->password)) {
            $user->update($request->validated());
        } else {
            $user->update($request->except('password'));
        }

        if ($request->hasFile('photoprofile')) {
            if (isset($user->photoprofile)) {
                Storage::disk('public')->delete('uploads/' . $user->photoprofile->photoprofile);
            }
            PhotoProfile::where('user_id', $id)->delete();


            $photoNameToStore = Str::uuid()->toString() . '_' . $request->file('photoprofile')->getClientOriginalName();
            $request->file('photoprofile')->storeAs('uploads', $photoNameToStore, 'public');
            PhotoProfile::create([
                'photoprofile' => $photoNameToStore,
                'user_id' => $id,
            ]);
        }

        return redirect('profile');
    }
}
