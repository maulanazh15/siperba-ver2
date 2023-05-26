<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::All();
        return view('user-management.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user-management.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:Pemilik,Manajer,Staff'
        ]);

        $user = User::create($validatedData);

        return redirect()->route('user-management.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('user-management.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'role' => 'required',
            'password' => 'nullable|confirmed|min:6',
        ]);

        $user->email = $validatedData['email'];
        $user->name = $validatedData['name'];
        $user->role = $validatedData['role'];

        if ($request->filled('password')) {
            $user->password = bcrypt($validatedData['password']);
        }

        $user->update();

        return redirect()->route('user-management.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect()->back()->with('success', 'User has been deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'User not found.');
        }
    }
}
