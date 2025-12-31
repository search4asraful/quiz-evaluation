<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function destroy(User $user)
    {
        // Prevent admin from deleting themselves
        if (auth('web')->id() === $user->id) {
            notyf()->error('You cannot delete your own account');
            return back();
        }
        // Delete user
        $user->delete();
        notyf()->success('User deleted successfully');
        return back();
    }
}
