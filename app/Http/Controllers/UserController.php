<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('users.index', compact('users'));
    }

    public function updateRoles(Request $request, User $user)
    {
        $user->syncRoles([$request->role]);
        return redirect()->route('users.index')->with('success', 'Role updated successfully.');
    }
}
