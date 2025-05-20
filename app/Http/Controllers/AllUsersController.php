<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Photo;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function deleteProfile($id)
    {

        $apartment = Apartment::with('photos')->findOrFail($id);

        foreach ($apartment->photos as $photo) {
            Storage::disk('public')->delete('uploads/' . $photo->photo);
        }
        Photo::where('apartment_id', $id)->delete();
        Reservation::where('user_id', $id)->delete();
        Apartment::where('user_id', $id)->delete();
        User::where('id', $id)->delete();

        return view('login');
    }
}
