<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = User::where('id', $id)->first();
        User::where('id', $id)->update(['role' => $user->role == 0 ? 1 : 0]);

        return redirect('allusers');
    }
}
