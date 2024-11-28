<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    // Display all admins
    public function index()
    {
        $admins = Admin::all();
        return view('admin.dashboard', compact('admins'));
    }

    // Store a new admin
    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Create a new admin record
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Always hash passwords
        ]);

        // Redirect back to the index page
        return redirect()->route('admin.dashboard');
    }

    // Show the edit form for a specific admin
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.edit', compact('admin'));
    }

    // Update an existing admin
    public function update(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        // Find the admin record and update it
        $admin = Admin::findOrFail($id);
        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $admin->password,
        ]);

        // Redirect back to the index page
        return redirect()->route('admin.dashboard');
    }

    // Delete a specific admin
    public function destroy($id)
    {
        Admin::findOrFail($id)->delete();
        return redirect()->route('admin.dashboard');
    }
}
