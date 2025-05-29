<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('admin.users.index', [
            'users' => User::all(),
            'roles' => Role::all()
        ]);
    }

    public function assignRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name'
        ]);

        $user->syncRoles([$request->role]);

        return redirect()->back()->with('success', 'Role updated.');
    }
}
