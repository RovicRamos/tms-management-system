<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderByDesc('user_id')->get();

        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = DB::table('roles')->orderBy('role_name')->get();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150', 'unique:users,email,' . $user->user_id . ',user_id'],
            'role_id' => ['required', 'exists:roles,role_id'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $before = $user->only(['first_name', 'last_name', 'email', 'role_id', 'is_active']);

        $user->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'role_id' => $validated['role_id'],
            'is_active' => $request->boolean('is_active'),
        ]);

        $after = $user->only(['first_name', 'last_name', 'email', 'role_id', 'is_active']);

        AdminLog::log('updated', 'user', $user->user_id, 'Updated user: ' . $user->email, [
            'before' => $before,
            'after' => $after,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if ((int) $user->role_id === 1 && User::where('role_id', 1)->count() === 1) {
            return back()->withErrors(['user' => 'You cannot delete the last administrator account.']);
        }

        $info = $user->only(['user_id', 'first_name', 'last_name', 'email', 'role_id']);
        $user->delete();
        AdminLog::log('deleted', 'user', $info['user_id'], 'Deleted user: ' . $info['email'], $info);

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}