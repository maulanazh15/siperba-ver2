<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class UserManagementController extends Controller
{
    public function __construct()
    {
        // Apply middleware to the controller actions
        $this->middleware('permission:view user management')->only('index');
        $this->middleware('permission:create user management')->only('create', 'store');
        $this->middleware('permission:edit user management')->only('edit', 'update');
        $this->middleware('permission:delete user management')->only('destroy');
    }

    public function index()
    {
        // Only allow access if user has permission
        $this->authorize('view user management');

        $users = User::all();
        return view('user-management.index', compact('users'));
    }

    public function create()
    {
        // Only allow access if user has permission
        $this->authorize('create user management');

        return view('user-management.create');
    }

    public function store(Request $request)
    {
        // Only allow access if user has permission
        $this->authorize('create user management');

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
            'akses' => 'required|in:Pemilik,Manajer,Staff'
        ]);

        $user = User::create($validatedData);
        if ($request->akses == 'pemilik') {
            $user->assignRole('pemilik');
        } elseif ($request->akses == 'manajer') {
            $user->assignRole('manajer');
        } else {
            $user->assignRole('staff');
        }

        return redirect()->route('user-management.index')->with('success', 'User created successfully.');
    }

    public function edit(string $id)
    {
        // Only allow access if user has permission
        $this->authorize('edit user management');

        $user = User::find($id);
        return view('user-management.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        // Only allow access if user has permission
        $this->authorize('edit user management');

        $user = User::findOrFail($id);
        
        $validatedData = $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'akses' => 'required',
            'password' => 'nullable|confirmed|min:6',
        ]);

        $user->email = $validatedData['email'];
        $user->name = $validatedData['name'];
        $user->akses = $validatedData['akses'];

        if ($request->akses == 'pemilik') {
            $user->assignRole('pemilik');
        } elseif ($request->akses == 'manajer') {
            $user->assignRole('manajer');
        } else {
            $user->assignRole('staff');
        }

        if ($request->filled('password')) {
            $user->password = bcrypt($validatedData['password']);
        }

        $user->save();

        return redirect()->route('user-management.index')->with('success', 'User updated successfully.');
    }

    public function destroy(string $id)
    {
        // Only allow access if user has permission
        $this->authorize('delete user management');

        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect()->back()->with('success', 'User has been deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'User not found.');
        }
    }
}
