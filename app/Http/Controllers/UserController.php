<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user_data = User::all();
        return view('admin.backend.user-management.index', compact('user_data'));
    }

    public function create()
    {
        return view('admin.backend.user-management.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_admin' => 'required|in:0,1',
            'is_super_admin' => 'required|in:0,1',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'role' => $request->role,
            'email' => $request->email,
            'is_admin' => $request->is_admin,
            'is_super_admin' => $request->is_super_admin,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('account-manager.index')->with('message', 'Account Created Successfully');
    }


    public function show()
    {
        $user_data = User::all();
        return view('account-manager.index', compact('user_data'));
    }

    public function edit($id)
    {
        $user_data = User::findOrFail($id);
        return view('admin.backend.user-management.edit', compact('user_data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_admin' => 'required|in:0,1',
            'is_super_admin' => 'required|in:0,1',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
             // Password baru opsional dan jika diisi harus cocok dengan konfirmasi
        ]);

        $user = User::findOrFail($id);

        // Cek apakah ada password baru
        if ($request->new_password) {
            $user->password = Hash::make($request->new_password);
        }

        // Update data lainnya
        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_admin = $request->is_admin;
        $user->is_super_admin = $request->is_super_admin;

        $user->save();

        return redirect()->route('account-manager.index')->with('message', 'Account Updated Successfully');
    }


    public function destroy($id)
    {

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('account-manager.index')->with('success', 'Account deleted successfully');
    }
}
