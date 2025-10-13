<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index()
    {
        $users = User::with('roles')->latest()->paginate(15);
        
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        // Only root admin can create users
        if (!auth()->user()->isRoot()) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Only the root administrator can create new users.');
        }

        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(StoreUserRequest $request)
    {
        // Only root admin can create users
        if (!auth()->user()->isRoot()) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Only the root administrator can create new users.');
        }

        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        // Attach roles
        if ($request->has('roles')) {
            $user->roles()->sync($request->roles);
        }

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created successfully!');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        $user->load('roles');
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        // Root user can only be edited by themselves
        if ($user->isRoot() && $user->id !== auth()->id()) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'The root administrator account can only be edited by themselves.');
        }

        $roles = Role::all();
        $user->load('roles');
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // Root user can only be edited by themselves
        if ($user->isRoot() && $user->id !== auth()->id()) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'The root administrator account can only be edited by themselves.');
        }

        $data = $request->validated();

        // Only update password if provided
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        // Prevent changing is_root status
        unset($data['is_root']);

        $user->update($data);

        // Sync roles
        if ($request->has('roles')) {
            $user->roles()->sync($request->roles);
        } else {
            $user->roles()->detach();
        }

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        // Only root admin can delete users
        if (!auth()->user()->isRoot()) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Only the root administrator can delete users.');
        }

        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'You cannot delete your own account!');
        }

        // Prevent deleting root user
        if ($user->isRoot()) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'The root administrator account cannot be deleted!');
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User deleted successfully!');
    }
}
