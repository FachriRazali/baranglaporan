<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Fetch all admins from the database
        $admins = Admin::all();

        // Pass the admins data to the view
        return view('admin.dashboard', compact('admins'));
    }
}
