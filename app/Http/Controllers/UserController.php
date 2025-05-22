<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $query = User::query();

        // Filter by role if specified
        if (request('role')) {
            $query->where('role', request('role'));
        }

        // Filter by class year if specified
        if (request('class_year')) {
            $query->where('class_year', request('class_year'));
        }

        // Search functionality
        if (request('search')) {
            $query->where(function($q) {
                $search = request('search');
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Status filter
        if (request('status')) {
            $query->where('status', request('status'));
        }

        $users = $query->latest()->paginate(10);
        
        return view('admin.users.index', [
            'users' => $users,
            'currentRole' => request('role', 'all'),
            'currentStatus' => request('status', 'all')
        ]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,student,volunteer',  // Updated roles
            'status' => 'required|string|in:active,inactive',
            'class_year' => 'nullable|string',  // Add class_year validation
            'profile_picture' => 'nullable|image|max:1024',
            'phone_number' => 'nullable|string|max:20', // Add phone_number validation
            'scholarship_type' => 'nullable|string|in:home_based,in_house', // Add scholarship_type validation
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->status = $request->status;
        $user->class_year = $request->class_year;  // Add class_year
        $user->phone_number = $request->phone_number; // Add phone_number
        $user->scholarship_type = $request->scholarship_type; // Add scholarship_type

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile-pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,student,volunteer',
            'status' => 'required|in:active,inactive',
            'class_year' => 'nullable|string',  // Add this line
            'password' => 'nullable|string|min:8',
            'phone_number' => 'nullable|string|max:20', // Add phone_number validation
            'scholarship_type' => 'nullable|string|in:home_based,in_house', // Add scholarship_type validation
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}