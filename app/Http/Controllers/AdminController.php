<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Method lain seperti create, edit, dll. (misalnya untuk manage users)
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('admin.index', compact('users'));
    }

    // Tambah method lain kalau perlu
}